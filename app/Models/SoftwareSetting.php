<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Auth;

class SoftwareSetting extends Model
{
    use Sluggable;

    protected $fillable = [
       'name', 'value', 'created_by', 'slug', 'status'
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
}
