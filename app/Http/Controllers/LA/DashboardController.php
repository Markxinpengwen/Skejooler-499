<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return view('la.dashboard');
    }
    public function students()
    {
        return view('la/students');
    }

//    public function addstudents()
//    {
//        DB::insert('insert into students (sid,firstName,age) values (?,?,?)',[$uid,$data['name'],10]);
//    }
    public function centers()
    {
        return view('la/centers');
    }
    public function requests()
    {
        return view('la/requests');
    }
}