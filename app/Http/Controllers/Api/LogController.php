<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Traits\Logs;
use Illuminate\Support\Carbon;

class LogController extends ApiController{
use Logs;

public function TodayLog(){
    $log =  $this->today_log();
    foreach($log as $l){
        $l->time = Carbon::parse ($l->date)->format ('H:i');
    }
    $view = json_encode($log);

    return $view;
}


}



