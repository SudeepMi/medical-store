<?php

namespace App\Http\Controllers;


use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\Logs;
use Sudeep\FormParser\FormParse;


class Controller extends BaseController
{
    use Logs;
    use FormParse;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



}
