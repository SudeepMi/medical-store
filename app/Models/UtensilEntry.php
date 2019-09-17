<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class UtensilEntry extends Model
{
    protected $fillable = ['is_opening_stock','utensil_id','stock_in','stock_out','remarks'];

    protected $table = 'utensil_entries';
    public static function boot(){
        parent::boot();

        static::creating(function($model)
        {
            $model->created_by = Auth::user()->id;

        });
    }

}
