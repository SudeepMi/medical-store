<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;
class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'pax', 
        'start', 
        'end', 
        'created_by',
        'is_foc',
        'is_discount',
        'discount_type',
        'discount_percent',
        'max_discount',
        'discount_by',
        'is_member',
        'member_id',
        'threshold_id'

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
            $model->start =  Carbon::now();
        });
    }
}
