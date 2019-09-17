<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class VendorPayment extends Model
{
   protected $fillable = ['vendor_id','amount','payment_mode','refrence_no','made_by'];

   protected $dates = ['created_at','updated_at'];

   protected $table = "vendor_payments";

   public static function boot()
    {
        parent::boot();

        static::creating(function($model)
        {
            $model->made_by = Auth::user()->id;
            $model->refrence_no = time()."-".rand(2,10);

        });
    }
    public function User(){
        return $this->belongsTo('App\Models\User','made_by','id');
    }



}
