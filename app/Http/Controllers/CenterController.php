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
        return CenterController::showSchedule();
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
            ->where('center_approval', 2)
            ->where('student_approval', 2)
            //->where('scheduled_date', '<=', date("Y-m-d h:i:s"))
            ->orderby('scheduled_date', 'desc')
            ->orderby('preferred_date_1', 'desc')
            ->orderby('preferred_date_2', 'desc')
            ->get(); //TODO get correct current datetime
        $pendingCenter = Requests::where('center', Auth::id())
            ->where('center_approval', 1)
            ->where('student_approval', 2)
            ->orderby('scheduled_date', 'desc')
            ->orderby('preferred_date_1', 'desc')
            ->orderby('preferred_date_2', 'desc')
            ->get();
        $pendingStudent = Requests::where('center', Auth::id())
            ->where('center_approval', 2)
            ->where('student_approval', 1)
            ->orderby('scheduled_date', 'desc')
            ->orderby('preferred_date_1', 'desc')
            ->orderby('preferred_date_2', 'desc')
            ->get();
        $deniedCenter = Requests::where('center', Auth::id())
            ->where('center_approval', 0)
            ->where('student_approval', 1)
            ->orderby('scheduled_date', 'desc')
            ->orderby('preferred_date_1', 'desc')
            ->orderby('preferred_date_2', 'desc')
            ->get();
        $deniedStudent = Requests::where('center', Auth::id())
            ->where('center_approval', 1)
            ->where('student_approval', 0)
            ->orderby('scheduled_date', 'desc')
            ->orderby('preferred_date_1', 'desc')
            ->orderby('preferred_date_2', 'desc')
            ->get();
        $past = Requests::where('center', Auth::id())
            ->where('center_approval', 2)
            ->where('student_approval', 2)
            //->where('scheduled_date', '>', currentdate)
            ->orderby('scheduled_date', 'desc')
            ->orderby('preferred_date_1', 'desc')
            ->orderby('preferred_date_2', 'desc')
            ->get(); // TODO get correct current datetime

        return view('center/schedule')
            ->with('upcoming', $upcoming)
            ->with('pendingCenter', $pendingCenter)
            ->with('pendingStudent', $pendingStudent)
            ->with('deniedCenter', $deniedCenter)
            ->with('deniedStudent', $deniedStudent)
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

        // grab student email from user table
        $student_email = Users::where('uid', $sid)
            ->first();

        // determine if editable
        if($request->scheduled_date > date("Y-m-d h:i:sa"))
        {
            $editable = true;
        }
        else
        {
            $editable = false;
        }

        return view('center/request')
            ->with('student', $student)
            ->with('request', $request)
            ->with('student_email', $student_email->email)
            ->with('editable', $editable);
    }

    /**
     * Show the form for editing the Center's specified request.
     */
    public function editRequest()
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

        // grab student email from user table
        $student_email = Users::where('uid', $sid)
            ->first();

        return view('center/requestEdit')
            ->with('request', $request)
            ->with('student', $student)
            ->with('student_email', $student_email->email);
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
            $request = Requests::where('rid', $rid)
                ->where('center', Auth::id())
                ->where('student', $sid)
                ->first();

            $student = Students::where('sid', $sid)
                ->first();

            // find correct Center to update
            if($r->validate($tempRequest))
            {
                if($request->scheduled_date != $tempRequest['scheduled_date'])
                {
                    //echo"1";
                    $approvals = $r->decision(1, intval($request->center_approval.$request->student_approval), intval($tempRequest['center_approval'].$request->student_approval));
                }
                else
                {
                    //echo"0";
                    $approvals = $r->decision(0, intval($request->center_approval.$request->student_approval), intval($tempRequest['center_approval'].$request->student_approval));
                }

                if($approvals[0] == 3 && $approvals[1] == 3)
                {
                    //nothing changes prevented operation
                }
                elseif($approvals[0] == 4 && $approvals[1] == 4)
                {
                    $this->deleteRequest($rid, $cid, $sid);

                    return CenterController::showSchedule();
                }
                elseif($approvals[0] == 8 && $approvals[1] == 8)
                {
                    // TODO ignored for now -> to fix in decision table
                }
                else
                {
                    // update request
                    $request->scheduled_date = $tempRequest['scheduled_date'];
                    $request->center_notes = $tempRequest['center_notes'];

                    $request->center_approval = $approvals[0];
                    $request->student_approval = $approvals[1];

                    // save new values to DB
                    $request->save();

                    return CenterController::showRequest()
                        ->with('request', $request)
                        ->with('student', $student);
                }

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

    /**
     * Delete the Center's Request in the database.
     */
    public function deleteRequest($rid, $cid, $sid)
    {
        $r = new Requests();

        if($r->authorize($rid, $cid))
        {
            $request = Requests::where('rid', $rid)
                ->where('center', Auth::id())
                ->where('student', $sid)
                ->first();

            $request->delete();
        }
        else
        {
            // wrong user
            redirect();
        }
    }
}
