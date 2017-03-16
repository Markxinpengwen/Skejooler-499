<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Eloquent;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function center(){
        return view('/center');
    }
    public function student(){
        if(Auth::user()->type == "student"){
            return view('/student');
        }
        else{
            return view('errors/403');
        }
    }
}
