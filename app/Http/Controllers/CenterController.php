<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use DB;
use Collection;

class CenterController extends Controller
{
    protected $cid;

    public function __construct()
    {
        //get center variables
        $this->cid = 1;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO set up
        return CenterController::showProfile();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        $center = DB::table('centers')->where('cid', $this->cid)->get();
        $center = json_decode($center, true);
        $center = array_get($center, '0');

        return view('center/profile')->with('center', $center);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        $center = DB::table('centers')->where('cid', $this->cid)->get();
        $center = json_decode($center, true);
        $center = array_get($center, '0');

        return view('center/profileEdit')->with('center', $center);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile()
    {
        //TODO - change into store profile and validation needed
        $center = Input::all();
        DB::table('centers')->where('cid', $this->cid)->update([
            'name' => $center['name'],
            'email' => $center['email'],
            'phone' => $center['phone'],
            'description' => $center['description'],
            //'canSupportOnlineExam' => $center['canSupportOnlineExam'],
            'cost' => $center['cost'],
            'street_name' => $center['street_name'],
            'city' => $center['city'],
            'province' => $center['province'],
            'country' => $center['country'],
            //'postal_code' => $center['postal_code']
        ]);

        return CenterController::showProfile();
    }

    /*
     * Validates and stores input into session
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function storeProfile(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSchedule()
    {
//        $center = DB::table('schedules')->where('cid', $this->cid)->get();
//        $center = json_decode($center, true);
//        $center = array_get($center, '0');
//
//        return view('center/profile')->with('center', $center);
    }
}
