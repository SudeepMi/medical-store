<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class StockEntry extends Model
{

    protected $fillable = [
        'is_opening_stock', 'is_adjustment', 'stock_id', 'stock_in', 'stock_out', 'remarks', 'created_by','rate','purchase_id'
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
         });
     }
    public function stock(){
        return $this->belongsTo('App\Models\Stock','stock_id','id');
    }

    public function purchase(){
        return $this->belongsTo('App\Models\Stockpurchase','purchase_id','id');
    }
}
