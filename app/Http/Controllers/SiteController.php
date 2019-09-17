<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\ChangepinRequest;
use App\Http\Requests\User\ChangepasswordRequest;

class SiteController extends Controller
{

    public function index(Request $request){
        return view('workplace.index');
    }
    public function order(Request $request){
        return view('order.index');
    }
    public function form(){
        return view('form.index');

    }
    public function menu(){
        return view('menu.index');
    }

    public function billSplit(){
        return view('bill.split');

    }

    public function elements(){
        return view('elements');

    }
    public function kot(){
        return view('kot.index');

    }

    public function get_started(){
        return view('getstarted');
    }

    public function contact(){

        return view('contact');
    }
    public function faqs(){
        return  view('faqs');
    }

    public function accountSetting(){
        return view('user.accountSetting');

    }
    public function changePasswordStore(ChangepasswordRequest $request){

        if (Hash::check($request->old_password, Auth::User()->password)) {
            $user = Auth::User();
            $user->password=Hash::make($request->password);
            $user->update();
            $this->create_log('update','password');
            return redirect()->back();
        }else{
            return redirect()->back()->with('old_password','password not correct');

        }

    }

    public function changePinStore(ChangepinRequest $request){

            if (Hash::check($request->password, Auth::User()->password)) {
                $user = Auth::User();
                $user->pin=Hash::make($request->pin);
                $user->update();
                $this->create_log('update','pin');
                return redirect()->back();
            }else{
                return redirect()->back()->with('password_error','Password not correct!');
            }


    }
    public function wizard(){
        return view ('setupwizard');
    }



}
