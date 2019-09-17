<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\Kot;
class Kot extends Model
{
    protected $fillable = [
        'order_id', 'created_by','display_number', 'is_return','description'
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
             $max_kot=Kot::latest()->first();
             if($max_kot===null){
                $prefix=date('y').date('m').date('d');
                $model->display_number = $prefix.'-1';
             }else{
                $today=date('y').date('m').date('d');
                $max_kot_display_number= explode("-", $max_kot->display_number);

                if($max_kot_display_number[0]==$today){//Today
                    $prefix=$today;
                    $count=$max_kot_display_number[1]+1;
                }else{ //New
                    $prefix=$today;
                    $count=1;

                }
                $model->display_number = $prefix.'-'.$count;
             }

         });       
     }
    public function items(){
        return $this->hasMany('App\Models\KotItem','kot_id','id');
    }
    public function order(){
        return $this->belongsTo('App\Models\Order','order_id','id');
    }
    public function table(){
        return $this->belongsTo('App\Models\Table','order_id','order_id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User','created_by','id');
    }
}
