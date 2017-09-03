<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthCtrl extends Controller
{
    public function __construct()
    {
       $this->middleware('authMiddleware',['except'=>['index','login']]);
    }
   public function index()
   {
     return view('login');
   }
    public function login(Request $request)
    {
        if ($request->session()->has('name')) {
            return redirect('welcome')->with('message', 'you are already login');
        }
        else {
            if ($request->name=='nazir' && $request->pwd=='123') {
                $request->session()->put('name',$request->name);
                return redirect('welcome')->with('message', 'You are successfully login');
            }
            else {
                  return redirect('/')->with('message', 'username or password is incorrect');
            }
        }
    }
    public function welcome()
    {
       return view('welcome');
    }
    public function logout(Request $request)
    {
         $request->session()->forget('name');
         return redirect('/')->with('message', 'you are logout ');
    }
}
