<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItemStock extends Model
{
    protected $fillable = [
        'menu_item_id', 'stock_id', 'quantity'];
     protected $hidden = [
         'created_by','id'
     ];
}
