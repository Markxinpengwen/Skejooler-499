<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class userController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {

            $allusr = DB::select("select * from users");
           foreach($allusr as $usr){
               $utype  = $usr-> utype;
               if($utype == 1){
                    return view('/student');
                }elseif($utype == 2){
                    return view('/center');
                }
                else{
                    return view('/admin');
                }
            }

    }
}
