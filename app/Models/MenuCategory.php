<?php

namespace App\Models;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class MenuCategory extends Model
{
    use Sluggable;

    protected $fillable = [
        'is_special','prefix', 'name', 'description','status','is_discountable','discount'
    ];
    protected $hidden = [
        'created_by', 'id'
    ];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
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

            $name = explode(" ", $model->name);
            $prefix = "";

            foreach ($name as $w) {
                $prefix .= $w[0];
            }
            $model->prefix = $prefix;

        });       
    }
    public function items(){
        return $this->hasMany('App\Models\MenuItem','menu_category_id','id')->where('status',1)->orderBy('weight','DESC');
    }
}
