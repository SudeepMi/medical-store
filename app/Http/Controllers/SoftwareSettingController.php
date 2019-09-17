<?php

namespace App\Http\Controllers;

use App\Http\Requests\System\StoreSettingRequest;
use App\Http\Requests\System\UpdateSettingRequest;
use Illuminate\Http\Request;
use App\Models\SoftwareSetting;
use Validator;

class SoftwareSettingController extends Controller
{
    public function index()
    {
        $settings = SoftwareSetting::orderBy('created_at', 'DESC')->get();
        return view('software-setting.index', compact('settings'));
    }

    public function store(StoreSettingRequest $request)
    {
        $model = SoftwareSetting::create([
            'name' => $request->name,
            'value' => $request->value,
            'status' => 1
        ]);
        if ($model){
           $this->create_log ('create','software setting');
           return redirect()->back();
        }
    }
    public function quickUpdate(Request $request){
        $software_setting=SoftwareSetting::where('slug',$request->key)->first();
        $software_setting->value= $request->value?1:0;
        $software_setting->update();
        // return $request;
    }
    public function update(UpdateSettingRequest $request)
    {
        $model = SoftwareSetting::find($request->id);
        if($model) {
            $model->value = $request->value;
            if($model->update()) {
                $this->create_log ('update','software setting');
                return redirect()->back();
            }
            return redirect()->back();
        }

    }

    public function status(Request $request)
    {
        if($request->ajax()){
            $model = SoftwareSetting::find(htmlspecialchars($request->id, ENT_QUOTES));
            $model->status = ($model->status == 0) ? 1 : 0;
            if($model->update()){
                $this->create_log ('change-status','software setting');
                return response()->json(['status' => 'success', 'successMsg' => 'Successfully Updated Setting Status!']); die;
            }
            return response()->json(['status' => 'failed', 'errorMsg' => 'Something went wrong. Please try again!']);
        }
    }
}
