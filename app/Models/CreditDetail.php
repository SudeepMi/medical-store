<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditDetail extends Model
{
    protected $fillable = [
        'debitor_id',
        'is_credit_paid',
        'amount',
        'description'
    ];
}
