<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bill;
class BillItem extends Model
{
    protected $fillable = [
        'bill_id', 'item_id','quantity'
     ];
     protected $hidden = [
         'bill_id', 'id'
     ];
    public function item(){
        return $this->belongsTo('App\Models\MenuItem', 'item_id', 'id');
    }
}
