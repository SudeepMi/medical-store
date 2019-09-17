<?php

namespace App\Models;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Utensil extends Model
{
    use sluggable;

    protected $fillable = [
         'name', 'slug', 'quantity','status', 'created_by'
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

    public static function boot(){
        parent::boot();

        static::creating(function($model)
        {
            $model->created_by = Auth::user()->id;

        });
    }
    public function user(){
        return $this->belongsTo('App\Models\User','created_by','id');
    }

    public function adjustment(){
        return $this->hasMany('App\Models\UtensilEntry','utensil_id','id')->where('is_opening_stock',0);
    }
    public function opening_count(){
        return $this->hasMany('App\Models\UtensilEntry' ,'utensil_id' ,'id')->where('is_opening_stock',1)->where('stock_in','!=',0);
    }
}
