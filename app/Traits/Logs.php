<?php

namespace App\Traits;


use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Sudeep\LogReader\LogReader;


trait Logs
{
    protected $reader;

    protected $level='info';

    protected $message='';

    protected $size = '';

    protected $classes;

    protected $filename = '';

    private $user;

    public function __construct(LogReader $reader)
    {
        clearstatcache();
        $this->reader = $reader;

    }

    protected function getFileSize(){
        $file = storage_path ('logs/audits/audit.log');
        $this->filename = $file;
        if (is_file ($file)) {
           $this->size = filesize($file);
        }
        return $this;
    }

    public function create_log($action,$class)
    {
        $this->getFileSize ();
      if($this->size >= 5242880){
          $new = storage_path ('/logs/audits/'.time().'audit.log');
          rename ($this->filename, $new);
      }
        $this->build_log($action,$class);
       return Log::channel('audit')->{$this->level}( $this->message);

    }

    public function get_logs(){
       
        $log = $this->reader
            ->orderBy('date', 'desc')
            ->get();
        return $log;
    }

    public function log_type($for = null){
        return array(
          "logout" => array(
            "level" => "warning",
            "message" => "logged out",
          ),
          "login" => array(
              "level" => "info",
              "message" => "logged in",
          ),
          "create" => array(
              "level" => "notice",
              "message" => "created"." ".$for,
          ),
        "update" => array(
            "level" => "notice",
            "message" => "updated"." ".$for,
        ),
        "delete" => array(
            "level" => "alert",
            "message" => "deleted"." ".$for,
        ),
        "add"   => array(
            "level" => "notice",
            "message" => "added"." ".$for,
        ),
        "purchase"   => array(
            "level" => "notice",
            "message" => "Purchased"." ".$for,
        ),
        "distribute" => array(
            "level" => "notice",
            "message" => "Distributed"." ".$for,
        ),
        "change status" => array(
            "level" => "notice",
            "message" => "changed status of"." ".$for,
        ),
        "recieve" => array(
            "level" => "notice",
            "message" => "recieved"." ".$for,
        ),
//            "create" => array(
//                "level" => "motice",
//                "message" => "created"." ".$class,
//            ),
        );
    }

    public function build_log($action,$class){
        if (array_key_exists($action,$this->log_type())) {
            $log_component = $this->log_type($class)[$action];
            $this->message =$class."|".$log_component['message'] .= " by " . Auth()->user()->username;
            $this->level = $log_component['level'];
            return $this;
        }
    }

    public function get_by_class($class)
    {

        $logs = $this->reader
            ->filename('audit.log')
            ->class($class)
            ->orderBy ('date','desc')
            ->get();
       return $logs;
    }


    public function today_log(){
        $alllogs = $this->get_logs ();
        $today = array();
        $i = 1;
        foreach($alllogs as $logs){
            $i++;
            if ($logs->date->format('Y-m-d') == Carbon::today()->format('Y-m-d') && $i <= 10){
            $message = $logs->context->message;
            $broked = explode ( ' ', $message);
            $logs->user = end ($broked);
            array_splice ($broked,-1);
            $logs->message = ucfirst(implode(' ',$broked));
                $today[] = $logs;
            }
        }
       return $today;
    }

}
