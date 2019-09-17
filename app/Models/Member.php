<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Member;
class Member extends Model
{
    use Sluggable;
    protected $fillable = [
        'name', 'slug', 'membership_no','email', 'phone','type','membership_fee','dob','issued_at','expires_at','created_by'
    ];
    protected $hidden = [
        'created_by','id'
    ];
    protected $dates = [
        'issued_at','expires_at','dob'
    ];
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function thresholds()
    {
        return $this->hasManyThrough(
            'App\Models\Threshold', 
            'App\Models\MemberThreshold',
            'member_id',    // Foreign key on MemberThreshold table...
            'id', // Foreign key on Threshold table...
            'id',   // Local key on Member table...
            'id'   // Local key on MemberThreshold table...
        );
    }
    public static function boot(){
        parent::boot();

        static::creating(function($model)
        {
            $model->created_by = Auth::user()->id;
            
            $max_member=Member::latest('id')->first();
            if($max_member===null)
            {
               $model->membership_no = '0001';
            }
            else{
                $max_membership_no= $max_member->membership_no;
                $count=$max_membership_no+1;
                $model->membership_no = str_pad($count, 4, "0", STR_PAD_LEFT);
            }


        });
    }
}
