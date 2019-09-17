<?php

namespace App\Http\Controllers;
use Sudeep\LogReader\LogReader;
use Illuminate\Http\Request;
use App\Models\SoftwareSetting;
use App\Models\DesignInvoice;

class BillController extends Controller
{

    public function __construct(LogReader $reader)
    {
        parent::__construct ( $reader );
    }
    public function getCompanyDetails(){
        $values= SoftwareSetting::all();
        $details=[];
        foreach($values as $value){
            $details[$value->slug]=$value->value;
        }
        return $details;
    }

    public function getBillLayout(){
        $design= DesignInvoice::first();
        $details= $this->getCompanyDetails();

        $res['company_name']=$details['name-in-bill'];
        $res['company_address']=$details['address-in-bill'];
        $res['company_phone']=$details['phone-no-in-bill'];
        $res['company_reg_no']=$details['vat-no-in-bill'];
        $res['show_customer_name']=$design->show_customer_name;
        $res['show_customer_pan']=$design->show_pan_no;
        $res['show_customer_address']=$design->show_customer_address;
        $res['show_customer_phone']=$design->show_customer_name;
        $res['show_greeting']=$design->show_greeting_note;
        $res['greeting_note']=$details['thank-you-note-in-bill'];

        $res['show_amount_in_word']=$design->show_amount_text;
        $res['show_sales_by']=$design->show_operator_name;
        return $res;
    }
}
