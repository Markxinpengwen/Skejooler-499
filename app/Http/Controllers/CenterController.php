<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use DB;
use Collection;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO temp
        return view('center/profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        $center = DB::table('centers')->where('cid', '1')->get();
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
        $center = DB::table('centers')->where('cid', '1')->get();
        return $center;
        //return view('center/profileEdit')->with($center);
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
        $center = Input::all();
        DB::table('centers')->where('cid', '1')->update([
            'cname' => $center['cname'],
            //'' => $center[''],
        ]);

        return view('center/profile')->with($center);
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
}
