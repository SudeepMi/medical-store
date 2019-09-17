<?php

namespace App\Traits;
use Validator;

trait Helper{

    // protected function ExtractAjaxData($ajaxData)
    // {
    //     $data = json_decode($ajaxData->data);
    //     foreach($data as $v){
    //         $new[$v->name] = $v->value;
    //     }
    //     return $new;
    // }

    protected function Validates($data, $rules){

        $rule = (is_array($rules)) ? $rules : $rules->rules();
        Validator::make($data, $rule)->validate();

    }
}
