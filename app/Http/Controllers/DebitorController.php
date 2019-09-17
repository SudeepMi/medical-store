<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debitor;
use App\Models\CreditDetail;
use View;
use App\Http\Resources\DebitorResource;
use DB;
class DebitorController extends Controller
{
    public function index(){
        $debtors=Debitor::all();
        return view('debtor.index')->with('debtors',$debtors);
    }
    public function create(){
        return view('debtor.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'email|required|unique:debitors|max:255',
            'phone' => 'required|unique:debitors|max:255',
        ]);
        $debitor=Debitor::create($request->all());
        if ($debitor) {
            if (isset($request->ref)) {
                switch ($request->ref) {
                    case '0':
                    return redirect()->route('debtor.create');
                        break;

                    case '1':
                    return redirect()->route('debtor.index');
                        break;
                }
            }else{
            return redirect()->route('debtor.index');
            }

        }
    }
    public function getDebitors(){
        $res=DebitorResource::collection(Debitor::all());
        return json_encode($res);
    }
    public function checkEmail(Request $request){
        if ($request->email) {
            $debitor=Debitor::where('email',$request->email)->first();
            if($debitor === null){
		        echo json_encode(TRUE); die;
            }
            else{
                echo json_encode(FALSE); die;
            }
		}
		echo json_encode(FALSE); die;
    }
    public function addDebitor(Request $request){
        $deditor=Debitor::create($request->all());
        $res['debitors']=DebitorResource::collection(Debitor::all());
        $res['selected']=$deditor->slug;
        return json_encode($res); die;
    }

    public function getCreditDetail(Request $request){
        $debitor=Debitor::find($request->id);
        if($debitor===null){
            $res['status']=false;
            $res['message']='No Such Debitor Found';

            return json_encode($res);
        }else{
            if($debitor->credit()>=1){
                $res['status']=true;
                $res['data']=new DebitorResource($debitor);
                return json_encode($res);
            }else{
                $res['status']=false;
                $res['message']=$debitor->name.' has no credit to be paid';
                return json_encode($res);


            }
        }
    }

    public function payCredit(Request $request){
        $debtor=Debitor::where('slug',$request->debtor_slug)->first();
        if($debtor===null){
            $res['status']=false;
            $res['message']="No Such Debtor found";
            $res['force_reload']=true;
        }else{
            $data['debitor_id']=$debtor->id;
            $data['amount']=$request->credit_payment;
            $data['is_credit_paid']=true;
            $data['description']='Credit paid'.$request->credit_payment;

            CreditDetail::create($data);

            $res['status']=true;
            $res['message']="Credit Paid";
            $res['remaining_credit']=$debtor->credit();
            $res['debtor']=$debtor;

            $res['force_reload']=false;

        }
        return json_encode($res);
    }

    public function getDetail(Request $request)
    {

        $debtor = Debitor::where('slug', $request->slug)->with('creditEntry')->first();
        $view = View::make('debtor.components.detail',[
            'debtor' => $debtor,
        ]);

        return $view;
    }
}
