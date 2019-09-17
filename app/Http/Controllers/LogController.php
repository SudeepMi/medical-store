<?php

namespace App\Http\Controllers;

use App\Http\Requests\Log\logfilterbyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Sudeep\LogReader\LogReader;

class LogController extends Controller
{
    public function __construct(LogReader $reader)
    {
        parent::__construct ( $reader );
    }

    public function LogClass()
    {
        return $this->reader->getclasses();
    }


    public function filter_by(Request $request)
    {
        $class = $request->classes;
        if ($class == "all"){
         $data = $this->get_logs();

        }else {
            $data = $this->get_by_class( $class );
        }

        if(isset($request->from) && isset($request->to)){
            $request->validate([
                'from' => 'date',
                'to' => 'date',
            ]);
          $data = $this->by_date($request->from,$request->to,$data);
        }
        return json_encode($data);
    }


    public function activity(logfilterbyRequest $request)
    {
        $data = $this->get_logs();
        $classes =array_unique( $this->LogClass());
        if(isset($request->from) && isset($request->to)){
          $data = $this->by_date($request->from,$request->to,$data);
        }
      return view('log/logs',compact('data','classes'));
    }



    protected function by_date( $from, $to,$logs){

        $filtered=array();
        $from = Carbon::parse($from);
        $to = Carbon::parse($to);
        foreach ($logs as $key) {

            if (($to->greaterThanOrEqualTo(Carbon::parse($key->date))) && ($from->lessThanOrEqualTo(Carbon::parse($key->date)))) {
               $filtered[] = $key;
            }
        }
     return $filtered;
    }

}
