<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserDetailsRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\CreateUserRequest;
use Sudeep\LogReader\LogReader;
use Illuminate\Http\Request;

use View;

class UserController extends Controller
{
    private $user;

    public function __construct(LogReader $reader, User $user)
    {
        $this->user = $user;
        parent::__construct ( $reader );
    }

    public function index()
   {
       $users = User::all()->except(Auth::id());
       return view('user.index',compact('users'));
   }

   public function create(){
       return view('user.create');
   }

   public function store(CreateUserRequest $request){

       $this->user->name = $request->name;
       $this->user->email = $request->email;
       $this->user->username = $request->username;
       $this->user->phone = $request->phone;
       $this->user->address = $request->address;
       $this->user->password = bcrypt($request->password);
       $this->user->role = $request->role;
       $this->user->pin = $request->pin;
       $this->user->discount = isset($request->discount)?$request->discount:0;

       if ($this->user->save()){
           $this->create_log ('create','users');
           return redirect()->route('user.index');
       }

       return redirect()->back();
   }

   public function edit($username){
        $user = $this->user->where('username',$username)->first();
        return view('user.edit',compact('user'));
   }

   public function update(UpdateUserRequest $request){

       $user = $this->user->where('username',$request->username)->first();
       $user->phone = $request->phone;
       $user->address = $request->address;
       $user->role = $request->role;
       $user->pin = $request->pin;
       $user->status = $request->status;
       if ($user->save()){
           $this->create_log ('update','users');
           return redirect()->route('user.index');
       }
           return redirect()->back();
   }

   public function changePassword(){

   }

   public function getDetail(UserDetailsRequest $request){

       $user = $this->user->where('username',$request->username)->first();
       $view= View::make('user.components.user-info', [
           'user' =>  $user,
       ]);
       return $view;
   }

   public function ChangeStatus(Request $request){
    if($request->ajax()){
        $model = User::find(htmlspecialchars($request->id, ENT_QUOTES));
        $model->status = ($model->status == 0) ? 1 : 0;
        if($model->update()){
            $this->create_log ('change status','user');
            return response()->json(['status' => 'success', 'successMsg' => 'Successfully Updated User Status!']); die;
        }
        return response()->json(['status' => 'failed', 'errorMsg' => 'Something went wrong. Please try again!']);
    }
   }


}
