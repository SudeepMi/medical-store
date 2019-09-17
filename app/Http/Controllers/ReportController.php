<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use Carbon\Carbon;
class ReportController extends Controller
{
    public function sales(Request $request){
        if(request()->daterange){
            $actual_filter=explode(" - ", request()->daterange);
            $startdate= explode("/", $actual_filter[0]);
            $enddate= explode("/", $actual_filter[1]);        
        
            $date['start_date'] = Carbon::create($startdate[2],$startdate[0],$startdate[1],0,0,0);
            $date['end_date'] = Carbon::create($enddate[2],$enddate[0],$enddate[1],0,0,0);

        }else{
            $date['start_date'] = Carbon::now();
            $date['end_date'] = Carbon::now();
        }
        
        
        return view('report.sales',compact('date'));
    }
}
