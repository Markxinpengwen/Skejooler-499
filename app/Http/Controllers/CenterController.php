<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Auth as Auth;
use App\Centers as Centers;
use App\Http\Requests\centerRequest as centerRequest;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CenterController::showProfile();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $cid
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        // find correct Center
        $center = Centers::find(Auth::id());

        return view('center/profile')->with('center', $center);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param
     * @return
     */
    public function editProfile()
    {
        // find correct Center
        $center = Centers::find(Auth::id());

        return view('center/profileEdit')->with('center', $center);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $cid
     * @return \Illuminate\Http\Response
     */
    public function updateProfile()
    {
        $c = new Centers();
        // grab center info to be updated
        $tempcenter = Input::all();
        $cid = $tempcenter['cid'];

        //echo "validate - "; var_dump($c->validate($tempcenter));

        // determine is user is allowed to update profile
        if($c->authorize($cid))
        {
            // find correct Center to update
            if($c->validate($tempcenter))
            {
                $center = Centers::find(Auth::user()->id);

                // update center
                $center->name = $tempcenter['name'];
                $center->email = $tempcenter['email'];
                $center->phone = $tempcenter['phone'];
                $center->description = $tempcenter['description'];
                $center->canSupportOnlineExam = $tempcenter['canSupportOnlineExam'];
                $center->cost = $tempcenter['cost'];
                $center->street_address = $tempcenter['street_address'];
                $center->city = $tempcenter['city'];
                $center->province = $tempcenter['province'];
                $center->country = $tempcenter['country'];
                //$center->postal_code => $tempcenter['postal_code'];

                // save new values to DB
                $center->save();
                return CenterController::showProfile();
            }
            else
            {
                //invalid input
                redirect(); //->with('errors', $c->error());
            }
        }
        else
        {
            //wrong user???
            redirect();
        }
    }

    /*
     * Validates and stores input into session
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function storeProfile()
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
        return view('center/schedule')->with('center', '1');
    }
}
