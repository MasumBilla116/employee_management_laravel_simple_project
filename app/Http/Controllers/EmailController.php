<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\EmployeeEmail;
use Illuminate\Support\Facades\Session;
class EmailController extends Controller
{

/**
     * 
     * email contact
     * 
     * * */

     public function emailContact()
     {
         return view('email.emailContact');
     }


     
    
    public function index(Request $req)
    {
        $to = $req->to;
        $subject = $req->subject;
        $message = $req->message; 
 
        $mail_content = [
            'title'=>$subject,
            'body' => $message
        ];
        Mail::to($to)->send(new EmployeeEmail($mail_content));
        Session::put('send_mail', 'success');
        return redirect("/contact/email");
    }
}
