<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Request;

class UtypeController extends Controller
{
    public function index()
    {
        $utype =\register.blade.php::get('utype');
        DB;;table('users') ->insert(['utpye' => $utype['utype']]);
    }
}
