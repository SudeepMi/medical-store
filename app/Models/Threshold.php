<?php

namespace App\Models;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Threshold extends Model
{

    // $table->string('name');
    // $table->text('detail');
    // $table->boolean('status')->default(1);
    // $table->integer('created_by');
    // $table->integer('updated_by');
    use Sluggable;
    protected $fillable = [
        'name','detail','slug'
    ];
    protected $hidden = [
        'updated_by','created_by','id'
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
            $model->updated_by = Auth::user()->id;

        });

        static::updating(function($model)
        {
            $model->updated_by = Auth::user()->id;
        });

    }
}
