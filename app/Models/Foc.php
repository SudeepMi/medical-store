<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;
use App\Models\Foc;
class Foc extends Model
{
    // $table->string('foc_no');            
    // $table->string('customer_phone')->nullable();
    // $table->string('customer_name')->nullable();
    // $table->string('customer_pan')->nullable();
    // $table->string('customer_address')->nullable();
    // $table->integer('pax');
    // $table->integer('order_id');

    // //Total
    // $table->integer('sub_total')->default(0);            
    // //Total
    // $table->integer('print_count')->default(0);
    // $table->integer('created_by')->default(0);
    protected $fillable = [
        'order_id',
        'customer_name',
        'customer_pan',
        'customer_phone',
        'customer_address',
        'pax',
        'sub_total',
        'print_count',
        'payment_type'
        
    ];

    protected $hidden = [
        'created_by','id'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function($model)
        {
            $model->created_by = Auth::user()->id;
            $max_foc=Foc::latest('id')->first();
            if($max_foc===null)
            {
               $prefix=date('y').date('m').date('d');
               $model->foc_no = $prefix.'-1';
            }
            else{
               $today=date('y').date('m').date('d');
               $max_foc_no= explode("-", $max_foc->foc_no);

               if($max_foc_no[0]==$today){//Today
                   $prefix=$today;
                   $count=$max_foc_no[1]+1;
               }else{ //New
                   $prefix=$today;
                   $count=1;

               }
               $model->foc_no = $prefix.'-'.$count;
            }


        });

        static::updating(function($model)
        {
            $model->updated_by = Auth::user()->id;

        });

    }
    public function User(){
        return $this->belongsTo('App\Models\User','created_by','id');
    }
}
