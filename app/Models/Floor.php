<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Cviebrock\EloquentSluggable\Sluggable;

class Floor extends Model
{
    use Sluggable;

    protected $fillable = [
       'name', 'slug', 'status', 'display_order', 'created_by'
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
        });
    }

    public function active_tables(){
        return $this->hasMany('App\Models\Table');
    }

    public function active_objects(){
        return $this->hasMany('App\Models\Obstacle');
    }
}
