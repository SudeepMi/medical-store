<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Bill;
use App\Http\Resources\InvoiceResource;
use App\Models\KotItem;
use App\Models\MenuItem;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;
use View;


class ReportController extends ApiController
{
    public function getWeeklySales(){
        $dates=[
                date('Y-m-d', strtotime('-6 days')),
                date('Y-m-d', strtotime('-5 days')),
                date('Y-m-d', strtotime('-4 days')),
                date('Y-m-d', strtotime('-3 days')),
                date('Y-m-d', strtotime('-2 days')),
                date('Y-m-d', strtotime('-1 days')),
                date('Y-m-d')
            ];
        $res['labels']=[
                        date('D', strtotime('-6 days')),
                        date('D', strtotime('-5 days')),
                        date('D', strtotime('-4 days')),
                        date('D', strtotime('-3 days')),
                        date('D', strtotime('-2 days')),
                        date('D', strtotime('-1 days')),
                        date('D')
                    ];
        $date = Carbon::today()->subDays(7);
        $datas = Bill::select(array(
                DB::raw('DATE(`created_at`) as `date`'),
                DB::raw('SUM(`total`) as `total`')
            ))
            ->whereDate('created_at', '>', $date)
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->get();

        $totals=[];
        foreach($dates as $date){
            $totals[$date]=0;
        }
        foreach($datas as $data){
            $totals[$data->date]=$data->total;
        }
        $res['data']= array();
        foreach($totals as $total){
            array_push($res['data'],$total);
        }
        return json_encode($res);
    }
    public function getMonthlySales(){
        return json_encode(self::__getMonthlySales());
    }

    public function getSalesReport(Request $request){
        $from_date=Carbon::parse($request->from);
        $to_date=Carbon::parse($request->to);

        $diff = $from_date->diffInDays($to_date);


        if($from_date==$to_date){
            $res=self::__getOneDaySales($to_date);
        }
        elseif($diff<12){
            $periods = CarbonPeriod::create($from_date->format('Y-m-d'), $to_date->format('Y-m-d'));
            $dates=[];
            $res['labels']=[];
            foreach($periods as $period){
                array_push($dates,$period->format('Y-m-d'));
                array_push($res['labels'],$period->format('m-d'));
            }
            $datas = Bill::select(array(
                    DB::raw('DATE(`created_at`) as `date`'),
                    DB::raw('SUM(`total`) as `total`')
                ))
                ->whereDate('created_at', '>', $from_date)
                ->groupBy('date')
                ->orderBy('date', 'DESC')
                ->get();

            $totals=[];
            foreach($dates as $date){
                $totals[$date]=0;
            }
            foreach($datas as $data){
                $totals[$data->date]=$data->total;
            }
            $res['data']= array();
            foreach($totals as $total){
                array_push($res['data'],$total);
            }

        }else{
            $res=self::__getMonthlySales();
        }
        $invoice=InvoiceResource::collection(Bill::whereDate('created_at','>=',$from_date)->whereDate('created_at','<=',$to_date)->get());
        $res['invoices']=$invoice;
        return json_encode($res);
    }

    public static function __getMonthlySales(){
        $dates=[
            date('Y-n', strtotime('-11 months')),
            date('Y-n', strtotime('-10 months')),
            date('Y-n', strtotime('-9 months')),
            date('Y-n', strtotime('-8 months')),
            date('Y-n', strtotime('-7 months')),
            date('Y-n', strtotime('-6 months')),
            date('Y-n', strtotime('-5 months')),
            date('Y-n', strtotime('-4 months')),
            date('Y-n', strtotime('-3 months')),
            date('Y-n', strtotime('-2 months')),
            date('Y-n', strtotime('-1 months')),
            date('Y-n')
        ];
        $res['labels']=[
                        date('M', strtotime('-11 months')),
                        date('M', strtotime('-10 months')),
                        date('M', strtotime('-9 months')),
                        date('M', strtotime('-8 months')),
                        date('M', strtotime('-7 months')),
                        date('M', strtotime('-6 months')),
                        date('M', strtotime('-5 months')),
                        date('M', strtotime('-4 months')),
                        date('M', strtotime('-3 months')),
                        date('M', strtotime('-2 months')),
                        date('M', strtotime('-1 months')),
                        date('M')
                    ];
        $date = Carbon::today()->subMonths(12);
        $datas = Bill::select(array(
                DB::raw('YEAR(created_at) year, MONTH(created_at) month'),
                DB::raw('SUM(`total`) as `total`')
            ))
            ->whereDate('created_at', '>', $date)
            ->groupBy('year','month')
            ->orderBy('year', 'DESC')
            ->orderBy('month', 'DESC')

            ->get();
        $totals=[];
        foreach($dates as $date){
            $totals[$date]=0;
        }

        foreach($datas as $data){
            $totals[$data->year.'-'.$data->month]=$data->total;
        }

        $res['data']= array();
        foreach($totals as $total){
            array_push($res['data'],$total);
        }

        return $res;
    }
    public static function __getOneDaySales($date){
        $dates=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24];
        $res['labels']=['1am','2am','3am','4am','5am','6am','7am','8am','9am','10am','11am','12am','1pm','2pm','3pm','4pm','5pm','6pm','7pm','8pm','9pm','10pm','11pm','12pm'];
        $datas = Bill::select(array(
                DB::raw('YEAR(created_at) year, MONTH(created_at) month, HOUR(created_at) hour'),
                DB::raw('SUM(`total`) as `total`')
            ))
            ->whereDate('created_at', '=', $date)
            ->groupBy('year','month','hour')
            ->orderBy('year', 'DESC')
            ->orderBy('month', 'DESC')
            ->get();
        $totals=[];
        foreach($dates as $date){
            $totals[$date]=0;
        }

        foreach($datas as $data){
            $totals[$data->hour]=$data->total;
        }

        $res['data']= array();
        foreach($totals as $total){
            array_push($res['data'],$total);
        }
        return $res;
    }


    protected function AllTimeBestSeller(){
        $max_count=5;
        $sales= KotItem::where('is_return',0)
                        ->select('item_id')
                        ->selectRaw('sum(quantity) as sum')
                        ->groupBy('item_id');

        $sold['alltime'] = $sales->get()->toArray();

        $returns_items= KotItem::groupBy('item_id')
            ->select('item_id')
            ->selectRaw('sum(quantity) as sum')
            ->where('is_return',1)
            ->get()
            ->toArray();
        //Calculate Return
        $returns=[];
        foreach($returns_items as $item){
            $returns[$item['item_id']]=$item['sum'];
        }
        //Calculate REturn
        $best_seller['alltime']=[];
        foreach($sold['alltime'] as $sale){
            if(isset($returns[$sale['item_id']])){
                $best_seller['alltime'][$sale['item_id']]=$sale['sum']-$returns[$sale['item_id']];
            }else{
                $best_seller['alltime'][$sale['item_id']]=$sale['sum'];

            }
        }
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
        $view= json_encode($best_sellers['alltime']);

        return $view;


    }

    public function LatestBestSeller(){
        $max_count=5;
        $sales= KotItem::where('is_return',0)
                        ->select('item_id')
                        ->selectRaw('sum(quantity) as sum')
                        ->groupBy('item_id','created_at');

        $sold['latest'] = $sales->orderBy('created_at','DESC')->get()->toArray();

        $best_seller['latest']=[];
         foreach($sold['latest'] as $sale){
            $best_seller['latest'][$sale['item_id']]=$sale['sum'];
        }

        $i=0;
        $best_sellers['latest']=[];
        foreach($best_seller['latest'] as $key=>$quantity){
            if($quantity>0){
                $menu_item= MenuItem::find($key);
                $best_sellers['latest'][]=['name'=>$menu_item->name,
                                            'quantity'=>$quantity];
                $i++;
                if($i>=$max_count)
                break;
            }
        }

        $view= json_encode($best_sellers['latest']);

        return $view;
    }


    public function MonthBestSeller(){
        $max_count=5;
        $sales= KotItem::where('is_return',0)
                        ->select('item_id')
                        ->selectRaw('sum(quantity) as sum')
                        ->groupBy('item_id','created_at');

        $sold['month'] = $sales->whereMonth('created_at', date('m'))->get()->toArray();
        $best_seller['month']=[];
         foreach($sold['month'] as $sale){
            $best_seller['month'][$sale['item_id']]=$sale['sum'];
        }
        arsort($best_seller['month']);
        $i=0;
        $best_sellers['month']=[];
        foreach($best_seller['month'] as $key=>$quantity){
            if($quantity>0){
                $menu_item= MenuItem::find($key);
                $best_sellers['month'][]=['name'=>$menu_item->name,
                                            'quantity'=>$quantity];
                $i++;
                if($i>=$max_count)
                break;
            }
        }

        $view= json_encode($best_sellers['month']);

        return $view;
    }

    public function YearBestSeller(){
        $max_count=5;
        $sales= KotItem::where('is_return',0)
                        ->select('item_id')
                        ->selectRaw('sum(quantity) as sum')
                        ->groupBy('item_id','created_at');

        $sold['year'] = $sales->whereYear('created_at', date('Y'))->get()->toArray();
        $best_seller['year']=[];
         foreach($sold['year'] as $sale){
            $best_seller['year'][$sale['item_id']]=$sale['sum'];
        }
        arsort($best_seller['year']);
        $i=0;
        $best_sellers['year']=[];
        foreach($best_seller['year'] as $key=>$quantity){
            if($quantity>0){
                $menu_item= MenuItem::find($key);
                $best_sellers['year'][]=['name'=>$menu_item->name,
                                            'quantity'=>$quantity];
                $i++;
                if($i>=$max_count)
                break;
            }
        }


        $view= json_encode($best_sellers['year']);

        return $view;
    }
}
