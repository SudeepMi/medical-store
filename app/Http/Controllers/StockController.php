<?php

namespace App\Http\Controllers;

use App\Http\Requests\Stock\AdjustItemRequest;
use App\Http\Requests\Stock\CreateStockItemRequest;
use App\Http\Requests\Stock\ItemDetailsRequest;
use App\Http\Requests\Stock\ItemIndexRequest;
use App\Http\Requests\Stock\PurchaseDetailRequest;
use App\Http\Requests\Stock\UpdateStockItemRequest;
use Sudeep\LogReader\LogReader;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\StockEntry;
use Carbon\Carbon;
use App\Models\Vendor as Debitor;
use App\Http\Requests\Stock\PurchaseStockItemRequest;
use App\Http\Requests\Utensil\UpdateUtensilRequest;
use App\Models\Stockpurchase;
use App\Models\PurchasePayment;
use View;
use Validator;

class StockController extends Controller
{
    private $stock;
    private $debitor;
    public function __construct(LogReader $reader, Stock $stock, Debitor $debitor)
    {
        parent::__construct ( $reader );
        $this->stock = $stock;
        $this->debitor = $debitor;

    }

    public function create(){
    	return view('stocks.item.create');
    }

    public function store(CreateStockItemRequest $request){

    	$this->stock->unit = $request->unit;
    	$this->stock->name = $request->item_name;
        $this->stock->price = $request->price;
    	if ($this->stock->save()) {
        //Opening Stock Entry
        if(isset($request->opening_stock) && $request->opening_stock >0){
          $data['stock_id'] =$this->stock->id;
          $data['is_opening_stock'] =1;
          $data['stock_in'] =$request->opening_stock * 1000;
          StockEntry::create($data);
        }
            $this->create_log('create','stock item');
            if (isset($request->ref)) {
                switch ($request->ref) {
                    case '0':
                    return redirect()->route('stock.item.create');
                        break;

                    case '1':
                    return redirect()->route('stock.item.index');
                        break;
                }
            }else{
            return redirect()->route('stock.item.index');
            }

    	}

    }


    public function item_index(ItemIndexRequest $request){
        $this->PurchaseSummary();
      $from=$to=Carbon::today();
      if(isset($request->from) && isset($request->to)){
          $from=Carbon::parse($request->from);
          $to=Carbon::parse($request->to);

      }
        $items = Stock::with(['purchases'=> function($query) use ($to){
                                    $query->whereDate('created_at','<=', $to);
                                }])
                      ->with(['sales'=> function($query) use ($to){
                        $query->whereDate('created_at','<=', $to);
                      }])
                      ->with('opening_stock')
                      ->with('user')
                      ->get();
        foreach($items as $i){
            switch ($i->unit) {
                case 'kg':
                   $i->si = "Kg";
                   $i->ratio = 1000;
                    break;
                case 'litre':
                   $i->si = "L";
                   $i->ratio = 1000;
                    break;
                default:
                $i->si = "Packets";
                $i->ratio = 1000;
                    break;
            }
        }
        $items->map(function ($item) {
            $item['opening_stock']=$item->opening_stock->sum('stock_in');
            $item['purchase']=$item->purchases->sum('stock_in');
            $item['sales']=$item->sales->sum('stock_out');
            $item['net_stock']=$item['opening_stock']+$item['purchase']-$item['sales'];

            $item['available']=$item['net_stock'];
            return $item;
        });

        return view('stocks.item.index',compact('items'))
                      ->with('from',$from->format('m/d/Y'))
                      ->with('to',$to->format('m/d/Y'));
    }

    public function edit(Request $request){

        $item = $this->stock::where('id',$request->id)->first();
        $view= View::make('stocks.item.edit', [
            'item' => $item,
        ]);

        return $view;

    }

    public function update(Request $request){
      $data = $this->getArray($request);
       $this->withValidate($data, new UpdateStockItemRequest());
            $item = $this->stock->where('slug',$data["item_slug"])->first();
            $item->name = $data['item_name'];

            if ($item->save()) {
                $this->create_log ('update','stock item');
                return "ok";
            }

    }

    public function delete(Request $request){
       if ($item = Stock::find($request->id)->delete()) {
            $this->create_log ('delete','stock item');
         return redirect()->route('stock.item.index');
       }
       else{
        return redirect()->back();
       }
    }

    public function purchase(){ //Returns purchase view
      $items = $this->stock::where('is_active',1)->get();
      $debitors = $this->debitor
      ->with('purchase')
      ->with('payments')
      ->orderBy('created_at', 'DESC')
      ->get();
      foreach($debitors as $deb){
      $debs['total_cash'] =  (isset($deb->purchase)) ? $deb->purchase->sum('cash') : 0;
      $deb['total_credit'] = (isset($deb->purchase)) ? $deb->purchase->sum('credit') + $deb->opening_amount : $deb->opening_amount;
      $deb['amount_paid'] = (isset($deb->payments)) ? $deb->payments->sum('amount') : 0 ;
      }
      return view('stocks.item.purchase', compact('items','debitors'));
    }

    public function purchaseStore(PurchaseStockItemRequest $request){ //Save Purchase

      if(isset($request->stock_items)){
        //purchase debitor info

        $deb = Debitor::where('slug',$request->vendor)->get('id')->first();
        $purchase['debitor_id'] = $deb->id;
        $purchase['invoice'] = $request->invoice_no;
        $purchase['total'] = $request->total;
        $purchase['cash'] = $request->cash_amount;
        $purchase['credit'] = $request->credit_amount;

        $p = Stockpurchase::create($purchase);

        foreach($request->quantity as $key=>$item){

            $stock= Stock::where('slug',$key)->first();


            //Purchase stock item Store here
            $data['stock_id'] =$stock->id;
            $data['stock_in'] = ($request->unit[$key] == 1) ? $item * 1000 : $item;
            $data['rate'] =  $request->rate[$key];
            $data['purchase_id'] = $p->id;
            StockEntry::create($data);
        }
        $this->create_log ('purchase','stock item');
        if (isset($request->ref)) {
            switch ($request->ref) {
                case '0':
                return redirect()->route('stock.item.purchase');
                    break;

                case '1':
                return redirect()->route('stock.item.index');
                    break;
            }
        }else{
        return redirect()->route('stock.item.index');
        }
      }
    }

    public function getDetail(ItemDetailsRequest $request){
        $stock = Stock::with('purchases')
                    ->with('adjustment')
                    ->find($request->id);



        //  $items = StockEntry::where('stock_id',$request->id)
        //               ->where('is_opening_stock',0)
        //               ->where('is_adjustment',0)
        //               ->with('purchase')
        //               ->with('stock')
        //               ->get();
        $view= View::make('stocks.item.component.info', [
                        'stock' => $stock,
                    ]);

                    return $view;
        }

    public function PurchaseDetail(PurchaseDetailRequest $request){
       $new = Stockpurchase::where('invoice',$request->invoice)
                    ->with('stock_item.stock')
                    ->first();

        $view= View::make('vendor.components.purchase-info', [
                        'stock' =>  $new,
                    ]);
                    return $view;
    }
    public function PurchaseSummary(){
        $all = Debitor::with('purchase')
                            ->get();
       foreach($all as $debitor){
           $debitor['total'] = $debitor->purchase->sum('total');
       }
      //  dd($all);
    }

    public function adjust(Request $request){
      $total = $this->getArray($request);
      $this->withValidate($total, new AdjustItemRequest());
       $datas[$total['type']] = $total['count'];
       $datas['stock_id'] = $total['id'];
       $datas['is_adjustment'] = 1;
       $datas['remarks'] = $total['remarks'];
       if(StockEntry::create($datas)){
           return "ok";
       }
       return "operation failed";
    }

    public function updateStatus(Request $request){
        $item = Stock::find($request->id);
        $item->is_active = ($item->is_active == 1) ? 0 : 1;
        if($item->update()){
            $this->create_log ('change status','stock item');
            return response()->json(['status' => 'success', 'successMsg' => 'Successfully Updated Item Status!']); die;
        }
        return response()->json(['status' => 'failed', 'errorMsg' => 'Something went wrong. Please try again!']);

    }

}
