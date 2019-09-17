<?php

namespace App\Http\Controllers;
use App\Models\Member;
use App\Models\Threshold;
use App\Models\MemberThreshold;
use View;
use Illuminate\Http\Request;
use Validator;
use Auth;
class MemberController extends Controller
{
    public function index(){
        $members=Member::all();
        return view('membership.index')->with('members',$members);

    }
    public function create(){
        $thresholds=Threshold::all();

        return view('membership.create')
                ->with('thresholds',$thresholds);
    }
    public function store(Request $request){

        $rules=[
            'thresholds' => '',
            'thresholds.*' => 'required',
            'name' => 'required',
            'email' => 'email|required|unique:members|max:255',
            'phone' => 'required|unique:members|max:255',
            'type' => 'required',
            'membership_fee' => 'required_if:type,1|numeric|min:1',
            'expires_at' => 'required|date_format:Y-m-d',
            'issued_at' => 'required|date_format:Y-m-d',
            'dob' => 'required|date_format:Y-m-d',
        ];
        $messages = [
            'required'    =>  'The :attribute field is required.',
            'email'    => 'The :attribute must be valid email.',
            'required_if'=> 'The :attribute is required if memberbership type is paid.',
            'date_format'=>'The :attribute must be of valid format.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }
        $member= Member::create($request->all());
        if($request->has('thresholds')){
            $data=[];
            foreach($request->thresholds as  $threshold){
                $th=Threshold::where('slug',$threshold)->first();
                if($th===null){

                }else{
                    $data[]=array(
                        'threshold_id'=> $th->id,
                        'member_id'=> $member->id,
                        'created_by'=> Auth::user()->id,
                        'created_at'=> date('Y-m-d H:i:s'),
                        'updated_at'=> date('Y-m-d H:i:s')
                    );
                }
            }
            MemberThreshold::insert($data);
        }
        if ($member) {
            if (isset($request->ref)) {
                switch ($request->ref) {
                    case '0':
                    return redirect()->route('membership.create');
                        break;

                    case '1':
                    return redirect()->route('membership.index');
                        break;
                }
            }else{
            return redirect()->route('membership.index');
            }

        }
        return redirect()->back();
    }

    // public function check(Request $request){
    //     $cred=$request->membership_credential;
    //     $member= Member::where('phone',$request->membership_credential)
    //                     ->orWhere('membership_no',$request->membership_credential)
    //                     ->first();
    //     if($member===null){
    //         $res['status']=false;
    //         $res['message']='Member doesnot exist.';
    //         $res['data']=$request->membership_credential;
    //     }else{
    //         if($member->status){
    //             $threshold=$member->thresholds;
    //             $res['status']=true;
    //             $res['message']='Member doesnot exisst.';
    //             $res['thresholds']=$threshold;
    //             $res['data']=$request->membership_credential;
    //         }else{
    //             $res['status']=false;
    //             $res['message']='Member is not active.';
    //             $res['data']=$request->membership_credential;
    //         }
    //     }
    //     return json_encode($res);
    // }
    public function thresholdIndex(){
        $threshold=Threshold::all();
        return view('membership.types.threshold.index')
                ->with('thresholds',collect($threshold));
    }
    public function thresholdCreate(){
        return view('membership.types.threshold.create');
    }
    public function thresholdStore(Request $request){
        $request->validate([
            'name'=>'required',
            'threshold'=>'required',
            'threshold.*.0' => 'required|numeric|min:1',
            'threshold.*.1' => 'required|numeric|min:1|max:100',
        ]);
        $thresholds=[];
        foreach($request->threshold as $threshold){
            $thresholds[]=$threshold;
        }
        $data['name']=$request->name;
        $data['detail']=json_encode($thresholds);
        $threshild = Threshold::create($data);
        if ($threshild) {
            if (isset($request->ref)) {
                switch ($request->ref) {
                    case '0':
                    return redirect()->route('membership.threshold.create');
                        break;

                    case '1':
                    return redirect()->route('membership.threshold.index');
                        break;
                }
            }else{
            return redirect()->route('membership.threshold.index');
            }

        }

    }

    public function repeatIndex(){
        dd('here');
    }
    public function updateStatus(Request $request){
        $model = Member::find($request->id);
        $model->status = ($model->status ==1) ? 0 : 1;
        if ($model->update()) {
            $this->create_log ('change status','membership');
            return response()->json(['status' => 'success', 'successMsg' => 'Successfully Updated Membership !']); die;
        }
        return response()->json(['status' => 'failed', 'errorMsg' => 'Something went wrong. Please try again!']);

    }

    public function update(Request $request){
        $data = $this->getArray($request);
        $rules=[
            'name' => 'required|max:255',
            'email' => 'email|required|unique:members,email,'.$data['id'].'|max:255',
            'phone' => 'required|unique:members,phone,'.$data['id'].'|max:255',
        ];
        $this->withValidate($data, $rules);
        // dd($data['name']);
        $model = Member::find($data['id']);
        $model->name = $data['name'];
        $model->email = $data['email'];
        $model->phone = $data['phone'];
        if ($model->update()) {
                $this->create_log('update','membership');
                return "ok";
            }
            else{
                return response()->json(['status' => 'failed', 'errorMsg' => 'Something went wrong. Please try again!']);
            }
    }

    public function edit(Request $request){

        $member = Member::find($request->id);
        $view = view('membership.components.edit',[
            'member' =>  $member,
        ]);
        return $view;
    }
    public function thresholdStatus(Request $request)
    {
        $model = Threshold::find($request->id);
        $model->status = ($model->status ==1) ? 0 : 1;
        if ($model->update()) {
            $this->create_log ('change status','threshold');
            return response()->json(['status' => 'success', 'successMsg' => 'Successfully Updated Membership Threshold !']); die;
        }
        return response()->json(['status' => 'failed', 'errorMsg' => 'Something went wrong. Please try again!']);

    }

    public function thresholdEdit($slug){

        $threshold = Threshold::where('slug',$slug)->first();
        $threshold->details = json_decode($threshold->detail);
        return view('membership.types.threshold.edit', compact('threshold'));
    }

    public function thresholdUpdate(Request $request){
        $model = Threshold::where('slug',$request->slug)->first();
        $request->validate([
            'name'=>'required',
            'threshold'=>'required',
            'threshold.*.0' => 'required|numeric|min:1',
            'threshold.*.1' => 'required|numeric|min:1|max:100',
        ]);
        $thresholds=[];
        foreach($request->threshold as $threshold){
            $thresholds[]=$threshold;
        }
        $model->name=$request->name;
        $model->detail=json_encode($thresholds);
        if ($model->update()) {
            $this->create_log('update','threshold');
            toastr()->success('Data has been saved successfully!');
            return redirect()->route('membership.threshold.index');
        }
    }

    public function thresholdDetails(Request $request)
    {
        $data = Threshold::find($request->id);
        $data->details = json_decode($data->detail);

       $view = View::make('membership.types.threshold.components.detail',[
        'data' => $data
       ]);
       return $view;
    }
}
