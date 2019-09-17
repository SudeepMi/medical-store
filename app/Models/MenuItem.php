<?php

namespace App\Models;
use Auth;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class MenuItem extends Model
{
    use Sluggable;

    protected $fillable = [
        'weight', 'is_special', 'code', 'menu_category_id', 'name', 'slug', 'price', 'image' ,'description', 'is_discountable','status','discount', 'created_by'
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
        {   $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $string = '';
            $random_string_length = 2;
            $max = strlen($characters) - 1;
            for ($i = 0; $i < $random_string_length; $i++) {
                $string .= $characters[mt_rand(0, $max)];
            }
            $model->code='M'.time().$string;
            $model->created_by = Auth::user()->id;
           
        });      
        static::updating(function($model)
        {   
            if(Auth::user()){
                $model->updated_by = Auth::user()->id;
            }
            
        });

    }
    public function category(){
        return $this->belongsTo('App\Models\MenuCategory','menu_category_id','id');
    }
    public function stock_items(){
        return $this->belongsToMany('App\Models\Stock','menu_item_stocks')->withPivot('quantity');
    }
    public function sales(){
        return $this->hasMany('App\Models\KotItem', 'item_id', 'id')->where('is_return',0);
    }
}
