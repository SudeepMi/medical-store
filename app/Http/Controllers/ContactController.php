<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\ConactRequest;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;



class ContactController extends Controller
{
    public function sendMsg(ConactRequest $request){

        $data = array('name'=>$request->name,
                        'email' =>$request->email,
                        'message' =>$request->message);
        Mail::to('abc@g.c')->send(new ContactMessage($request));
//        $this->create_log ('')
        return redirect()->back();
    }
}
