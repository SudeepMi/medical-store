<?php

namespace App\Http\Controllers;

use App\Models\SoftwareSetting;
use App\Models\Tip;
use App\Models\Bill;
use App\Models\MenuItem;
use App\Models\KotItem;
use Mail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
//    use Logs;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     *
     */
    private $wizard;

    public function __construct(SoftwareSetting $setting)
    {
        $this->wizard = $setting;
    }

    public function index(){


            // $tips = $this->CalculateTips();
            $sales = $this->calculateSales();
            // $best_sellers = $this->calculateBestSellersItem();

            return view ( 'home', compact ( 'tips','sales') );

    }

    public function notifyForm(Request $request)
    {
        if($request->ajax()){
            $name = $request->name;
            $email = $request->email;
            $html = view("layouts.components.email.email-notification-form", compact('name', 'email'))->render();
            return response()->json(['status'=>'true', 'html'=>$html]);
        }
        return response()->json(['status'=>'false']);
    }

    public function sendNotification(Request $request)
    {

        $data = array('name' => $request['name'], 'email' => $request['email'], 'subject' => $request['subject'], 'messages' => $request['message']);

        Mail::send('layouts.components.email.email-templete', $data, function($message) use ($data) {
            $message->to($data['email'])
                    ->subject($data['subject']);
            $message->from('harish@klientscape.com');
        });
        $notification   = array(
            'title'     => 'success',
            'message'   => 'Birthday wish successfully sent.'
        );
        return redirect()->back()->with($notification);
    }

    protected function CalculateTips(){
        $today = Carbon::today();
        $tips['today'] = Tip::where('is_distributed',0)
        ->whereDate('created_at', $today)->get()->sum('tip_amount');
        $date = Carbon::now();
        $tips['week'] = Tip::where('is_distributed',0)
        ->whereBetween('created_at', [$date->startOfWeek()->format('Y-m-d H:i:s') ,$date->endOfWeek()->format('Y-m-d H:i:s')])
        ->get()->sum('tip_amount');
        $tips['month'] = Tip::where('is_distributed',0)
        ->whereMonth('created_at', date('m'))
        ->get()->sum('tip_amount');
        $tips['total'] = Tip::where('is_distributed',0)->get()->sum('tip_amount');
        // dd($tips);
        return $tips;
    }
    protected function calculateSales(){
        $today = Carbon::today();
        $sales['today'] = Bill::whereDate('created_at', $today)->get()->sum('total');
        $date = Carbon::now();
        $sales['week'] = Bill::whereBetween('created_at', [$date->startOfWeek()->format('Y-m-d H:i:s') ,$date->endOfWeek()->format('Y-m-d H:i:s')])
                        ->get()
                        ->sum('total');
        $sales['month'] = Bill::whereMonth('created_at', date('m'))
                        ->get()
                        ->sum('total');
        $sales['total'] = Bill::get()->sum('total');
        return $sales;
    }
    protected function calculateBestSellersItem(){
        $max_count=5;
        $sales= KotItem::where('is_return',0)
                        ->select('item_id')
                        ->selectRaw('sum(quantity) as sum')
                        ->groupBy('item_id');

        $sold['alltime'] = $sales->get()->toArray();
        // $sold['latest'] = $sales ->orderBy('created_at', 'DESC')->get()->toArray();
        // $sold['month'] = $sales->whereMonth('created_at', date('m'))->groupBy('created_at')->get()->toArray();
        // $sold['year'] = $sales->whereYear('created_at', date('Y'))->get()->toArray();

        $returns= KotItem::groupBy('item_id')
            ->select('item_id')
            ->selectRaw('sum(quantity) as sum')
            ->where('is_return',1)
            ->get()
            ->toArray();

        $best_seller['alltime']=[];
        // $best_seller['latest']=[];
        // $best_seller['month']=[];
        // $best_seller['year']=[];

        foreach($sold['alltime'] as $sale){

            $best_seller['alltime'][$sale['item_id']]=$sale['sum'];
        }
        // foreach($sold['latest'] as $sale){

        //     $best_seller['latest'][$sale['item_id']]=$sale['sum'];
        // }
        // foreach($sold['month'] as $sale){

        //     $best_seller['month'][$sale['item_id']]=$sale['sum'];
        // }
        // foreach($sold['year'] as $sale){

        //     $best_seller['year'][$sale['item_id']]=$sale['sum'];
        // }
        // foreach($returns as $return){
        //     $best_seller['alltime'][$return['item_id']]-=$return['sum'];
        // }
        dd($best_seller);
        arsort($best_seller['alltime']);
        $i=0;
        $best_sellers['alltime']=[];
        foreach($best_seller['alltime'] as $key=>$quantity){
            if($quantity>0){
                $menu_item= MenuItem::find($key);
                $best_sellers['alltime'][]=['name'=>$menu_item->name,
                                            'quantity'=>$quantity
                                            ];
                $i++;
                if($i>=$max_count)
                break;
            }
        }
        return $best_sellers;

    }

}
