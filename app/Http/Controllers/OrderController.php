<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Order;
use App\Models\Kot;
use App\Models\KotItem;

use App\Models\MenuItem;
use App\Models\Bill;
use App\Models\Foc;
use App\Models\Stock;
use App\Models\BillItem;
use App\Models\StockEntry;
use App\Models\SoftwareSetting;
use App\Models\Debitor;
use App\Models\Member;
use App\Models\Threshold;
use App\Models\MemberThreshold;
use App\Models\CreditDetail;
use App\Models\MenuCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Auth;
use App\Models\Tip;
use Sudeep\LogReader\LogReader;
use App\Http\Controllers\BillController;
use App\Http\Controllers\HelperController;
use App\Http\Resources\ThresholdResource;
use App\Http\Resources\MemberResource;
class OrderController extends Controller
{
    private $is_service_charge;
    private $service_charge_rate;
    private $print_bill;
    private $print_kot;
    protected $reader;
    public function __construct($is_service_charge=false, $service_charge_rate=0, $print_bill=true,$print_kot=true, LogReader $reader){
        $is_service_charge=true;
        $service_charge_rate=10;
        $print_bill=SoftwareSetting::where('slug','print-bill')->first()->value==1?true:false;
        $print_kot=SoftwareSetting::where('slug','print-kot')->first()->value==1?true:false;

        $this->is_service_charge= $is_service_charge;
        $this->service_charge_rate= $service_charge_rate;
        $this->print_bill=$print_bill;
        $this->print_kot=$print_kot;
        $this->reader=$reader;

    }
    public function index($table){
        //Init
            $default_pax=2;
        //Init
        $table=Table::where('uuid',$table)->first();

        if($table){
            if(!$table->is_occupied){
                //Create Order
                $data['customer_id']=1;
                $data['pax']=$default_pax;
                $order=Order::create($data);
                //Create Order
                $table->order_id=$order->id;
                $table->is_occupied=true;
                $table->start_time=Carbon::now();
                $table->update();


            }
            $kots=Kot::where('order_id',$table->order_id)->with('items')->orderBy('created_at','DESC')->get();
            $order=$table->order;
            $bills= self::getBill($kots, $order);
            $menu_categories=MenuCategory::where('status',1)->where('is_special',0)->get();
            $menu_items=MenuItem::with('category')->where('status',1)->where('is_special',0)->orderBy('weight','DESC')->get()->reject(function ($item) {
                return $item->category->status === false;
            });
            $stock_items = Stock::all();
            return view('order.index',compact('menu_categories','menu_items', 'table','kots','bills','stock_items'));

        }else{

        }
    }

    public function addKot(Request $request){
        $table= Table::where('uuid',$request->table)->first();
        if($table){
            $data['order_id']=$table->order_id;
            $kot= Kot::create($data);
            $this->create_log('create','KOT');
            $this_kot_info['date']=$kot->created_at->format('Y/m/d g:i A');
            $this_kot_info['kot_no']=$kot->display_number;
            $this_kot_info['user']=$kot->user->name;
            $this_kot_info['table_name']=$table->name;

            $item['kot_id']=$kot->id;
            $items=json_decode($request->datas);
            $this_kot=[];
            foreach($items as $data){
                $menu=MenuItem::where('slug',$data->menu_item)->first();
                $item['name']=$menu->name;
                $item['quantity']=$data->quantity;
                $item['item_id']=$menu->id;
                $this_kot[]=$item;
                KotItem::create($item);
            }
        }
        $kots=Kot::where('order_id',$table->order_id)->with('items')->orderBy('created_at','DESC')->get();
        $order=$table->order;

        $bills= self::getBill($kots, $order);

        $kot_view= view('order.components.kot',compact('kots'))->render();
        $bill_view= view('order.components.bill_list',compact('bills'))->render();

        $response['print_kot']=$this->print_kot;
        $response['kot_view']=$kot_view;
        $response['bill_view']=$bill_view;
        $response['this_kot']=$this_kot;
        $response['this_kot_info']=$this_kot_info;

        return json_encode($response);
    }

    public function getBill($kots, $order){
       //For Serviec charge


        if($this->is_service_charge) {
            $bills['is_service_charge']=$this->is_service_charge; //Service charge
            $bills['service_charge_rate']=$this->service_charge_rate;
            $bills['service_charge']=0;
        }else{
            $bills['is_service_charge']=$this->is_service_charge; //Service charge
            $bills['service_charge_rate']=0;
            $bills['service_charge']=0;
        }



        //For discount
        $bills['is_foc']=$order->is_foc;
        if($order->is_member==1){
            $member= Member::find($order->member_id);
            $threshold=Threshold::find($order->threshold_id);
            
            $bills['is_member']=true;
            $bills['member_id']=$order->member_id;
            $bills['threshold_id']=$order->threshold_id;
            $bills['is_discount']=true;
            $bills['discount_rate']=self::calculateMemberDiscont($member,$threshold);
            $bills['discount']=0;
        }else{
            if($order->is_discount) {
                $bills['discount_type']=$order->discount_type;
                $bills['is_discount']=$order->is_discount;
                $bills['discount_rate']=$order->discount_percent;
                $bills['discount']=0;
                $bills['max_disount']=$order->max_discount;
            }else{
                $bills['discount_rate']=0;
                $bills['discount']=0;
            }
        }

        //Advance Payment
        if($order->advance>=1){
            $bills['is_advance']=1;
            $bills['advance']=$order->advance;

        }else{
            $bills['is_advance']=0;
            $bills['advance']=0;
        }
        //Advance Payment

        $bills['total']=0;
        $bills['sub_total']=0;
        $bills['detail']=[];
        $bills['pax']=$order->pax;

        $temp_bills['detail']=[];

        foreach($kots as $kot){
            if($kot->is_return){//If Kot Return
                foreach($kot->items as $item){
                    $bills['sub_total']-=$item->item->price*$item->quantity;

                    if(array_key_exists($item->item->slug, $temp_bills['detail'])){
                        $temp_bills['detail'][$item->item->slug]['quantity'] -=$item->quantity;
                        $temp_bills['detail'][$item->item->slug]['total']-=$item->item->price*$item->quantity;

                    }else{
                        $bill['quantity']=-$item->quantity;
                        $bill['name']=$item->item->name;
                        $bill['price']=$item->item->price;
                        $bill['slug']=$item->item->slug;
                        $bill['item_id']=$item->item->id;

                        $bill['prefix']=$item->item->category->prefix;
                        $bill['is_special']=$item->item->is_special;


                        $bill['total']=-$item->item->price*$item->quantity;
                        $temp_bills['detail'][$item->item->slug] =$bill;
                    }

                }
            }else{//If Kot
                foreach($kot->items as $item){

                    $bills['sub_total']+=$item->item->price*$item->quantity;

                    if(array_key_exists($item->item->slug, $temp_bills['detail'])){
                        $temp_bills['detail'][$item->item->slug]['quantity'] +=$item->quantity;
                        $temp_bills['detail'][$item->item->slug]['total']+=$item->item->price*$item->quantity;

                    }else{
                        $bill['quantity']=$item->quantity;
                        $bill['name']=$item->item->name;
                        $bill['price']=$item->item->price;
                        $bill['slug']=$item->item->slug;
                        $bill['item_id']=$item->item->id;
                        $bill['is_special']=$item->item->is_special;

                        $bill['prefix']=$item->item->category->prefix;

                        $bill['total']=$item->item->price*$item->quantity;
                        $temp_bills['detail'][$item->item->slug] =$bill;

                    }

                }
            }

        }
        //Remove bill with 0 quantity
        foreach($temp_bills['detail'] as $bill_item){
            if($bill_item['quantity']!=0){
                $bills['detail'][]=$bill_item;
            }
        }
        if(isset($bills['is_member']) && $bills['is_member']){
            if(isset($bills['is_discount']) && $bills['is_discount']){
                if(isset($bills['threshold_id'])){ //Threshold Discount
                    $bills['discount']= round(($bills['discount_rate']/100)*$bills['sub_total'],2);
                    $amount_after_discount=$bills['sub_total']- $bills['discount'];
                }
    
            }else{
                $bills['discount']=0;
                $amount_after_discount=$bills['sub_total'];
            }
        }else{
            if(isset($bills['is_discount']) && $bills['is_discount']){
                if($bills['discount_type']==1){ //Normal Discount
                    $bills['discount']= round(($bills['discount_rate']/100)*$bills['sub_total'],2);
                    $amount_after_discount=$bills['sub_total']- $bills['discount'];
                }elseif($bills['discount_type']==2){//Item Wise Discount
                    $bills['discount']=0;
                    //Loop all Items
                        foreach($bills['detail'] as $item){
                            $menu_item=MenuItem::find($item['item_id']);
                            if($menu_item->is_discountable){
                                $this_discount_percent=$menu_item->discount;
                                $this_total=$menu_item->price*$item['quantity'];
                                $bills['discount']+=($this_discount_percent/100)*$this_total;
                            }
                        }
                        //Loop all Items
    
                    $bills['discount']=round($bills['discount'],2);
                    $amount_after_discount=$bills['sub_total']- $bills['discount'];
                }elseif($bills['discount_type']==3){ //Category Discount
                    $bills['discount']=0;
                    //Loop all Items
                        foreach($bills['detail'] as $item){
                            $menu_item=MenuItem::find($item['item_id']);
                            if($menu_item->category->is_discountable){
                                $this_discount_percent=$menu_item->category->discount;
                                $this_total=$menu_item->price*$item['quantity'];
                                $bills['discount']+=($this_discount_percent/100)*$this_total;
                            }
                        }
                        //Loop all Items
    
                    $bills['discount']=round($bills['discount'],2);
                    $amount_after_discount=$bills['sub_total']- $bills['discount'];
                }
    
            }else{
                $bills['discount']=0;
                $amount_after_discount=$bills['sub_total'];
            }

        }
        $bills['service_charge']=($bills['service_charge_rate']/100)*$amount_after_discount;
        $bills['total_before_round']=$amount_after_discount+$bills['service_charge'];

        $bills['total']=round($bills['total_before_round']);

        $bills['round']=round($bills['total']-$bills['total_before_round'],2);
        return $bills;
    }
    public function getKotList(Request $request){
        $table= Table::where('uuid',$request->table)->first();
        if($table){
            $kots=Kot::where('order_id',$table->order_id)->with('items')->orderBy('created_at','DESC')->get();
            $order= $table->order;
            $bills= self::getBill($kots, $order);
            $kot_list_view= view('order.components.kot_list',compact('bills','table'))->render();
            $response['kot_list']=$kot_list_view;
            return $response;
        }
    }

    public function returnKot(Request $request){ //Return Kot
        $table= Table::where('uuid',$request->table)->first();
        if($table){
            $data['order_id']=$table->order_id;
            $data['is_return']=1;
            $data['description']=$request->reason;

            $kot= Kot::create($data);
            $this_kot_return_info['date']=$kot->created_at->format('Y/m/d g:i A');
            $this_kot_return_info['kot_no']=$kot->display_number;
            $this_kot_return_info['reason']=$kot->description;

            $this_kot_return_info['user']=$kot->user->name;

            $item['kot_id']=$kot->id;
            $items=json_decode($request->return_items);
            $this_kot=[];
            $item['is_return']=true;
            foreach($items as $data){
                $menu=MenuItem::where('slug',$data->menu_item)->first();
                $item['name']=$menu->name;
                $item['quantity']=$data->quantity;
                $item['item_id']=$menu->id;
                $this_kot[]=$item;
                KotItem::create($item);
                $this->create_log('return','KOT');
            }
        }
        $kots=Kot::where('order_id',$table->order_id)->with('items')->orderBy('created_at','DESC')->get();
        $order=$table->order;
        $bills= self::getBill($kots, $order);

        $kot_view= view('order.components.kot',compact('kots'))->render();
        $bill_view= view('order.components.bill_list',compact('bills'))->render();

        $response['kot_view']=$kot_view;
        $response['bill_view']=$bill_view;
        $response['this_kot_return']=$this_kot;
        $response['this_kot_return_info']=$this_kot_return_info;



        return $response;
    }

    public function getPayableBill(Request $request){
        $table= Table::where('uuid',$request->table)->first();
        if($table){
            $kots=Kot::where('order_id',$table->order_id)->with('items')->orderBy('created_at','DESC')->get();
            $order=$table->order;
            $bills= self::getBill($kots, $order);
            if($bills['total']==0){
                $response['status']=false;
                $response['message']='Empty Order';
            }else{
                if($bills['total']<1){
                    $response['status']=false;
                    $response['message']='Oops something went wrong';

                }else{
                    $bill_view= view('order.components.payable_bill',compact('bills'))->render();
                    $response['status']=true;
                    $response['bill_view']=$bill_view;
                }
            }
            return $response;
        }
    }
    public function pay(Request $request){
        $table= Table::where('uuid',$request->table)->first();
        if($table){
            $kots=Kot::where('order_id',$table->order_id)->with('items')->orderBy('created_at','DESC')->get();
            $order=$table->order;

            $is_service_charge=$this->is_service_charge;
            $service_charge_percent=$this->service_charge_rate;
            $bills= self::getBill($kots, $order);
              //Customer Details
              $c_name='Cash Customer';
              $c_address='';
              $c_pan='';
              $c_phone='';

              if(isset($request->customer_phone) && $request->customer_phone!=''){
                  $c_phone=$request->customer_phone;

                  if(isset($request->customer_name) && $request->customer_name!=''){
                      $c_name=$request->customer_name;
                  }
                  if(isset($request->customer_address) && $request->customer_address!=''){
                      $c_address=$request->customer_address;
                  }
                  if(isset($request->customer_pan) && $request->customer_pan!=''){
                      $c_pan=$request->customer_pan;
                  }


              }else{
                  if(isset($request->customer_name) && $request->customer_name!=''){
                      $c_name=$request->customer_name;
                  }
                  if(isset($request->customer_address) && $request->customer_address!=''){
                      $c_address=$request->customer_address;
                  }
                  if(isset($request->customer_pan) && $request->customer_pan!=''){
                      $c_pan=$request->customer_pan;
                  }
              }
              $data['customer_name']=$c_name;
              $data['customer_pan']=$c_pan;
              $data['customer_phone']=$c_phone;
              $data['customer_address']=$c_address;
              $data['pax']=$request->pax;
              //Customer Details
              $data['print_count']=1;
              $data['order_id']=$table->order_id;
              $data['is_member']=$order->is_member;
              $data['member_id']=$order->member_id;
              $data['threshold_id']=$order->threshold_id;

            if($order->is_foc){//Foc
                $data['sub_total']=$bills['sub_total'];
                $created_bill=$created_foc = Foc::create($data);
                if($created_foc)
                {
                    //Stock Item
                    foreach($bills['detail'] as $item){
                        $this->stockOut($item['item_id'], $item['quantity']);
                    }
                    //Stock Item
                    //Return bill
                    $bill_setting_instance= new BillController($this->reader);
                    $bill_setting=$bill_setting_instance->getBillLayout();
                    $bill_view= view('order.components.bill',compact('bills','bill_setting','created_bill'))->render();

                    $response['bill_view']=$bill_view;
                    $response['redirect_url']=route('workplace.index');
                    $response['bill_setting']=$bill_view;

                    $table->is_occupied=0;
                    $table->order_id=null;
                    $table->start_time=null;
                    $table->update();
                    $order->end=Carbon::now();
                    $order->update();
                    return $response;
                }
            }else{ //Payment

                if($bills['is_advance']){//If Advance
                    $diff=$bills['advance']-$bills['total'];
                    if($bills['advance']>$bills['total']){//Return
                        if($diff<=$request->received || $request->received==0){

                            if($request->tip!='' || $request->tip!=0){
                                $bills['tip']= $request->tip;
                                $bills['received']= 0;
                                $bills['return']= 0;

                                $data['received']=$bills['received'];
                                $return=$bills['advance']-$bills['total']-$bills['tip'];
                                if($return<0){
                                    $return=0;
                                }
                                $data['return']=$return;
                                $data['tip']=$bills['tip'];

                            }else{
                                $bills['received']= 0;
                                $bills['return']= 0;
                                $return=$bills['advance']-$bills['total'];
                                if($return<0){
                                    $return=0;
                                }
                                $data['received']=$bills['received'];
                                $data['return']=$return;
                            }


                            if($order->is_discount){
                                $data['is_discount']=1;
                                $data['discount_percent']=$order->discount_percent;
                                $data['discount_amount']=$bills['discount'];
                                $data['discount_type']=$bills['discount_type'];

                            }else{
                                $data['is_discount']=0;
                                $data['discount_percent']=0;
                                $data['discount_amount']=0;
                            }

                            if($is_service_charge){
                                $data['is_service_charge']=1;
                                $data['service_charge_percent']=$service_charge_percent;
                                $data['service_charge_amount']=$bills['service_charge'];
                            }else{
                                $data['is_service_charge']=0;
                                $data['service_charge_percent']=0;
                                $data['service_charge_amount']=0;
                            }


                            $data['sub_total']=$bills['sub_total'];
                            $data['sub_total_with_discount']=$bills['sub_total']-$bills['discount'];
                            $data['sub_total_with_sc']=$data['sub_total_with_discount']+$bills['service_charge'];
                            $data['round']=$bills['round'];
                            $data['total']=$bills['total'];
                            $data['advance']=$bills['advance'];



                            if(isset($request->payment_type)&&$request->payment_type!=''){
                                $data['payment_type']=$request->payment_type; //Payment Type cash/Bank or credit
                            }else{
                                $data['payment_type']=1; //Payment Type bank

                            }

                            $created_bill = Bill::create($data);
                            $table->is_occupied=0;
                            $table->order_id=null;
                            $table->start_time=null;
                            $table->update();
                            $order->end=Carbon::now();
                            $order->update();

                            // save tip amount
                            if($created_bill)
                            {
                                if($created_bill->tip>0){
                                    $tip_amount['tip_amount'] = $created_bill->tip;
                                    $tip_amount['is_distributed'] = 0;
                                    $tip_amount['remarks'] = 'recieved';
                                    Tip::create($tip_amount);
                                    $this->create_log('recieve','tip');
                                }
                                //Stock Item
                                foreach($bills['detail'] as $item){

                                    $this_item['bill_id']=$created_bill->id;
                                    $this_item['item_id']=$item['item_id'];
                                    $this_item['quantity']=$item['quantity'];
                                    $b = BillItem::create($this_item);
                                    $this->stockOut($item['item_id'],$item['quantity']);
                                }
                                //Stock Item

                            }

                            //Return bill
                            $bill_setting_instance= new BillController($this->reader);
                            $bill_setting=$bill_setting_instance->getBillLayout();
                            $bill_view= view('order.components.bill',compact('bills','bill_setting','created_bill'))->render();

                            $response['bill_view']=$bill_view;
                            $response['redirect_url']=route('workplace.index');
                            $response['bill_setting']=$bill_view;


                            return $response;
                        }
                    }else{ //Payment
                        if($diff<=$request->received || $request->received==0){
                            if($request->received!='' || $request->received!=0){ //If received amount
                                if($request->tip!='' || $request->tip!=0){
                                    $bills['tip']= $request->tip;
                                    $bills['received']= $request->received;
                                    $bills['return']= $bills['received']-$bills['total']+$bills['advance']-$bills['tip'];
                                    $data['received']=$bills['received'];
                                    $data['return']=$bills['return'];
                                    $data['tip']=$bills['tip'];
                                }else{
                                    $bills['received']= $request->received;
                                    $bills['return']= $bills['received']+$bills['advance']-$bills['total'];
                                    $data['received']=$bills['received'];
                                    $data['return']=$bills['return'];
                                }
                            }else{//If no received amount
                                if($request->tip!='' || $request->tip!=0){
                                    $bills['tip']= $request->tip;
                                    $bills['received']= 0;
                                    $bills['return']= 0;

                                    $data['received']=$bills['received'];
                                    $return =$bills['advance']-$bills['total']-$bills['tip'];
                                    if($return<0){
                                        $return=0;
                                    }
                                    $data['return']=$return;
                                    $data['tip']=$bills['tip'];

                                }else{
                                    $bills['received']= 0;
                                    $bills['return']= 0;
                                    $data['received']=$bills['received'];
                                    $return =$bills['advance']-$bills['total']-$bills['tip'];
                                    if($return<0){
                                        $return=0;
                                    }
                                    $data['return']=$return;

                                    $data['return']=$bills['return'];
                                }
                            }

                            if($order->is_discount){
                                $data['is_discount']=1;
                                $data['discount_percent']=$order->discount_percent;
                                $data['discount_amount']=$bills['discount'];
                                $data['discount_type']=$bills['discount_type'];

                            }else{
                                $data['is_discount']=0;
                                $data['discount_percent']=0;
                                $data['discount_amount']=0;
                            }

                            if($is_service_charge){
                                $data['is_service_charge']=1;
                                $data['service_charge_percent']=$service_charge_percent;
                                $data['service_charge_amount']=$bills['service_charge'];
                            }else{
                                $data['is_service_charge']=0;
                                $data['service_charge_percent']=0;
                                $data['service_charge_amount']=0;
                            }


                            $data['sub_total']=$bills['sub_total'];
                            $data['sub_total_with_discount']=$bills['sub_total']-$bills['discount'];
                            $data['sub_total_with_sc']=$data['sub_total_with_discount']+$bills['service_charge'];
                            $data['round']=$bills['round'];
                            $data['total']=$bills['total'];
                            $data['advance']=$bills['advance'];



                            if(isset($request->payment_type)&&$request->payment_type!=''){
                                $data['payment_type']=$request->payment_type; //Payment Type cash/Bank or credit
                            }else{
                                $data['payment_type']=1; //Payment Type bank
                            }

                            $created_bill = Bill::create($data);
                            $table->is_occupied=0;
                            $table->order_id=null;
                            $table->start_time=null;
                            $table->update();
                            $order->end=Carbon::now();
                            $order->update();

                            // save tip amount
                            if($created_bill)
                            {
                                if($created_bill->tip>0){
                                    $tip_amount['tip_amount'] = $created_bill->tip;
                                    $tip_amount['is_distributed'] = 0;
                                    $tip_amount['remarks'] = 'recieved';
                                    Tip::create($tip_amount);
                                    $this->create_log('recieve','tip');
                                }
                                //Stock Item
                                foreach($bills['detail'] as $item){
                                    $this_item['bill_id']=$created_bill->id;
                                    $this_item['item_id']=$item['item_id'];
                                    $this_item['quantity']=$item['quantity'];
                                    $b = BillItem::create($this_item);
                                    $this->stockOut($item['item_id'],$item['quantity']);
                                }
                                //Stock Item

                            }

                            //Return bill
                            $bill_setting_instance= new BillController($this->reader);
                            $bill_setting=$bill_setting_instance->getBillLayout();
                            $bill_view= view('order.components.bill',compact('bills','bill_setting','created_bill'))->render();

                            $response['bill_view']=$bill_view;
                            $response['redirect_url']=route('workplace.index');
                            $response['bill_setting']=$bill_view;


                            return $response;
                        }
                    }

                }else{ //No Advance
                    if($bills['total']<=$request->received || $request->received==0){
                        if($request->received!='' || $request->received!=0){
                            if($request->tip!='' || $request->tip!=0){
                                $bills['tip']= $request->tip;
                                $bills['received']= $request->received;
                                $bills['return']= $bills['received']-$bills['total']-$bills['tip'];

                                $data['received']=$bills['received'];
                                $data['return']=$bills['return'];
                                $data['tip']=$bills['tip'];

                            }else{
                                $bills['received']= $request->received;
                                $bills['return']= $bills['received']-$bills['total'];
                                $data['received']=$bills['received'];
                                $data['return']=$bills['return'];
                            }
                        }else{
                            if($request->tip!='' || $request->tip!=0){
                                $bills['tip']= $request->tip;
                                $bills['received']= 0;
                                $bills['return']= 0;

                                $data['received']=$bills['received'];
                                $data['return']=$bills['return'];
                                $data['tip']=$bills['tip'];

                            }else{
                                $bills['received']= 0;
                                $bills['return']= 0;
                                $data['received']=$bills['received'];
                                $data['return']=$bills['return'];
                            }
                        }

                        if($order->is_discount){
                            $data['is_discount']=1;
                            $data['discount_percent']=$order->discount_percent;
                            $data['discount_amount']=$bills['discount'];
                            $data['discount_type']=$bills['discount_type'];

                        }else{
                            $data['is_discount']=0;
                            $data['discount_percent']=0;
                            $data['discount_amount']=0;
                        }

                        if($is_service_charge){
                            $data['is_service_charge']=1;
                            $data['service_charge_percent']=$service_charge_percent;
                            $data['service_charge_amount']=$bills['service_charge'];
                        }else{
                            $data['is_service_charge']=0;
                            $data['service_charge_percent']=0;
                            $data['service_charge_amount']=0;
                        }


                        $data['sub_total']=$bills['sub_total'];
                        $data['sub_total_with_discount']=$bills['sub_total']-$bills['discount'];
                        $data['sub_total_with_sc']=$data['sub_total_with_discount']+$bills['service_charge'];
                        $data['round']=$bills['round'];
                        $data['total']=$bills['total'];


                        if(isset($request->payment_type) &&$request->payment_type!=''){
                            $data['payment_type']=$request->payment_type; //Payment Type cash/Bank or credit
                        }else{
                            $data['payment_type']=1; //Payment Type bank

                        }

                        $created_bill = Bill::create($data);
                        if($created_bill->payment_type==3){//Add Credit Amount
                            $debitor=Debitor::where('slug',$request->debitor)->first();
                            $description='Credit sales for Invoice no: "'.$created_bill->bill_no.'"';
                            self::addCredit($debitor,$created_bill->total, $description);
                        }
                        $table->is_occupied=0;
                        $table->order_id=null;
                        $table->start_time=null;
                        $table->update();
                        $order->end=Carbon::now();
                        $order->update();

                        // save tip amount
                        if($created_bill)
                        {
                            if($created_bill->tip>0){
                                $tip_amount['tip_amount'] = $created_bill->tip;
                                $tip_amount['is_distributed'] = 0;
                                $tip_amount['remarks'] = 'recieved';
                                Tip::create($tip_amount);
                                $this->create_log('recieve','tip');
                            }
                            //Stock Item
                            foreach($bills['detail'] as $item){
                                $this_item['bill_id']=$created_bill->id;
                                $this_item['item_id']=$item['item_id'];
                                $this_item['quantity']=$item['quantity'];
                                $b = BillItem::create($this_item);
                                $this->stockOut($item['item_id'],$item['quantity']);
                            }
                            //Stock Item

                        }

                        //Return bill
                        $bill_setting_instance= new BillController($this->reader);
                        $bill_setting=$bill_setting_instance->getBillLayout();
                        $bill_view= view('order.components.bill',compact('bills','bill_setting','created_bill'))->render();

                        $response['bill_view']=$bill_view;
                        $response['redirect_url']=route('workplace.index');
                        $response['bill_setting']=$bill_view;


                        return $response;
                    }
                }
                //Return
                //Paymeny


            }


        }
    }
    public function splitBill($table){
        //Init
        $default_pax=2;
        //Init
        $table=Table::where('uuid',$table)->first();

        if($table){
            if(!$table->is_occupied){
               dd('table not occupied');
            }
            $kots=Kot::where('order_id',$table->order_id)->with('items')->orderBy('created_at','DESC')->get();
            $order=$table->order;
            $bills= self::getBill($kots, $order);
            return view('order.split_bill',compact('table','bills'));

        }else{

        }
    }
    public function paySplitBill(Request $request){
        $bill_setting_instance= new BillController($this->reader);
        $bill_setting=$bill_setting_instance->getBillLayout();

        $table= Table::where('uuid',$request->table)->first();
        if($table){
            $kots=Kot::where('order_id',$table->order_id)->with('items')->orderBy('created_at','DESC')->get();
            $order=$table->order;
            $real_bills= self::getBill($kots, $order);
            $bills=[];

            foreach($request->bills as $bill){
                //Items
                $details=[];
                $bills_item=[];
                $this_total=0;
                foreach($bill['items'] as $slug=>$quantity){
                    $menu=MenuItem::where('slug',$slug)->first();
                    $this_item['quantity']=$quantity;
                    $this_item['name']=$menu->name;
                    $this_item['price']=$menu->price;
                    $this_item['slug']=$menu->slug;
                    $this_item['item_id']=$menu->id;
                    $this_item['total']=$menu->price*$quantity;
                    $this_item['is_special']=$menu->is_special;

                    $this_total+=$menu->price*$quantity;
                    $bills_item[]=$this_item;
                    $details[]=$this_item;
                }

                $this_bills['order_id']=$table->order_id;
                $this_bills['detail']=$details;
                //Discount
                    $discount_percent=$bill['discount_percent'];
                    $discount_amount=($discount_percent/100)*$this_total;
                    $total=$this_total-$discount_amount;
                    $this_bills['discount_percent']=$discount_percent;
                    $this_bills['discount_amount']=$discount_amount;
                //Discount
                //Service Charge
                $is_service_charge=$this->is_service_charge;
                $service_charge_percent=$this->service_charge_rate;
                $this_bills['is_service_charge']=$service_charge_percent;
                if($is_service_charge){
                    $service_charge_amount=($service_charge_percent/100)*$this_total;
                    $total+=$service_charge_amount;
                    $this_bills['service_charge_percent']=$service_charge_percent;
                    $this_bills['service_charge_amount']=$service_charge_amount;
                    $this_bills['is_service_charge']=1;
                }
                //Items
                $total_before_round=$total;
                $total=round($total_before_round);
                $round=round($total-$total_before_round,2);
                $this_bills['items']=$bills_item;
                $this_bills['sub_total']=$this_total;
                $this_bills['total']=$total;
                $this_bills['received']=isset($bill['received_amount']) ?$bill['received_amount']:0;
                $this_bills['tip']=isset($bill['tip_amount'])?$bill['tip_amount']:0;
                $return=$this_bills['received']-$this_bills['total']+$this_bills['tip'];
                $this_bills['return']= $return;
                $this_bills['round']= $round;

                $this_bills['pax']=(isset($bill['pax']) && $bill['pax']>0)?$bill['pax']:1;
                $this_bills['customer_name']= (isset($bill['customer_name']) && $bill['pax']!='')?$bill['customer_name']:'Cash Customer';
                $this_bills['customer_phone']= $bill['customer_phone'];
                $this_bills['customer_address']= 1;
                $this_bills['customer_pan']= $bill['customer_pan'];
                $this_bills['payment_type']= (isset($bill['payment_type']) && $bill['payment_type']!='' && $bill['payment_type']=='cash')?1:2;


                if($return<0){
                    $this_bills['return']= 0;
                }

                $this_bills['print_count']=1;
                //Service Charge
                $bills[]=$this_bills;

            }
            //Save Bill
            $bill_view=[];
            foreach($bills as $bill){
                $created_bill = Bill::create($bill);
                foreach($bill['items'] as $item){
                    $this_item['bill_id']=$created_bill->id;
                    $this_item['item_id']=$item['item_id'];
                    $this_item['quantity']=$item['quantity'];
                    $b = BillItem::create($this_item);
                    $this->stockOut($item['item_id'],$item['quantity']);
                    $helper_instance= new HelperController($this->reader);
                    $bill['total_in_word']=$helper_instance->convertNumberToWord($bill['total']);


                }

                $bill_view[]= view('order.components.bill')
                    ->with('bills', $bill)
                    ->with('bill_setting', $bill_setting)
                    ->with('created_bill', $created_bill)
                    ->render();
                if($b){
                    $tip_amount['tip_amount'] = $created_bill->tip;
                    $tip_amount['is_distributed'] = 0;
                    $tip_amount['remarks'] = $created_bill->bill_no;
                    Tip::create($tip_amount);
                }
            }

            //Reset Table
                $table->is_occupied=0;
                $table->order_id=null;
                $table->start_time=null;
                $table->update();
                $order->end=Carbon::now();
                $order->update();
            //Reset Table
            $res['status']=true;
            $res['bills']=$bill_view;
            $res['redirect_url']=route('workplace.index');
            $res['print_bill']=$this->print_bill;
            return json_encode($res);
        }
    }


    public function checkPin(Request $request){
        if(!$request->pin){
            $res['status']=false;
            $res['message']='Pin Incorrect';
            $res['discount_percent']=0;
        }else{
           if(Auth::user()->pin==$request->pin){
                $table= Table::where('uuid',$request->table)->first();
                if($table){
                    $order=$table->order;
                    if($order){
                        $order->is_discount=true;
                        $order->discount_type=$request->discount_type;
                        $order->max_discount= Auth::user()->discount;
                        $order->discount_by= Auth::user()->id;
                        $order->update();
                        $res['status']=true;
                                                 $res['discount_percent']=Auth::user()->discount;
                        $kots=Kot::where('order_id',$order->id)->with('items')->orderBy('created_at','DESC')->get();

                        $bills= self::getBill($kots, $order);
                        $bill_view= view('order.components.bill_list',compact('bills'))->render();

                        $res['bill_view']=$bill_view;

                    }else{
                        $res['status']=false;
                        $res['message']='Oops something went wrong.';
                    }
                }

           }else{
                $res['status']=false;
                $res['message']='Pin Incorrect';
                $res['discount_percent']=0;
           }

       }
       return json_encode($res);

    }
    public function createFoc(Request $request){
        if(!$request->pin){
            $res['status']=false;
            $res['message']='Pin Incorrect';
            $res['discount_percent']=0;
        }else{
           if(Auth::user()->pin==$request->pin){
                $table= Table::where('uuid',$request->table)->first();
                if($table){
                    $order=$table->order;
                    if($order){
                        $order->is_foc=true;
                        $order->update();
                        $this->create_log('create','FOC');
                        $res['status']=true;
                        $kots=Kot::where('order_id',$order->id)->with('items')->orderBy('created_at','DESC')->get();

                        $bills= self::getBill($kots, $order);
                        $bill_view= view('order.components.bill_list',compact('bills'))->render();

                        $res['bill_view']=$bill_view;

                    }else{
                        $res['status']=false;
                        $res['message']='Oops something went wrong.';
                    }
                }

           }else{
                $res['status']=false;
                $res['message']='Pin Incorrect';
                $res['discount_percent']=0;
           }

       }
       return json_encode($res);

    }
    public function removeFoc(Request $request){
        $table= Table::where('uuid',$request->table)->first();
        if($table){
            $order=$table->order;
            if($order){
                $order->is_foc=false;
                $order->is_discount=false;
                $order->max_discount= 0;
                $order->discount_percent= 0;
                $order->discount_type= null;
                $order->discount_by= 0;

                $order->update();
                $res['status']=true;

                $kots=Kot::where('order_id',$order->id)->with('items')->orderBy('created_at','DESC')->get();

                $bills= self::getBill($kots, $order);
                $bill_view= view('order.components.bill_list',compact('bills'))->render();

                $res['bill_view']=$bill_view;
            }
        }

        return json_encode($res);
    }
    public function applyDiscount(Request $request){
        $table= Table::where('uuid',$request->table)->first();
        if($table){
            $order=$table->order;
            if($order){
                $order->discount_percent=$request->discount_percent;
                $order->update();
                $this->create_log('apply','discount');
            }
        }


    }
    public function removeDiscount(Request $request){
        $table= Table::where('uuid',$request->table)->first();
        if($table){
            $order=$table->order;
            if($order){
                $order->is_discount=false;
                $order->max_discount= 0;
                $order->discount_percent= 0;
                $order->discount_type= null;

                $order->discount_by= 0;

                $order->update();
                $res['status']=true;

                $kots=Kot::where('order_id',$order->id)->with('items')->orderBy('created_at','DESC')->get();

                $bills= self::getBill($kots, $order);
                $bill_view= view('order.components.bill_list',compact('bills'))->render();

                $res['bill_view']=$bill_view;
            }
        }

        return json_encode($res);
    }

    public function stockOut($item_id, $qty){
            $menu=MenuItem::find($item_id);
            foreach($menu->stock_items as $stock){
                $data['stock_id'] =$stock->id;
                $data['stock_out'] =$stock->pivot->quantity*$qty;
                StockEntry::create($data);
            }
    }

    public function addAdvance(Request $request){
        $table= Table::where('uuid',$request->table)->first();
        if($table){
            $order=$table->order;
            if($order){
                //Advance Detail
                $old_advance=$order->advance_detail;
                if($old_advance==null){
                    $new_advance=[[
                            'amount'=>$request->advance,
                            'user_id'=>Auth::User()->id,
                            'created_at'=>Carbon::now()->format('Y-m-d H:i:s')
                        ]];
                }else{
                    $new_advance=json_decode($old_advance);
                    $this_advance=[
                            'amount'=>$request->advance,
                            'user_id'=>Auth::User()->id,
                            'created_at'=>Carbon::now()->format('Y-m-d H:i:s')
                        ];
                    array_push($new_advance,$this_advance);
                }

                //Advance Detail
                $order->advance+=$request->advance;
                $order->advance_detail=json_encode($new_advance);

                $order->update();

                $kots=Kot::where('order_id',$order->id)->with('items')->orderBy('created_at','DESC')->get();

                $bills= self::getBill($kots, $order);
                $bill_view= view('order.components.bill_list',compact('bills'))->render();
                $res['status']=true;
                $res['bill_view']=$bill_view;

            }else{
                $res['status']=false;
                $res['message']='Oops something went wrong.';
            }
        }else{
            $res['status']=false;
            $res['message']='Oops something went wrong.';
        }
        return json_encode($res);

    }
    public function removeAdvance(Request $request){
        $table= Table::where('uuid',$request->table)->first();
        if($table){
            $order=$table->order;
            if($order){
                $order->advance=0;
                $order->advance_detail=null;
                $order->update();
                $res['status']=true;

                $kots=Kot::where('order_id',$order->id)->with('items')->orderBy('created_at','DESC')->get();

                $bills= self::getBill($kots, $order);
                $bill_view= view('order.components.bill_list',compact('bills'))->render();

                $res['bill_view']=$bill_view;
            }
        }

        return json_encode($res);
    }

    public static function addCredit($debitor,$amount, $description){
        $data['debitor_id']=$debitor->id;
        $data['amount']=$amount;
        $data['description']=$description;

        CreditDetail::create($data);
    }

    //Membership
    
    public function checkMember(Request $request){
        $cred=$request->membership_credential;
        $member= Member::where('phone',$request->membership_credential)
                        ->orWhere('membership_no',$request->membership_credential)
                        ->first();
        if($member===null){
            $res['status']=false;
            $res['message']='Member doesnot exist.';
            $res['data']=$request->membership_credential;
        }else{
            if($member->status){
                $threshold=ThresholdResource::collection($member->thresholds);
                $res['status']=true;
                $res['thresholds']=$threshold;
                $res['member_total']=self::calculateMemberTotal($member);
                $res['data']=$request->membership_credential;
                $res['member']=new MemberResource($member);
            }else{                
                $res['status']=false;
                $res['message']='Member is not active.';
                $res['data']=$request->membership_credential;
            }
        }
        return json_encode($res);
    }
    public function applyMember(Request $request){
        $table= Table::where('uuid',$request->table)->first();
        if($table){//Table exist
            $order=$table->order;
            if($order){ //Order Exist
                $member= Member::where('slug',$request->member_slug)
                ->first();
                if($member===null){ //Member Doesnot exist
                    $res['status']=false;
                    $res['message']='Member doesnot exist.';
                    $res['data']=$request->member_slug;
                }else{ //MEmber Exist
                    if($member->status){ //Member Active
                        $threshold=Threshold::where('slug',$request->threshold)->first();
                        if($threshold===null){ //Threshold Doesnot Exist
                            $res['status']=false;
                            $res['message']='Threshold doesnot exist.';
                            $res['data']=$request->all();
                            $res['member']=$member;
                        }else{ //Threshold Exist
                            if(MemberThreshold::where('member_id',$member->id)->where('threshold_id',$threshold->id)->exists()){
                                $res['status']=true;
                                $res['message']='Member and threshold exist.'; 
                                //Apply Member discount
                                $order->is_member=true;
                                $order->member_id=$member->id;
                                $order->threshold_id=$threshold->id;
                                $order->update();
                                //REturn Bill
                                    $kots=Kot::where('order_id',$order->id)->with('items')->orderBy('created_at','DESC')->get();
                                    $bills= self::getBill($kots, $order);
                                    $bill_view= view('order.components.bill_list',compact('bills'))->render();
                                    $res['bill_view']=$bill_view;
                                //REturn Bill

                                //Apply member discoutn 
                            }else{
                                $res['status']=false;
                                $res['message']='Member doesnot have such threshold privilege.';  
                            }
                                            
                        }
                    

                    }else{ //Member Inactive               
                        $res['status']=false;
                        $res['message']='Member is not active.';
                        $res['data']=$request->membership_credential;
                    }
                }
            }else{//Order Doesnot Exist
                $res['status']=false;
                $res['message']='Order doesnot exist.'; 
            }
        }else{
            $res['status']=false;
            $res['message']='Table doesnot exist.'; 
        }

        return json_encode($res);
    }
    public static function calculateMemberDiscont($member,$threshold){
        $total_spend=self::calculateMemberTotal($member);
        $thresholds=json_decode($threshold->detail);
        $discount_rate=0;
        $total=0;
        foreach($thresholds as $range){
            if($total_spend>=$range[0]){
                if($range[0]>$discount_rate){
                    $discount_rate=$range[1];
                }
            }
        }
        return $discount_rate;
    }
    public static function calculateMemberTotal($member){
        $total_spend=Bill::where('member_id',$member->id)
                ->sum('total');
        return $total_spend;
    }
    //Membership



}
