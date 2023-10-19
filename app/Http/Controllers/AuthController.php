<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function authError(){
        return view('auth.authenticate_error');
    }

    public function index(){
        return view('auth.loginform');
    }

    public function userLogin(Request $request){

        $request->validate([
            'email'=>'required | email',
            'password'=>'required',
        ]);

        $user = $request->only("email","password");

        if(Auth::attempt($user)){
            if(Auth::user()->role === "admin")
            {
                Session::put("role","admin");
                return redirect("/home");
            }
            else{
                Session::put("role","user"); 
                return redirect("/employee/dashboard");
            }
        }
        else{
            return back()->with('error','Email or Password is Incourrect');
        }
    }


    public function logout()
    {
        Auth::logout(); // Log out the user
        return redirect('/'); // Redirect to a desired page after logout
    }
}
