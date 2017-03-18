<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Auth as Auth;
use App\Centers as Centers;
use App\Students as Students;
use App\Requests as Requests;
use App\User as Users;

class CenterController extends Controller
{
    /**
     * Displays the default.
     */
    public function index()
    {
        return CenterController::showProfile();
    }

    //---------------------------------------------------------------------------------------
    // PROFILE
    //---------------------------------------------------------------------------------------

    /**
     * Displays the Center's profile.
     */
    public function showProfile()
    {
        // find correct Center
        $center = Centers::where('cid', Auth::id())
            ->first();

        return view('center/profile')
            ->with('center', $center);
    }

    /**
     * Show the form for editing the Center's Profile.
     */
    public function editProfile()
    {
        // find correct Center
        $center = Centers::where('cid', Auth::id())
            ->first();

        return view('center/profileEdit')
            ->with('center', $center);
    }

    /**
     * Update the Center's Profile in the database.
     * TODO use center as timezone
     */
    public function updateProfile()
    {
        $c = new Centers();

        // grab center info to be updated
        $tempCenter = Input::all();
        $cid = $tempCenter['cid'];

        // determine is user is allowed to update profile
        if($c->authorize($cid))
        {
            // find correct Center to update
            if($c->validate($tempCenter))
            {
                $center = Centers::where('cid', Auth::id())
                    ->first();

                // update center
                $center->name = $tempCenter['name'];
                $center->center_email = $tempCenter['center_email'];
                $center->phone = $tempCenter['phone'];
                $center->description = $tempCenter['description'];
                $center->canSupportOnlineExam = $tempCenter['canSupportOnlineExam'];
                $center->cost = $tempCenter['cost'];
                $center->street_address = $tempCenter['street_address'];
                $center->city = $tempCenter['city'];
                $center->province = $tempCenter['province'];
                $center->country = $tempCenter['country'];
                $center->postal_code = $tempCenter['postal_code'];

                // save new values to DB
                $center->save();
                return CenterController::showProfile();
            }
            else
            {
                // invalid input
                redirect();
            }
        }
        else
        {
            // wrong user
            redirect();
        }
    }

    //---------------------------------------------------------------------------------------
    // SCHEDULE
    //---------------------------------------------------------------------------------------

    /**
     * Display the Center's schedule.
     */
    public function showSchedule()
    {
        //
        $upcoming = Requests::where('center', Auth::id())
            ->where('center_approval', 1)
            ->where('student_approval', 1)
            //->where('scheduled_date', '<=', date("Y-m-d h:i:s"))
            ->get(); //TODO get correct current datetime
        $pendingCenter = Requests::where('center', Auth::id())
            ->where('center_approval', 0)
            //->where('student_approval', 1) TODO remove comments
            ->get();
        $pendingStudent = Requests::where('center', Auth::id())
            ->where('student_approval', 0)
            //->where('center_approval', 1) TODO remove comments
            ->get();
        $denied = Requests::where('center', Auth::id())
            ->where('student_approval', -1)
            ->get();
        $past = Requests::where('center', Auth::id())
            ->where('center_approval', 1)
            ->where('student_approval', 1)
            //->where('scheduled_date', '>', currentdate)
            ->get(); // TODO get correct current datetime

        return view('center/schedule')
            ->with('upcoming', $upcoming)
            ->with('pendingCenter', $pendingCenter)
            ->with('pendingStudent', $pendingStudent)
            ->with('denied', $denied)
            ->with('past', $past);
    }

    //---------------------------------------------------------------------------------------
    // REQUEST
    //---------------------------------------------------------------------------------------

    /**
     * Displays the Center's specified request.
     */
    public function showRequest()
    {
        $temp = Input::all();

        $rid = $temp['rid'];
        $sid = $temp['student'];

        // find correct Request and Student information
        $student = Students::where('sid', $sid)
            ->first();
        $request = Requests::where('rid', $rid)
            ->where('center', Auth::id())
            ->where('student', $sid)
            ->first();

        //$student_email = Users::where('uid', $sid)->get('email');

        // TODO - determine if request is editable
        //if($temp['scheduled_date'] > current date)

        return view('center/request')
            ->with('student', $student)
            ->with('request', $request);
            //->with('student_email', $student_email);
            //->with('editable', $editable);
    }

    /**
     * Show the form for editing the Center's specified request.
     */
    public function editRequest()
    {
        $temp = Input::all();

        $rid = $temp['rid'];
        $sid = $temp['student'];

        // find correct Request
        $request = Requests::where('rid', $rid)
            ->where('center', Auth::id())
            ->where('student', $sid)
            ->first();

        return view('center/requestEdit')
            ->with('request', $request);
    }

    /**
     * Update the Center's Request in the database.
     */
    public function updateRequest()
    {
        $r = new Requests();
        // grab center info to be updated
        $tempRequest = Input::all();
        $rid = $tempRequest['rid'];
        $cid = $tempRequest['center'];
        $sid = $tempRequest['student'];

        // determine is user is allowed to update profile
        if($r->authorize($rid, $cid))
        {
            $request = Requests::where('rid', Auth::id())
                ->first();

            // find correct Center to update
            if($r->validate($tempRequest))
            {
                // update request
                //$request->name = $['name'];
                //$request-> = $[''];
                //$request-> = $[''];
                //$request-> = $[''];
                //$request-> = $[''];
                //$request-> = $[''];
                //$request-> = $[''];
                //$request-> = $[''];
                //$request-> = $[''];
                //$request-> = $[''];
                //$request-> = $[''];
                //$request-> = $[''];
                //$request-> = $[''];

                // save new values to DB
                $request->save();

                return CenterController::showRequest();
            }
            else
            {
                // invalid input
                redirect(); //->with('errors', $r->error());
            }
        }
        else
        {
            // wrong user
            redirect();
        }
    }
}
