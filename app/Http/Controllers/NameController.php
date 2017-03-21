<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Eloquent;
use Illuminate\Support\Facades\Auth;

class NameController extends Controller
{
    public function index()
    {
        $uid = Auth::user()->uid;
//        returning both first and last name
//        if(Auth::user()->type == "student"){
//            $array = DB::select('select firstName,lastName from students where sid = ? ',[$uid]);
//            $array = json_decode(json_encode($array), true);
//            $name = $array[0]['firstName']." ".$array[0]['lastName'];
//            echo $name;
//        }
        if(Auth::user()->type == "student"){
            $array = DB::select('select firstName from students where sid = ? ',[$uid]);
            $array = json_decode(json_encode($array), true);
            $name = $array[0]['firstName'];
            return view('/student')->with('name', $name);
        }
        elseif(Auth::user()->type == "center"){
            $array = DB::select('select name from centers where cid = ? ', [$uid]);
            $array = json_decode(json_encode($array), true);
            $name = $array[0]['name'];
            return view('/st/layouts/partials/notifs')->with('name', $name);
        }
    }

    public function update(Request $request)
    {

    }
}
