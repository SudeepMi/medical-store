<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Tip extends Model
{
    protected $fillable = [
        'tip_amount', 'remarks', 'created_by','is_distributed',
     ];

     public static function boot()
     {
         parent::boot();

         static::creating(function($model)
         {
             $model->created_by = Auth::user()->id;

         });
     }

     public function user(){
        return $this->belongsTo('App\Models\User','created_by','id');
    }

}
