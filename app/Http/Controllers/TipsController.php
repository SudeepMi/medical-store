<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tips\TipsDetailRequest;
use App\Models\Tip;
use App\Http\Requests\Tips\TipsDistributeRequest;
use Illuminate\Http\Request;
use View;

class TipsController extends Controller
{
    private $tip;

    private $total_tip;

    private $total_recived;

    private $total_distributed;

    public function __construct(Tip $tip){
        return $this->tip = $tip;
    }
    public function index(){
       $amount = $this->total();
        $tips = $this->tip->orderBy('id', 'ASC')->get();
        $cv =0;
        foreach($tips as $tip):
            if($tip->is_distributed ==1){
                $tip->tip_amount = -($tip->tip_amount);
            }
        endforeach;

        return view('tip.index',compact('tips','amount'));
    }
    private function recieved(){
       return $this->total_recived =  $this->tip->where('is_distributed',0)->sum('tip_amount');
    }

    private function distributed(){
        return $this->total_distributed =  $this->tip->where('is_distributed',1)->sum('tip_amount');
     }

     private function total(){

         return $this->total_tip = ($this->recieved()) - ($this->distributed());
     }

    public function store(TipsDistributeRequest $request){
        $this->tip->is_distributed = 1;
        $this->tip->tip_amount = $request->tip_amount;
        $this->tip->remarks = $request->remarks;
      if($this->tip->save()){
          $this->create_log('distribute','tips');
      }
       return redirect()->back();
    }

    public function details(TipsDetailRequest $request){
        $tips = $this->tip->where('id',$request->id)->first();
        $view= View::make('tip.components.tips-info', [
            'tips' =>  $tips,
        ]);
        return $view;
    }

    public function addTips(Request $request){
       $request = $this->getObj($request);
       $this->tip->is_distributed = 0;

       $this->tip->tip_amount = $request->request->tip_amount;
       $this->tip->remarks = $request->request->remarks;
     if($this->tip->save()){
            $this->create_log ('recieve','tips');
            return response()->json(['status' => 'success', 'successMsg' => 'Successfully Added Tips !']); die;
        }
        return response()->json(['status' => 'failed', 'errorMsg' => 'Something went wrong. Please try again!']);
    }

}
