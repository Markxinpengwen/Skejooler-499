<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Auth as Auth;
use App\Centers as Centers;
use App\Students as Students;
use App\Requests as Requests;
use App\User as Users;
use App\Institutions as Institutions;

class StudentController extends Controller
{
    /**
     * Displays the default.
     */
    public function index()
    {
        // TODO - write condition logic to
        //if no requests made -> requestForm
        //if first time -> profile
        return StudentController::showSchedule();
    }

    //---------------------------------------------------------------------------------------
    // PROFILE
    //---------------------------------------------------------------------------------------

    /**
     * Displays the Student's profile.
     */
    public function showProfile()
    {
        // find correct Center
        $student = Students::where('sid', Auth::id())
            ->first();

        $user = Users::where('uid', Auth::id())
        ->first();

        return view('student/profile')
            ->with('student', $student)
            ->with('login_email', $user->email);
    }

    /**
     * Show the form for editing the Student's Profile.
     */
    public function editProfile()
    {
        // find correct Center
        $student = Students::where('sid', Auth::id())
            ->first();

        $user = Users::where('uid', Auth::id())
            ->first();

        return view('student/profileEdit')
            ->with('student', $student)
            ->with('login_email', $user->email);
    }

    /**
     * Update the Student's Profile in the database.
     * TODO use center as timezone
     */
    public function updateProfile()
    {
        $s = new Students();

        // grab center info to be updated
        $tempStudent = Input::all();
        $sid = $tempStudent['sid'];

        // determine is user is allowed to update profile
        if($s->authorize($sid))
        {
            // find correct Center to update
            if($s->validate($tempStudent))
            {
                $student = Students::where('sid', Auth::id())
                    ->first();

                // update center
                $student->firstName = $tempStudent['firstName'];
                $student->lastName = $tempStudent['lastName'];
                $student->sex = $tempStudent['sex'];
                $student->age = $tempStudent['age'];
                $student->institution = $tempStudent['institution'];
                $student->phone = $tempStudent['phone'];

                // save new values to DB
                $student->save();
                return StudentController::showProfile();
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
     * Display the Student's schedule.
     */
    public function showSchedule()
    {
        $upcoming = Requests::where('sid', Auth::id())
            ->where('student_approval', 2)
            ->where('center_approval', 2)
            ->where('scheduled_date', '>=', date("Y-m-d h:i:s"))
            ->join('institutions', 'requests.iid', '=', 'institutions.iid')
            ->join('centers', 'requests.cid', '=', 'centers.cid')
            ->orderby('scheduled_date', 'asc')
            ->orderby('preferred_date_1', 'asc')
            ->orderby('preferred_date_2', 'asc')
            ->get(); //TODO get correct current datetime
        $upcomingCount = $upcoming->count();

        $pendingStudent = Requests::where('sid', Auth::id())
            ->where('student_approval', 1)
            ->where('center_approval', 2)
            ->join('institutions', 'requests.iid', '=', 'institutions.iid')
            ->join('centers', 'requests.cid', '=', 'centers.cid')
            ->orderby('scheduled_date', 'asc')
            ->orderby('preferred_date_1', 'asc')
            ->orderby('preferred_date_2', 'asc')
            ->get();
        $pendingStudentCount = $pendingStudent->count();

        $pendingCenter = Requests::where('sid', Auth::id())
            ->where('student_approval', 2)
            ->where('center_approval', 1)
            ->join('institutions', 'requests.iid', '=', 'institutions.iid')
            ->join('centers', 'requests.cid', '=', 'centers.cid')
            ->orderby('scheduled_date', 'asc')
            ->orderby('preferred_date_1', 'asc')
            ->orderby('preferred_date_2', 'asc')
            ->get();
        $pendingCenterCount = $pendingCenter->count();

        $deniedStudent = Requests::where('sid', Auth::id())
            ->where('student_approval', 0)
            ->where('center_approval', 1)
            ->join('institutions', 'requests.iid', '=', 'institutions.iid')
            ->join('centers', 'requests.cid', '=', 'centers.cid')
            ->orderby('scheduled_date', 'asc')
            ->orderby('preferred_date_1', 'asc')
            ->orderby('preferred_date_2', 'asc')
            ->get();
        $deniedStudentCount = $deniedStudent->count();

        $deniedCenter = Requests::where('sid', Auth::id())
            ->where('student_approval', 1)
            ->where('center_approval', 0)
            ->join('institutions', 'requests.iid', '=', 'institutions.iid')
            ->join('centers', 'requests.cid', '=', 'centers.cid')
            ->orderby('scheduled_date', 'asc')
            ->orderby('preferred_date_1', 'asc')
            ->orderby('preferred_date_2', 'asc')
            ->get();
        $deniedCenterCount = $deniedCenter->count();

        $past = Requests::where('sid', Auth::id())
            ->where('student_approval', 2)
            ->where('center_approval', 2)
            ->where('scheduled_date', '<', date("Y-m-d h:i:s"))
            ->join('institutions', 'requests.iid', '=', 'institutions.iid')
            ->join('centers', 'requests.cid', '=', 'centers.cid')
            ->orderby('scheduled_date', 'asc')
            ->orderby('preferred_date_1', 'asc')
            ->orderby('preferred_date_2', 'asc')
            ->get(); // TODO get correct current datetime
        $pastCount = $past->count();

        return view('student/schedule')
            ->with('upcoming', $upcoming)
            ->with('upcomingCount', $upcomingCount)
            ->with('pendingStudent', $pendingStudent)
            ->with('pendingStudentCount', $pendingStudentCount)
            ->with('pendingCenter', $pendingCenter)
            ->with('pendingCenterCount', $pendingCenterCount)
            ->with('deniedStudent', $deniedStudent)
            ->with('deniedStudentCount', $deniedStudentCount)
            ->with('deniedCenter', $deniedCenter)
            ->with('deniedCenterCount', $deniedCenterCount)
            ->with('past', $past)
            ->with('pastCount', $pastCount); //TODO fix code ordering for easy reading
    }
    //---------------------------------------------------------------------------------------
    // REQUEST
    //---------------------------------------------------------------------------------------

    /**
     * Displays the Student's specified request.
     */
    public function showRequest()
    {
        $temp = Input::all();

        $rid = $temp['rid'];
        $cid = $temp['cid'];
        $iid = $temp['iid'];

        // find correct Request and Student information
        $center = Centers::where('cid', $cid)
            ->first();
        $institution = Institutions::where('iid', $iid)
            ->first();
        $request = Requests::where('rid', $rid)
            ->where('sid', Auth::id())
            ->where('cid', $cid)
            ->first();

        // grab student email from user table
        $user = Users::where('uid', $cid)
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

        return view('student/request')
            ->with('center', $center)
            ->with('request', $request)
            ->with('center_email', $user->email)
            ->with('institution', $institution)
            ->with('editable', $editable);
    }

    /**
     * Show the form for editing the Student's specified request.
     */
    public function editRequest()
    {
        $temp = Input::all();

        $rid = $temp['rid'];
        $cid = $temp['cid'];
        $iid = $temp['iid'];

        // find correct Request and Center information
        $center = Centers::where('cid', $cid)
            ->first();
        $institution = Institutions::where('iid', $iid)
            ->first();
        $request = Requests::where('rid', $rid)
            ->where('sid', Auth::id())
            ->where('cid', $cid)
            ->first();

        // grab student email from user table
        $user = Users::where('uid', $cid)
            ->first();

        return view('student/requestEdit')
            ->with('request', $request)
            ->with('center', $center)
            ->with('institution', $institution)
            ->with('center_email', $user->email);

        //TODO - write logic so that invalid states can be avoided passing a variable to the view to determine which radio options appear
    }

    /**
     * Update the Student's Request in the database.
     */
    public function updateRequest()
    {
        $r = new Requests();

        // grab center info to be updated
        $tempRequest = Input::all();
        $rid = $tempRequest['rid'];
        $sid = $tempRequest['sid'];
        $cid = $tempRequest['cid'];

        // determine is user is allowed to update profile
        if($r->authorize($rid, $sid))
        {
            $request = Requests::where('rid', $rid)
                ->where('sid', Auth::id())
                ->where('cid', $cid)
                ->first();

            $center = Centers::where('cid', $cid)
                ->first();

            // find correct Center to update
            if($r->validate($tempRequest))
            {
//                if($request->scheduled_date != $tempRequest['scheduled_date'])
//                {
//                    $dateChanged = 1;
//                }
//                else
//                {
                    $dateChanged = 0; // TODO - student cant change scheduled date... need diff value
//                }

                $approvals = $r->decision(intval($dateChanged),
                    intval($request->student_approval.$request->center_approval),
                    intval($tempRequest['student_approval'].$request->center_approval));

                if($approvals[0] == 3 && $approvals[1] == 3)
                {
                    //nothing changes prevented operation
                }
                elseif($approvals[0] == 4 && $approvals[1] == 4)
                {
                    $this->deleteRequest($rid, $sid, $cid);

                    return StudentController::showSchedule();
                }
                elseif($approvals[0] == 8 && $approvals[1] == 8)
                {
                    // TODO ignored for now -> to fix in decision table or by avoidance on previous TODO
                }
                else
                {
                    // update request
                    $request->preferred_Date_1 = $tempRequest['preferred_date_1'];
                    $request->preferred_Date_2 = $tempRequest['preferred_date_2'];
                    $request->course_code = $tempRequest['course_code'];
                    $request->additional_requirements = $tempRequest['additional_requirements'];
                    $request->exam_type = $tempRequest['exam_type'];
                    $request->exam_medium = $tempRequest['exam_medium'];
                    $request->student_notes = $tempRequest['student_notes'];

                    $request->student_approval = $approvals[0];
                    $request->center_approval = $approvals[1];

                    // save new values to DB
                    $request->save();

                    return StudentController::showRequest()
                        ->with('request', $request)
                        ->with('center', $center);
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
    public function deleteRequest($rid, $sid, $cid)
    {
        $r = new Requests();

        if($r->authorize($rid, $sid))
        {
            $request = Requests::where('rid', $rid)
                ->where('sid', Auth::id())
                ->where('cid', $cid)
                ->first();

            $request->delete();
        }
        else
        {
            // wrong user
            redirect();
        }
    }

    //---------------------------------------------------------------------------------------
    // BOOKING FORM
    //---------------------------------------------------------------------------------------

    public function showExamRequestForm()
    {
        return view('student/examRequestForm');
    }

    public function makeRequest()
    {
        // grab center info to be updated
        $tempRequest = Input::all();

        $request = new Requests();

        // find correct Center to update
        if($request->validate($tempRequest))
        {
            // update request
            $request->preferred_Date_1 = $tempRequest['preferred_date_1'];
            $request->preferred_Date_2 = $tempRequest['preferred_date_2'];
            $request->course_code = $tempRequest['course_code'];
            $request->additional_requirements = $tempRequest['additional_requirements'];
            $request->exam_type = $tempRequest['exam_type'];
            $request->exam_medium = $tempRequest['exam_medium'];
            $request->student_notes = $tempRequest['student_notes'];

            $request->student_approval = 2;
            $request->center_approval = 1;

            // save new values to DB
            $request->save();

            return StudentController::showSchedule();
        }
        else
        {
            // invalid input
            redirect(); //->with('errors', $r->error());
        }
    }
}
