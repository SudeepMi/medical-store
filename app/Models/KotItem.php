<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class KotItem extends Model
{
    
    protected $fillable = [
        'kot_id', 'item_id','quantity','is_return'
     ];
     protected $hidden = [
         'kot_id', 'id'
     ];
    public function item(){
        return $this->belongsTo('App\Models\MenuItem', 'item_id', 'id');
    }


}
