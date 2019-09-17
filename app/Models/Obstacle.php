<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Cviebrock\EloquentSluggable\Sluggable;

class Obstacle extends Model
{
    use Sluggable;

    protected $fillable = [
       'uuid','name', 'slug', 'status', 'created_by','is_occupied','x_pos', 'y_pos', 'width', 'height', 'floor_id', 'start_time','order_id'
    ];
    protected $hidden = [
        'created_by','id'
    ];
    protected $casts = [
        'start_time' => 'datetime',
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
}
