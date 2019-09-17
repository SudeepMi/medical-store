<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Sluggable;

class Stock extends Model
{
    use Sluggable;

	protected $table = 'stock_items';
    protected $fillable = [
       'item_code', 'name', 'is_active', 'created_by','rate'
    ];
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
            $model->item_code = "S".Str::random(4).time();
        });
    }
    public function user(){
        return $this->belongsTo('App\Models\User','created_by','id');
    }
    public function entries(){
        return $this->belongsTo('App\Models\User','created_by','id');
    }
    public function purchases(){
        return $this->hasMany('App\Models\StockEntry' ,'stock_id' ,'id')->where('is_adjustment',0)->where('is_opening_stock',0)->where('stock_out',0);
    }

    public function latest(){
        return $this->hasMany('App\Models\StockEntry' ,'stock_id' ,'id')->where('is_opening_stock',0)->where('stock_out',0)->latest();
    }
    public function sales(){
        return $this->hasMany('App\Models\StockEntry' ,'stock_id' ,'id')->where('is_opening_stock',0)->where('stock_in',0);
    }

    public function opening_stock(){
        return $this->hasMany('App\Models\StockEntry' ,'stock_id' ,'id')->where('is_opening_stock',1)->where('stock_in','!=',0);

    }
    public function adjustment(){
        return $this->hasMany('App\Models\StockEntry' ,'stock_id' ,'id')->where('is_adjustment',1);

    }


}
