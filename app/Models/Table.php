<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Table;
class Table extends Model
{
    use Sluggable, SoftDeletes;
    protected $fillable = [
       'uuid','name', 'slug', 'status', 'created_by','is_occupied','x_pos', 'y_pos', 'floor_id', 'start_time','order_id','height','width'
    ];
    protected $hidden = [
        'created_by','id', 'deleted_at'
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
            $max_table=Table::orderBy('id', 'desc')->first();
            if($max_table===null){               
                $number =1;
            }else{
                $count=$max_table->number;
                $number=$count+1;
            }
            $model->number =$number;

        });
    }

    public function order() {
        return $this->belongsTo('App\Models\Order','order_id','id');
    }

    public function floor() {
        return $this->belongsTo('App\Models\Floor','floor_id','id');
    }

    public function next_booked_table() {
        return $this->hasOne('App\Models\BookedTable','table_id','id')->where('status', 1)->whereDate('booking_date', '=', date('Y-m-d'))->whereDate('start_time', '>=', date('H:i:s'));
    }

    public function booked_table() {
        return $this->hasMany('App\Models\BookedTable','table_id','id')->where('status', 1)->whereDate('booking_date', '=', date('Y-m-d'))->whereDate('start_time', '>=', date('H:i:s'))->orderBy('start_time', 'ASC');
    }

    public function today_booked_table() {
        return $this->hasMany('App\Models\BookedTable','table_id','id')->where('status', 1)->whereDate('booking_date', '=', date('Y-m-d'))->whereDate('start_time', '>=', date('H:i:s'));
    }

    public function booking_history() {
        return $this->hasMany('App\Models\BookedTable','table_id','id')->orderByRaw("booking_date DESC, start_time DESC");
    }
}
