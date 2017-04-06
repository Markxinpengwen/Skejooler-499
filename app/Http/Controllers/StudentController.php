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

class StudentController extends Controller
{
    /**
     * Displays the default.
     */
    public function index()
    {
        // TODO - write condition logic
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
        // find correct Student and Institution for given Student
        $student = Students::where('sid', Auth::id())
            ->first();
        $institution = Institutions::where('iid', $student->iid)
            ->first();

        // find correct User
        $user = Users::where('uid', Auth::id())
            ->first();

        // send to profile view with Student and Institution models for given User and login email from User model
        return view('student/profile')
            ->with('student', $student)
            ->with('institution', $institution)
            ->with('login_email', $user->email);
    }

    /**
     * Show the form for editing the Student's Profile.
     */
    public function editProfile()
    {
        // find correct Student and Institution for given Student
        $student = Students::where('sid', Auth::id())
            ->first();
        $institution = Institutions::pluck('institution_name', 'iid');

        // find correct User
        $user = Users::where('uid', Auth::id())
            ->first();

        // send to profileEdit view with Student and Institution models for given User and login email from User model
        return view('student/profileEdit')
            ->with('student', $student)
            ->with('institution', $institution)
            ->with('login_email', $user->email);
    }

    /**
     * Update the Student's Profile in the database.
     */
    public function updateProfile()
    {
        // instantiate a Student model
        $s = new Students();

        // grab center info to be updated and determine cid
        $tempStudent = Input::all();
        $sid = $tempStudent['sid'];

        // determine ii User is allowed to update profile
        if($s->authorize($sid))
        {
            // determine if the input is valid, testing against the rules of the Student model
            if($s->validate($tempStudent))
            {
                // find correct Student to update
                $student = Students::where('sid', Auth::id())
                    ->first();

                // update Student values
                $student->firstName = $tempStudent['firstName'];
                $student->lastName = $tempStudent['lastName'];
                $student->sex = $tempStudent['sex'];
                $student->age = $tempStudent['age'];
                $student->iid = $tempStudent['iid'];
                $student->phone = $tempStudent['phone'];

                // save new values to DB
                $student->save();

                // send to profile view
                return StudentController::showProfile();
            }
            else
            {
                // invalid input based on rules of Student model
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
     * Display the Student's schedule.
     */
    public function showSchedule()
    {
        // FUTURE get correct current datetime
        date_default_timezone_set('America/Vancouver');

        // find all exam requests that Student and Center have approved and is in the future then determine the count
        $upcoming = Requests::where('sid', Auth::id())
            ->where('student_approval', 2)
            ->where('center_approval', 2)
            ->where('scheduled_date', '>=', date("Y-m-d h:i:s"))
            ->join('institutions', 'requests.iid', '=', 'institutions.iid')
            ->join('centers', 'requests.cid', '=', 'centers.cid')
            ->orderby('scheduled_date', 'asc')
            ->orderby('preferred_date_1', 'asc')
            ->orderby('preferred_date_2', 'asc')
            ->get();
        $upcomingCount = $upcoming->count();

        // find all exam requests that Student is undecided and Center has approved then determine the count
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

        // find all exam requests that Student has approved and Center is undecided then determine the count
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

        // find all exam requests that Student is undecided and Center has denied then determine the count
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

        // find all exam requests that Student has denied and Center is undecided then determine the count
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

        // find all exam requests that Student and Center have approved and is in the past then determine the count
        $past = Requests::where('sid', Auth::id())
            ->where('student_approval', 2)
            ->where('center_approval', 2)
            ->where('scheduled_date', '<', date("Y-m-d h:i:s"))
            ->join('institutions', 'requests.iid', '=', 'institutions.iid')
            ->join('centers', 'requests.cid', '=', 'centers.cid')
            ->orderby('scheduled_date', 'asc')
            ->orderby('preferred_date_1', 'asc')
            ->orderby('preferred_date_2', 'asc')
            ->get();
        $pastCount = $past->count();

        // send to schedule view with all requests for given User and their counts
        return view('student/schedule')
            ->with('upcoming', $upcoming)
            ->with('upcomingCount', $upcomingCount)
            ->with('pendingStudent', $pendingStudent)
            ->with('pendingStudentCount', $pendingStudentCount)
            ->with('pendingCenter', $pendingCenter)
            ->with('pendingCenterCount', $pendingCenterCount)
            ->with('deniedCenter', $deniedCenter)
            ->with('deniedCenterCount', $deniedCenterCount)
            ->with('deniedStudent', $deniedStudent)
            ->with('deniedStudentCount', $deniedStudentCount)
            ->with('past', $past)
            ->with('pastCount', $pastCount);
    }
    //---------------------------------------------------------------------------------------
    // REQUEST
    //---------------------------------------------------------------------------------------

    /**
     * Displays the Student's specified request.
     */
    public function showRequest()
    {
        // FUTURE get correct current datetime
        date_default_timezone_set('America/Vancouver');

        // grab Request info to be displayed and determine rid, cid, iid
        $temp = Input::all();
        $rid = $temp['rid'];
        $cid = $temp['cid'];
        $iid = $temp['iid'];

        // find correct Request, Center and Institution information
        $center = Centers::where('cid', $cid)
            ->first();
        $institution = Institutions::where('iid', $iid)
            ->first();
        $request = Requests::where('rid', $rid)
            ->where('sid', Auth::id())
            ->where('cid', $cid)
            ->first();

        // find correct User for Center from Request
        $user = Users::where('uid', $cid)
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

        // send to request view with Center, Institution, and Request models for given Request and User login email for Center from User model with editable boolean value
        return view('student/request')
            ->with('center', $center)
            ->with('request', $request)
            ->with('center_email', $user->email)
            ->with('institution', $institution)
            ->with('scheduled', $scheduled)
            ->with('editable', $editable);
    }

    /**
     * Show the form for editing the Student's specified request.
     */
    public function editRequest()
    {
        // grab Request info to be displayed and determine rid, cid, iid
        $temp = Input::all();
        $rid = $temp['rid'];
        $cid = $temp['cid'];
        $iid = $temp['iid'];

        // find correct Request, Center and Institution information
        $center = Centers::where('cid', $cid)
            ->first();
        $institution = Institutions::where('iid', $iid)
            ->first();
        $request = Requests::where('rid', $rid)
            ->where('sid', Auth::id())
            ->where('cid', $cid)
            ->first();

        // find correct User for Center from Request
        $user = Users::where('uid', $cid)
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

        // send to requestEdit view with Center, Institution, and Request models for given Request and User login email for Center from User model
        return view('student/requestEdit')
            ->with('request', $request)
            ->with('center', $center)
            ->with('institution', $institution)
            ->with('center_email', $user->email)
            ->with('scheduled', $scheduled);
    }

    /**
     * Update the Student's Request in the database.
     */
    public function updateRequest()
    {
        // instantiate a Request model
        $r = new Requests();

        // grab Request info to be updated and determine rid, cid, sid
        $tempRequest = Input::all();
        $rid = $tempRequest['rid'];
        $sid = $tempRequest['sid'];
        $cid = $tempRequest['cid'];

        // determine if User is allowed to update Request
        if($r->authorize($sid))
        {
            // determine if the input is valid, testing against the rules of the Request model
            if($r->validate($tempRequest))
            {
                // find correct Request to update
                $request = Requests::where('rid', $rid)
                    ->where('sid', Auth::id())
                    ->where('cid', $cid)
                    ->first();

                // test is the scheduled date has changed from its previous value
//                if($request->scheduled_date != $tempRequest['scheduled_date'])
//                {
//                    // scheduled date has changed
//                    $dateChanged = 1;
//                }
//                else
//                {
                    // scheduled date has not changed
                    $dateChanged = 0; // TODO - student cant change scheduled date... need diff value
//                }

                // determine new approval status from previous approval status and input approval status using Request model decision method and array
                $approvals = $r->decision(intval($dateChanged),
                    intval($request->student_approval.$request->center_approval),
                    intval($tempRequest['student_approval'].$request->center_approval));

                // undetermined approval status
                if($approvals[0] == 3 && $approvals[1] == 3)
                {
                    // FUTURE - nothing changes -> prevented operation
                }
                // both approvals are denied status, and request should be deleted
                elseif($approvals[0] == 4 && $approvals[1] == 4)
                {
                    // delete correct request
                    $this->deleteRequest($rid, $sid, $cid);

                    // send to schedule view
                    return StudentController::showSchedule();
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
                    $request->preferred_date_1 = $tempRequest['preferred_date_1']." ".$tempRequest['preferred_time_1'];
                    $request->preferred_date_2 = $tempRequest['preferred_date_2']." ".$tempRequest['preferred_time_2'];
                    $request->course_code = $tempRequest['course_code'];
                    $request->additional_requirements = $tempRequest['additional_requirements'];
                    $request->exam_type = $tempRequest['exam_type'];
                    $request->exam_medium = $tempRequest['exam_medium'];
                    $request->computer_required = $tempRequest['computer_required'];
                    $request->student_notes = $tempRequest['student_notes'];

                    $request->student_approval = $approvals[0];
                    $request->center_approval = $approvals[1];

                    // save new values to DB
                    $request->save();

                    // send to schedule view
                    return StudentController::showSchedule();
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
    public function deleteRequest($rid, $sid, $cid)
    {
        // instantiate a Request model
        $r = new Requests();

        // determine if User is allowed to delete Request
        if($r->authorize($rid, $sid))
        {
            // find correct Request to delete
            $request = Requests::where('rid', $rid)
                ->where('sid', Auth::id())
                ->where('cid', $cid)
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

    //---------------------------------------------------------------------------------------
    // BOOKING FORM
    //---------------------------------------------------------------------------------------

    /**
     * Display the exam request form.
     */
    public function showExamRequestForm()
    {
        // find correct Student and Institution for given Student
        $student = Students::where('sid', Auth::id())
            ->first();
        $institution = Institutions::where('iid', $student->iid)
            ->first();

        // find correct User
        $user = Users::where('uid', Auth::id())
            ->first();

        // FUTURE - get map values from DB for dynamic map
        //$mapvalues = Map->get();

        // send to examRequestForm view with Student and Institution models for given User and login email from User model
        return view('student/examRequestForm')
            ->with('student_email', $user->email)
            ->with('student', $student)
            ->with('institution', $institution);
    }

    /**
     * Create a new Request in the database
     */
    public function createRequest()
    {
        // grab Request info
        $tempRequest = Input::all();

        // instantiate a Request model
        $request = new Requests();

        // determine if the input is valid, testing against the rules of the Request model
        if($request->validate($tempRequest))
        {
            // set Request values
            $request->sid = Auth::id();
            $request->iid = $tempRequest['iid'];
            $request->cid = $tempRequest['cid'];
            $request->preferred_Date_1 = $tempRequest['preferred_date_1'];
            $request->preferred_Date_2 = $tempRequest['preferred_date_2'];
            $request->course_code = $tempRequest['course_code'];
            $request->additional_requirements = $tempRequest['additional_requirements'];
            $request->exam_type = $tempRequest['exam_type'];
            $request->exam_medium = $tempRequest['exam_medium'];
            $request->student_notes = $tempRequest['student_notes'];
            $request->student_approval = 2;
            $request->center_approval = 1;

            // save new Request to DB
            $request->save();

            // send to schedule view
            return StudentController::showSchedule();
        }
        else
        {
            // invalid input based on rules of Request model
            redirect();
        }
    }
}
