<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class MemberThreshold extends Model
{
    protected $fillable = [
        'threshold_id', 'member_id','created_by'
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
}
