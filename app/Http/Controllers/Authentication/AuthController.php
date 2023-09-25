<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function view(Request $request){

        return view("auth.login");

    }

    public function do_login(Request $request){

        $request->validate(['email'=>'required'],
            ['email'=>'the email required 404']);
        $login_data=['email'=>$request->email,'password'=>$request->password];

        
        if(Auth::guard("web")->attempt($login_data)){
            return redirect()->intended(RouteServiceProvider::HOME);
        }



        elseif (Auth::guard("teacher")->attempt($login_data)){

            return redirect()->intended(RouteServiceProvider::TEACHER);
        }


        elseif (Auth::guard("studentparent")->attempt($login_data)){

            return redirect()->intended(RouteServiceProvider::PARENT);
        }



        elseif (Auth::guard("student")->attempt($login_data)){

            return redirect()->intended(RouteServiceProvider::STUDENT);
        }


        else return redirect()->back()->with(['error'=>"error password or email"]);

    }
    public function logout(){
        if(Auth::guard("web")->check()){
            Auth::guard("web")->logout();
            return redirect('/');

        }



        elseif (Auth::guard("teacher")->check()){

            Auth::guard("teacher")->logout();
            Session::flush();
            return redirect('/');
        }


        elseif (Auth::guard("studentparent")->check()){

            Auth::guard("studentparent")->logout();
            Session::flush();
            return redirect('/');
        }



        elseif (Auth::guard("student")->check()){

            Session::flush();
            Auth::guard("student")->logout();
            return redirect('/');
        }
    }





}
