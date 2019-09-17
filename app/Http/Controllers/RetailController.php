<?php

namespace App\Http\Controllers;

use App\Http\Requests\Retail\AddItemRequest;
use App\Models\Retail;
use App\Http\Requests\RetailDetailRequest;
use View;
use Symfony\Component\HttpFoundation\Request;

class RetailController extends Controller
{

    public function index()
    {
        $items = Retail::with('user')->get();
        return view('retail.index', compact('items'));
    }

    public function store(AddItemRequest $request)
    {
      if(Retail::create($request->all())){
          $this->create_log('create','retail');
          return redirect()->back();
      }

    }


    public function detail(RetailDetailRequest $request)
    {
        $retail = Retail::where('id',$request->id)->with('User')->first();
        $view= View::make('retail.components.info', [
            'retail' =>  $retail,
        ]);
        return $view;
    }
    public function updateStatus(Request $request){
        if($request->ajax()){
            $model = Retail::find(htmlspecialchars($request->id, ENT_QUOTES));
            $model->status = ($model->status == 0) ? 1 : 0;
            if($model->update()){
                $this->create_log ('change-status','software setting');
                return response()->json(['status' => 'success', 'successMsg' => 'Successfully Updated Item Status!']); die;
            }
            return response()->json(['status' => 'failed', 'errorMsg' => 'Something went wrong. Please try again!']);
        }
    }
}
