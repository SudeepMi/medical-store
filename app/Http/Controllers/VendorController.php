<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vendor\CreateVendorRequest as CreateDebitorRequest;
use App\Models\Vendor as Debitor;
use Sudeep\LogReader\LogReader;
use App\Http\Requests\Vendor\VendorDetailRequest as DebitorDetailRequest;
use View;
use App\Http\Requests\Payments\VendorPaymentRequest;
use App\Models\VendorPayment;


class VendorController extends Controller
{

    protected $debitor;

    public function __construct(LogReader $reader, Debitor $debitor)
    {
        parent::__construct ( $reader );
        $this->debitor = $debitor;
    }

    public function index(){
        $debitors = $this->debitor::with('User')->get();
      return view ('vendor.index',compact ('debitors'));
   }

   public function create(){
       return view ('vendor.create');
   }
   public function store(CreateDebitorRequest $request){

       $request->remaining_amount = $request->opening_amount;
        if ($this->debitor->create($request->all())) {
            $this->create_log ( 'create', 'debitor' );
            if (isset($request->ref)) {
                switch ($request->ref) {
                    case '0':
                    return redirect()->route('vendor.create');
                        break;

                    case '1':
                    return redirect()->route('vendor.index');
                        break;
                }
            }else{
            return redirect()->route('vendor.index');
            }

        }
    }

    protected function DebitorInfo($slug){
        $debitors = $this->debitor
        ->with('purchase')
        ->with('payments')->orderBy('created_at', 'DESC')
        ->where('slug',$slug)
        ->first();
        $debitors['total_cash'] =  (isset($debitors->purchase)) ? $debitors->purchase->sum('cash') : 0;
        $debitors['total_credit'] = (isset($debitors->purchase)) ? $debitors->purchase->sum('credit') + $debitors->opening_amount : $debitors->opening_amount;
        $debitors['amount_paid'] = (isset($debitors->payments)) ? $debitors->payments->sum('amount') : 0 ;

        return $debitors;
    }
    public function detail(DebitorDetailRequest $request){
        $slug = $request->slug;
        $debitors = $this->DebitorInfo($slug);
        $view= View::make('vendor.components.debitor-info', [
            'debitor' =>  $debitors,
        ]);
        return $view;
    }

    public function PurchaseDetail($slug){
       $info = $this->DebitorInfo($slug);
       $view= View::make('vendor.components.purchase-history', [
        'info' => $info,
    ]);
    return $view;
    }


    public function paymentWizard($slug){

        $info = $this->DebitorInfo($slug);
        $info['payments'] = (isset($info->payments)) ? $info->payments->all() : null;
        $name = $info->name;
        $id = $info->id;
        $slug = $info->slug;
        $payments = $this->MakePayment($info);
        $purchase = $this->PurchaseDetail($slug);
       return view('vendor.payments', compact('payments','name','id','purchase'));

    }

    protected function MakePayment($info){
        $view= View::make('vendor.components.payment-history', [
            'info' => $info,
        ]);
        return $view;
    }
    public function StorePayments(VendorPaymentRequest $request){
        $data['amount'] = $request->amount;
        $data['payment_mode'] = $request->method;
        $data['vendor_id'] = $request->id;
       $done =  VendorPayment::create($data);
       if ($done) {
          $this->create_log('create','payment');
          return redirect()->back();
       }
    }
}
