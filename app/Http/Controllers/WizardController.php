<?php

namespace App\Http\Controllers;


use App\Models\Fiscalyear;
use App\Models\SoftwareSetting;
use App\Http\Requests\Wizard\WizardRequest;
use Illuminate\Http\Request;


class WizardController extends Controller
{
    private $fiscal_year;


    public function __construct(Fiscalyear $fiscal_year){
        $this->fiscal_year = $fiscal_year;
        session()->forget('datas');

    }
    public function wizard()
    {
    	return view('setup');
    }

    protected $counter;

    protected $infos;


    public function store(WizardRequest $request){

        $data = $request->except('from_year','to_year');
        $data['is_shown'] = 1;
       foreach($data as $name => $value){
           $bag['name'] = implode(' ',explode('_',$name));
           $bag['value'] = $value;
           SoftwareSetting::create($bag);
       }
       Fiscalyear::create($request->only('from_year','to_year'));
       return redirect()->route('home');


    }
    // protected function makeform($rank){
    //     switch ($rank) {
    //         case '0':
    //             return '<div class="col-lg-6">
    //             <div class="form-group">
    //                 <div class="form-holder">
    //                     <label>Company Name:</label>
    //                     <input type="text" class="form-control" required name="name in bill" id="name" placeholder="Company Name">
    //                 </div>
    //                <div class="hidden" id="rank" data-rank="1"></div>
    //                 <label>Address:</label>
    //                 <div class="form-holder">
    //                      <input type="text" class="form-control" required name="address in bill" id="address" placeholder="Address">
    //                               </div>
    //                             </div>';
    //             break;
    //             case '1':
    //             return '<div class="col-lg-6"><div class="form-group"><div class="form-holder">
    //             <div class="hidden" id="rank" data-rank="2"></div><label>Reg No:</label><input type="number" class="form-control" required name="vat no in bill" id="reg_no" placeholder="Reg No.">
    //           </div><div class="form-holder"><label>Phone:</label><input type="tel" class="form-control" name="phone no in bill" required id="phone">
    //             </div></div>';
    //             break;

    //             case '2':
    //             return '<div class="col-lg-6"><div class="form-group">
    //             <div class="form-holder">
    //                 <label>From:</label>
    //                 <input type="text" class="form-control" required name="from_year" id="from">
    //             </div>
    //             <div class="hidden" id="rank" data-rank="3">
    //             <label>To:</label>
    //             <div class="form-holder">
    //                 <input type="text" class="form-control" name="to_year" required id="to">
    //                           </div>
    //         </div></div>';
    //             break;

    //             case '3':
    //             return '<div class="col-lg-6"><div class="form-group">
    //             <label>Thankyou Note In Bill:</label>
    //             <textarea name="thank you note in bill" class="form-control" required></textarea>
    //             </div>
    //             <div class="form-group row">
    //             <div class="form-holder w-100">
    //             <div class="hidden" id="rank" data-rank="4">
    //                 <label for="dp3">Currency:</label>
    //                 <select class="form-control" id="currency" name="currency">
    //                     <option value="usd">USD</option>
    //                     <option value="aud">AUD</option>
    //                     <option value="npr">NPR</option>
    //                 </select>
    //             </div>
    //         </div></div>';

    //             case '4':
    //             return $this->save();
    //         default:
    //            return "failed";
    //             break;
    //     }
    // }





    public function save(){
        $data = $this->getData();
        foreach($data as $key=>$value){
            $bag['name'] = $key;
            $bag['value'] = $value;

        }
        return "ok";

    }

}
