<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function center(){
        return view('/center');
    }
    public function student(){
        return view('/student');
    }
}