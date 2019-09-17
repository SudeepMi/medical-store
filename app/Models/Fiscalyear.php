<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fiscalyear extends Model
{
   protected $fillable = ['from_year','to_year'];

   protected $table = "fiscal_years";
}
