<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bill\StoreBillDesignRequest;
use Illuminate\Http\Request;
use DB;
use App\Models\DesignInvoice;

class DesignController extends Controller
{
    public function index()
    {
        $settings = [];
        $data = "'name-in-bill','address-in-bill','phone-no-in-bill','vat-no-in-bill','thank-you-note-in-bill'";
        $software_settings = DB::select( DB::raw("SELECT * FROM `software_settings` WHERE `slug` IN ($data)"));
        foreach($software_settings as $row){
            $settings[$row->slug] = trim($row->value);
            $settings[$row->slug . '-is-active'] = $row->status;
        }
        $config = DesignInvoice::find(1);


        return view('design-invoice.index', compact('settings', 'config'));
    }

    public function store(StoreBillDesignRequest $request)
    {
        if($request->ajax()){
            $model = DesignInvoice::find(1);
            if($model) {
                $model->show_customer_name      = $request->isCustomerName;
                $model->show_pan_no             = $request->isCustomerPan;
                $model->show_amount_text        = $request->isCustomerAddress;
                $model->show_greeting_note      = $request->isBillAmount;
                $model->show_operator_name      = $request->isBillGreetingNote;
                $model->show_customer_address   = $request->isOperatorName;
                $model->last_updated_by         = auth()->user()->id;
                if($model->update()) {
                    $this->create_log ('update','invoice design');
                    return response()->json(['status' => 'success', 'successMsg' => 'Successfully Updated Setting Status!']); die;
                }
                return response()->json(['status' => 'failed', 'errorMsg' => 'Something went wrong. Please try again!']);
            }
        }
    }
}
