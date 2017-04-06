<?php

/**
 * Author: Brett Schaad
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Auth as Auth;
use App\Centers as Centers;
use App\Students as Students;
use App\Requests as Requests;
use App\User as Users;
use App\Institutions as Institutions;

class CenterController extends Controller
{
    /**
     * Displays the default.
     */
    public function index()
    {
        // TODO - write condition logic
        // if first time -> profile
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

        // find correct User
        $user = Users::where('uid', Auth::id())
            ->first();

        // send to profile view with Center model for given User and login email from User model
        return view('center/profile')
            ->with('center', $center)
            ->with('login_email', $user->email);
    }

    /**
     * Show the form for editing the Center's Profile.
     */
    public function editProfile()
    {
        // find correct Center
        $center = Centers::where('cid', Auth::id())
            ->first();

        // find correct User
        $user = Users::where('uid', Auth::id())
            ->first();

        // send to profileEdit view with Center model for given User and login email from User model
        return view('center/profileEdit')
            ->with('center', $center)
            ->with('login_email', $user->email);
    }

    /**
     * Update the Center's Profile in the database.
     */
    public function updateProfile()
    {
        // instantiate a Center model
        $c = new Centers();

        // grab Center info to be updated and determine cid
        $tempCenter = Input::all();
        $cid = $tempCenter['cid'];

        // determine if User is allowed to update profile
        if($c->authorize($cid))
        {
            // determine if the input is valid, testing against the rules of the Center model
            if($c->validate($tempCenter))
            {
                // find correct Center to update
                $center = Centers::where('cid', Auth::id())
                    ->first();

                // update Center values
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

                // send to profile view
                return CenterController::showProfile();
            }
            else
            {
                // invalid input based on rules of Center model
                redirect();
            }
        }
        else
        {
            // wrong user / authentication failure
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
        // FUTURE get correct current datetime
        date_default_timezone_set('America/Vancouver');

        // find all exam requests that Center and Student have approved and is in the future then determine the count
        $upcoming = Requests::where('cid', Auth::id())
            ->where('center_approval', 2)
            ->where('student_approval', 2)
            ->where('scheduled_date', '>=', date("Y-m-d h:i:s"))
            ->join('institutions', 'requests.iid', '=', 'institutions.iid')
            ->join('students', 'requests.sid', '=', 'students.sid')
            ->orderby('scheduled_date', 'asc')
            ->orderby('preferred_date_1', 'asc')
            ->orderby('preferred_date_2', 'asc')
            ->get();
        $upcomingCount = $upcoming->count();

        // find all exam requests that Center is undecided and Student has approved then determine the count
        $pendingCenter = Requests::where('cid', Auth::id())
            ->where('center_approval', 1)
            ->where('student_approval', 2)
            ->join('institutions', 'requests.iid', '=', 'institutions.iid')
            ->join('students', 'requests.sid', '=', 'students.sid')
            ->orderby('scheduled_date', 'asc')
            ->orderby('preferred_date_1', 'asc')
            ->orderby('preferred_date_2', 'asc')
            ->get();
        $pendingCenterCount = $pendingCenter->count();

        // find all exam requests that Center has approved and Student is undecided then determine the count
        $pendingStudent = Requests::where('cid', Auth::id())
            ->where('center_approval', 2)
            ->where('student_approval', 1)
            ->join('institutions', 'requests.iid', '=', 'institutions.iid')
            ->join('students', 'requests.sid', '=', 'students.sid')
            ->orderby('scheduled_date', 'asc')
            ->orderby('preferred_date_1', 'asc')
            ->orderby('preferred_date_2', 'asc')
            ->get();
        $pendingStudentCount = $pendingStudent->count();

        // find all exam requests that Center is undecided and Student has denied then determine the count
        $deniedStudent = Requests::where('cid', Auth::id())
            ->where('center_approval', 1)
            ->where('student_approval', 0)
            ->join('institutions', 'requests.iid', '=', 'institutions.iid')
            ->join('students', 'requests.sid', '=', 'students.sid')
            ->orderby('scheduled_date', 'asc')
            ->orderby('preferred_date_1', 'asc')
            ->orderby('preferred_date_2', 'asc')
            ->get();
        $deniedStudentCount = $deniedStudent->count();

        // find all exam requests that Center has denied and Student is undecided then determine the count
        $deniedCenter = Requests::where('cid', Auth::id())
            ->where('center_approval', 0)
            ->where('student_approval', 1)
            ->join('institutions', 'requests.iid', '=', 'institutions.iid')
            ->join('students', 'requests.sid', '=', 'students.sid')
            ->orderby('scheduled_date', 'asc')
            ->orderby('preferred_date_1', 'asc')
            ->orderby('preferred_date_2', 'asc')
            ->get();
        $deniedCenterCount = $deniedCenter->count();

        // find all exam requests that Center and Student have approved and is in the past then determine the count
        $past = Requests::where('cid', Auth::id())
            ->where('center_approval', 2)
            ->where('student_approval', 2)
            ->where('scheduled_date', '<', date("Y-m-d h:i:s"))
            ->join('institutions', 'requests.iid', '=', 'institutions.iid')
            ->join('students', 'requests.sid', '=', 'students.sid')
            ->orderby('scheduled_date', 'asc')
            ->orderby('preferred_date_1', 'asc')
            ->orderby('preferred_date_2', 'asc')
            ->get();
        $pastCount = $past->count();

        // send to schedule view with all requests for given User and their counts
        return view('center/schedule')
            ->with('upcoming', $upcoming)
            ->with('upcomingCount', $upcomingCount)
            ->with('pendingCenter', $pendingCenter)
            ->with('pendingCenterCount', $pendingCenterCount)
            ->with('pendingStudent', $pendingStudent)
            ->with('pendingStudentCount', $pendingStudentCount)
            ->with('deniedStudent', $deniedStudent)
            ->with('deniedStudentCount', $deniedStudentCount)
            ->with('deniedCenter', $deniedCenter)
            ->with('deniedCenterCount', $deniedCenterCount)
            ->with('past', $past)
            ->with('pastCount', $pastCount);
    }

    //---------------------------------------------------------------------------------------
    // REQUEST
    //---------------------------------------------------------------------------------------

    /**
     * Displays the Center's specified request.
     */
    public function showRequest()
    {
        // FUTURE get correct current datetime
        date_default_timezone_set('America/Vancouver');

        // grab Request info to be displayed and determine rid, sid, iid
        $temp = Input::all();
        $rid = $temp['rid'];
        $sid = $temp['sid'];
        $iid = $temp['iid'];

        // find correct Request, Student and Institution information
        $student = Students::where('sid', $sid)
            ->first();
        $institution = Institutions::where('iid', $iid)
            ->first();
        $request = Requests::where('rid', $rid)
            ->where('cid', Auth::id())
            ->where('sid', $sid)
            ->first();

        // find correct User for Student from Request
        $user = Users::where('uid', $sid)
            ->first();

        // determine if the exam scheduled date has been changed from the default
        if($request->scheduled_date == "1970-01-02 00:00:00" || $request->scheduled_date == null)
        {
            // scheduled_date has not changed from default
            $scheduled = false;
        }
        else
        {
            // scheduled_date has changed from default
            $scheduled = true;
        }

        // determine if editable by testing if the scheduled date is in the future or not
        if($request->scheduled_date > date("Y-m-d h:i:s") || $scheduled)
        {
            // scheduled date is in the future
            $editable = true;
        }
        else
        {
            // scheduled date is in the past
            $editable = false;
        }

        // send to request view with Student, Institution, and Request models for given Request and User login email for Student from User model with editable boolean value
        return view('center/request')
            ->with('student', $student)
            ->with('request', $request)
            ->with('student_email', $user->email)
            ->with('institution', $institution)
            ->with('scheduled', $scheduled)
            ->with('editable', $editable);
    }

    /**
     * Show the form for editing the Center's specified request.
     */
    public function editRequest()
    {
        // grab Request info to be displayed and determine rid, sid, iid
        $temp = Input::all();
        $rid = $temp['rid'];
        $sid = $temp['sid'];
        $iid = $temp['iid'];

        // find correct Request, Student and Institution information
        $student = Students::where('sid', $sid)
            ->first();
        $institution = Institutions::where('iid', $iid)
            ->first();
        $request = Requests::where('rid', $rid)
            ->where('cid', Auth::id())
            ->where('sid', $sid)
            ->first();

        // find correct User for Student from Request
        $user = Users::where('uid', $sid)
            ->first();

        // determine if the exam scheduled date has been changed from the default
        if($request->scheduled_date == "1970-01-02 00:00:00" || $request->scheduled_date == null)
        {
            // scheduled_date has not changed from default
            $scheduled = false;
        }
        else
        {
            // scheduled_date has changed from default
            $scheduled = true;
        }

        // send to requestEdit view with Student, Institution, and Request models for given Request and User login email for Student from User model
        return view('center/requestEdit')
            ->with('request', $request)
            ->with('student', $student)
            ->with('institution', $institution)
            ->with('student_email', $user->email)
            ->with('scheduled', $scheduled);
    }

    /**
     * Update the Center's Request in the database.
     */
    public function updateRequest()
    {
        // instantiate a Request model
        $r = new Requests();

        // grab Request info to be updated and determine rid, cid, sid
        $tempRequest = Input::all();
        $rid = $tempRequest['rid'];
        $cid = $tempRequest['cid'];
        $sid = $tempRequest['sid'];

        // combine date and time into one value for validation and input
        $tempRequest['scheduled_date'] = $tempRequest['scheduled_date']." ".$tempRequest['scheduled_time'];

        // determine if User is allowed to update Request
        if($r->authorize($cid))
        {
            // determine if the input is valid, testing against the rules of the Request model
            if($r->validate($tempRequest))
            {
                // find correct Request to update
                $request = Requests::where('rid', $rid)
                    ->where('cid', Auth::id())
                    ->where('sid', $sid)
                    ->first();

                // test is the scheduled date has changed from its previous value
                if($request->scheduled_date != $tempRequest['scheduled_date']." ".$tempRequest['scheduled_time'])
                {
                    // scheduled date has changed
                    $dateChanged = 1;
                }
                else
                {
                    // scheduled date has not changed
                    $dateChanged = 0;
                }

                // determine new approval status from previous approval status and input approval status using Request model decision method and array
                $approvals = $r->decision(intval($dateChanged),
                    intval($request->center_approval.$request->student_approval),
                    intval($tempRequest['center_approval'].$request->student_approval));

                // undetermined approval status
                if($approvals[0] == 3 && $approvals[1] == 3)
                {
                    // FUTURE - nothing changes -> prevented operation
                }
                // both approvals are denied status, and request should be deleted
                elseif($approvals[0] == 4 && $approvals[1] == 4)
                {
                    // delete correct request
                    $this->deleteRequest($rid, $cid, $sid);

                    // send to schedule view
                    return CenterController::showSchedule();
                }
                // error in approval status
                elseif($approvals[0] == 8 && $approvals[1] == 8)
                {
                    // FUTURE ignored for now -> to fix in decision table or by avoidance
                }
                // valid approval status
                else
                {
                    // update Request values
                    $request->scheduled_date = $tempRequest['scheduled_date'];
                    $request->center_notes = $tempRequest['center_notes'];
                    $request->center_approval = $approvals[0];
                    $request->student_approval = $approvals[1];

                    // save new values to DB
                    $request->save();

                    // send to schedule view
                    return CenterController::showSchedule();
                }
            }
            else
            {
                // invalid input based on rules of Request model
                redirect();
            }
        }
        else
        {
            // wrong user / authentication failure
            redirect();
        }
    }

    /**
     * Delete the Center's Request in the database.
     */
    public function deleteRequest($rid, $cid, $sid)
    {
        // instantiate a Request model
        $r = new Requests();

        // determine if User is allowed to delete Request
        if($r->authorize($rid, $cid))
        {
            // find correct Request to delete
            $request = Requests::where('rid', $rid)
                ->where('cid', Auth::id())
                ->where('sid', $sid)
                ->first();

            // delete from DB
            $request->delete();
        }
        else
        {
            // wrong user / authentication failure
            redirect();
        }
    }
}
