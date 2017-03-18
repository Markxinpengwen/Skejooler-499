<?php

namespace App\Http\Controllers;

use FontLib\Table\Type\name;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Auth as Auth;
use App\Centers as Centers;
use App\Requests as Requests;

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
        $center = Centers::where('cid', Auth::id())->first();

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
        $center = Centers::where('cid', Auth::id())->first();

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
            //var_dump($c->validate($tempcenter));
            // find correct Center to update
            if($c->validate($tempcenter))
            {
                $center = Centers::where('cid', Auth::id())->first();

                // update center
                $center->name = $tempcenter['name'];
                $center->center_email = $tempcenter['center_email'];
                $center->phone = $tempcenter['phone'];
                $center->description = $tempcenter['description'];
                $center->canSupportOnlineExam = $tempcenter['canSupportOnlineExam'];
                $center->cost = $tempcenter['cost'];
                $center->street_address = $tempcenter['street_address'];
                $center->city = $tempcenter['city'];
                $center->province = $tempcenter['province'];
                $center->country = $tempcenter['country'];
                $center->postal_code = $tempcenter['postal_code'];

                // save new values to DB
                $center->save();
                return CenterController::showProfile();
            }
            else
            {
                //invalid input
                redirect();
            }
        }
        else
        {
            //wrong user???
            redirect();
        }
    }

    /**
     * Display the schedule view with the correct request values based on the user ID
     */
    public function showSchedule()
    {
        // find correct Center
        $upcoming = Requests::where('center', Auth::id())->where('approval_status', 1)->get();
        $pending = Requests::where('center', Auth::id())->where('approval_status', 0)->get();
        $past = Requests::where('center', Auth::id())->where('scheduled_date', '>', '0')->get(); // TODO need the correct DB values i.e. date of exam

        return view('center/schedule')
            ->with('upcoming', $upcoming)
            ->with('pending', $pending)
            ->with('past', $past);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param
     * @return
     */
    public function editSchedule()
    {
        // find correct Center
        $center = Centers::where('cid', Auth::id())->first();

        return view('center/request')->with('center', $center);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $cid
     * @return \Illuminate\Http\Response
     */
    public function updateSchedule()
    {
        $c = new Centers();
        // grab center info to be updated
        $tempcenter = Input::all();
        $cid = $tempcenter['cid'];

        echo "validate - "; var_dump($c->validate($tempcenter));

        // determine is user is allowed to update profile
        if($c->authorize($cid))
        {
            $center = Centers::where('cid', Auth::id())->first();

            // find correct Center to update
            if($c->validate($tempcenter))
            {
                // update center
                $center->name = $tempcenter['name'];
                $center->center_email = $tempcenter['center_email'];
                $center->phone = $tempcenter['phone'];
                $center->description = $tempcenter['description'];
                $center->canSupportOnlineExam = $tempcenter['canSupportOnlineExam'];
                $center->cost = $tempcenter['cost'];
                $center->street_address = $tempcenter['street_address'];
                $center->city = $tempcenter['city'];
                $center->province = $tempcenter['province'];
                $center->country = $tempcenter['country'];
                $center->postal_code = $tempcenter['postal_code'];

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
}
