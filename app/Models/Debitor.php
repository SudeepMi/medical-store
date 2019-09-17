<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\CreditDetail;
class Debitor extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
        'phone',
        'email'];
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
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $string = '';
            $random_string_length = 5;
            $max = strlen($characters) - 1;
            for ($i = 0; $i < $random_string_length; $i++) {
                $string .= $characters[mt_rand(0, $max)];
            }
            $model->code='Deb'.time().$string;


        });

        static::updating(function($model)
        {
            $model->updated_by = Auth::user()->id;

        });

    }

    public function credit(){
        $credit= CreditDetail::where('is_credit_paid',0)->where('debitor_id',$this->id)->sum('amount');
        $credit_paid= CreditDetail::where('is_credit_paid',1)->where('debitor_id',$this->id)->sum('amount');

        return $credit-$credit_paid;
    }

    public function creditEntry(){
        return $this->hasMany('App\Models\CreditDetail' ,'debitor_id' ,'id');
    }
}
