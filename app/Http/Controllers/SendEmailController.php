<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;


class SendEmailController extends Controller
{
    function index()
    {
     return view('send_email');
    }

        function send(Request $request)
    {
    	$inputArr=$request->all();
// dd($inputArr);
$msg=$inputArr['editor1'];
     $this->validate($request, [
      'user'     =>  'required',
      'toemail'  =>  'required|email',
      'editor1' =>  'required'
     ]);

        $data = array(
            'name'      =>  $request->user,
            'message'   =>   $msg,
            'subject'   =>$request->sub,
            'frommail'  =>$request->fromemail,
        );

     Mail::to($inputArr['toemail'])->send(new SendMail($data));

     return back()->with('message', 'Mail Sent Successfully!');

    }
}