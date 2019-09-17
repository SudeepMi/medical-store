<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stockpurchase extends Model
{
    protected $table = "stock_purchase";

    protected $fillable = ['debitor_id', 'item_id','invoice','total','cash','credit'];

    protected $dates = ['created_at','updated_at'];

    public function debitor(){
        return $this->belongsTo('App\Models\Vendor','debitor_id','id');
    }

    public function stock_item(){
        return $this->hasMany('App\Models\StockEntry','purchase_id','id');
    }

}
