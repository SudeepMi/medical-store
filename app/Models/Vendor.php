<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Auth;


class Vendor extends Model
{
    use Sluggable;

    protected $fillable = ['name','address','pan','email','phone','opening_amount','paid','remaining'];

    protected $hidden = [
        'created_by','id'
    ];
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public static function boot()
    {
        parent::boot();

        static::creating(function($model)
        {
            $model->created_by = Auth::user()->id;
        });

        static::updating(function($model)
        {
            $model->updated_by = Auth::user()->id;

        });

    }

    public function User(){
        return $this->belongsTo('App\Models\User','created_by','id');
    }

    public function purchase()
    {
        return $this->hasMany('App\Models\Stockpurchase','debitor_id','id');
    }

    public function payments(){
        return $this->hasMany('App\Models\VendorPayment','vendor_id','id');
    }
}
