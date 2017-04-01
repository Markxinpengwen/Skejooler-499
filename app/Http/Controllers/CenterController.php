<?php

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
        // TODO - write condition logic to
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

        $user = Users::where('uid', Auth::id())
            ->first();

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

        $user = Users::where('uid', Auth::id())
            ->first();

        return view('center/profileEdit')
            ->with('center', $center)
            ->with('login_email', $user->email);
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
        $upcoming = Requests::where('cid', Auth::id())
            ->where('center_approval', 2)
            ->where('student_approval', 2)
            ->where('scheduled_date', '>=', date("Y-m-d h:i:s"))
            ->join('institutions', 'requests.iid', '=', 'institutions.iid')
            ->join('students', 'requests.sid', '=', 'students.sid')
            ->orderby('scheduled_date', 'asc')
            ->orderby('preferred_date_1', 'asc')
            ->orderby('preferred_date_2', 'asc')
            ->get(); //TODO get correct current datetime
        $upcomingCount = $upcoming->count();

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

        $past = Requests::where('cid', Auth::id())
            ->where('center_approval', 2)
            ->where('student_approval', 2)
            ->where('scheduled_date', '<', date("Y-m-d h:i:s"))
            ->join('institutions', 'requests.iid', '=', 'institutions.iid')
            ->join('students', 'requests.sid', '=', 'students.sid')
            ->orderby('scheduled_date', 'asc')
            ->orderby('preferred_date_1', 'asc')
            ->orderby('preferred_date_2', 'asc')
            ->get(); // TODO get correct current datetime
        $pastCount = $past->count();

        return view('center/schedule')
            ->with('upcoming', $upcoming)
            ->with('upcomingCount', $upcomingCount)
            ->with('pendingCenter', $pendingCenter)
            ->with('pendingCenterCount', $pendingCenterCount)
            ->with('pendingStudent', $pendingStudent)
            ->with('pendingStudentCount', $pendingStudentCount)
            ->with('deniedCenter', $deniedCenter)
            ->with('deniedCenterCount', $deniedCenterCount)
            ->with('deniedStudent', $deniedStudent)
            ->with('deniedStudentCount', $deniedStudentCount)
            ->with('past', $past)
            ->with('pastCount', $pastCount); // TODO fix code ordering for easy reading
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
        $sid = $temp['sid'];
        $iid = $temp['iid'];

        // find correct Request and Student information
        $student = Students::where('sid', $sid)
            ->first();
        $institution = Institutions::where('iid', $iid)
            ->first();
        $request = Requests::where('rid', $rid)
            ->where('cid', Auth::id())
            ->where('sid', $sid)
            ->first();

        // grab student email from user table
        $user = Users::where('uid', $sid)
            ->first();

        // determine if editable
        if($request->scheduled_date > date("Y-m-d h:i:sa") || $request->scheduled_date == "1970-01-02 00:00:01")
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
            ->with('student_email', $user->email)
            ->with('institution', $institution)
            ->with('editable', $editable);
    }

    /**
     * Show the form for editing the Center's specified request.
     */
    public function editRequest()
    {
        $temp = Input::all();

        $rid = $temp['rid'];
        $sid = $temp['sid'];
        $iid = $temp['iid'];

        // find correct Request and Student information
        $student = Students::where('sid', $sid)
            ->first();
        $institution = Institutions::where('iid', $iid)
            ->first();
        $request = Requests::where('rid', $rid)
            ->where('cid', Auth::id())
            ->where('sid', $sid)
            ->first();

        // grab student email from user table
        $user = Users::where('uid', $sid)
            ->first();

        return view('center/requestEdit')
            ->with('request', $request)
            ->with('student', $student)
            ->with('institution', $institution)
            ->with('student_email', $user->email);

        //TODO - write logic so that invalid states can be avoided passing a variable to the view to determine which radio options appear
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
        $cid = $tempRequest['cid'];
        $sid = $tempRequest['sid'];

        // determine is user is allowed to update profile
        if($r->authorize($cid))
        {
            $request = Requests::where('rid', $rid)
                ->where('cid', Auth::id())
                ->where('sid', $sid)
                ->first();

            $student = Students::where('sid', $sid)
                ->first();

            // find correct Center to update
            if($r->validate($tempRequest))
            {
                if($request->scheduled_date != $tempRequest['scheduled_date'])
                {
                    $dateChanged = 1;
                }
                else
                {
                    $dateChanged = 0;
                }

                $approvals = $r->decision(intval($dateChanged),
                    intval($request->center_approval.$request->student_approval),
                    intval($tempRequest['center_approval'].$request->student_approval));

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
                    // TODO ignored for now -> to fix in decision table or by avoidance on previous TODO
                }
                else
                {
                    // update request
                    $request->scheduled_date = $tempRequest['scheduled_date']." ".$tempRequest['scheduled_time'].":00";
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
                ->where('cid', Auth::id())
                ->where('sid', $sid)
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
