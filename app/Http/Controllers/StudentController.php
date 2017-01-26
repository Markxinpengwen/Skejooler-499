<?php

use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Input as Input;
use App\Students as Students;
use Collective\Html\FormFacade as Form;

class StudentController extends Controller
{
    protected $sid = 1;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return StudentController::showProfile();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $sid
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        // find correct Student
        $student = Students::find($this->sid);

        return view('st/profile')->with('student', $student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $sid
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        // find correct Student
        $student = Students::find($this->sid);

        return view('st/profileEdit')->with('student', $student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $sid
     * @return \Illuminate\Http\Response
     */
    public function updateProfile()
    {
        // grab student info to be updated
        $tempstudent = Input::all();

        // find correct Student to update
        $student = Students::find($this->sid);

        //TODO - validate

        // update student
        $student->name = $tempstudent['name'];
        $student->email = $tempstudent['email'];
        $student->phone = $tempstudent['phone'];
        $student->description = $tempstudent['description'];
        //$student->canSupportOnlineExam = $tempstudent['canSupportOnlineExam'];
        $student->cost = $tempstudent['cost'];
        $student->street_name = $tempstudent['street_name'];
        $student->city = $tempstudent['city'];
        $student->province = $tempstudent['province'];
        $student->country = $tempstudent['country'];
        //$student->postal_code => $tempstudent['postal_code'];

        // save new values to DB
        $student->save();

        return StudentController::showProfile();
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
