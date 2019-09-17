<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Auth;

class Retail extends Model
{
    use Sluggable;

   protected $fillable = ['name','slug','price','description','quantity'];

   protected $table = 'retail_items';

   protected $hidden = ['id','created_by'];

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

    public function user()
    {
       return $this->belongsTo('App\Models\User','created_by','id');
    }



}
