<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\Bill;
class Bill extends Model
{

    protected $fillable = [
        'order_id',
        'customer_name',
        'customer_pan',
        'customer_phone',
        'customer_address',
        'pax',
        'is_discount',
        'discount_percent',
        'discount_amount',
        'discount_type',
        'is_member',
        'member_id',
        'threshold_id',

        'is_service_charge',
        'service_charge_percent',
        'service_charge_amount',
        'sub_total',
        'sub_total_with_discount',
        'sub_total_with_sc',
        'total',
        'advance',
        'advance_detail',

        'print_count',
        'received',
        'return',
        'tip',
        'round',
        'payment_type'
        
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
            $max_bill=Bill::latest('id')->first();
            if($max_bill===null)
            {
               $prefix=date('y').date('m').date('d');
               $model->bill_no = $prefix.'-1';
            }
            else{
               $today=date('y').date('m').date('d');
               $max_bill_no= explode("-", $max_bill->bill_no);

               if($max_bill_no[0]==$today){//Today
                   $prefix=$today;
                   $count=$max_bill_no[1]+1;
               }else{ //New
                   $prefix=$today;
                   $count=1;

               }
               $model->bill_no = $prefix.'-'.$count;
            }


        //Amount in word       
            $model->total_in_word=self::convertNumberToWord($model->total);

        //Amount in word


        });

        static::updating(function($model)
        {
            $model->updated_by = Auth::user()->id;

        });

    }
    public function User(){
        return $this->belongsTo('App\Models\User','created_by','id');
    }
    public function items(){
        return $this->hasMany('App\Models\BillItem','bill_id','id');
    }

    public static function convertNumberToWord($num = false)
    {
        $num = str_replace(array(',', ' '), '' , trim($num));
        if(! $num) {
            return false;
        }
        $num = (int) $num;
        $words = array();
        $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
            'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
        );
        $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
        $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
            'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
            'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
        );
        $num_length = strlen($num);
        $levels = (int) (($num_length + 2) / 3);
        $max_length = $levels * 3;
        $num = substr('00' . $num, -$max_length);
        $num_levels = str_split($num, 3);
        for ($i = 0; $i < count($num_levels); $i++) {
            $levels--;
            $hundreds = (int) ($num_levels[$i] / 100);
            $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
            $tens = (int) ($num_levels[$i] % 100);
            $singles = '';
            if ( $tens < 20 ) {
                $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
            } else {
                $tens = (int)($tens / 10);
                $tens = ' ' . $list2[$tens] . ' ';
                $singles = (int) ($num_levels[$i] % 10);
                $singles = ' ' . $list1[$singles] . ' ';
            }
            $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
        } //end for loop
        $commas = count($words);
        if ($commas > 1) {
            $commas = $commas - 1;
        }
        return implode(' ', $words);
    }
}
