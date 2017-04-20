{{--
    Author: Brett Schaad
--}}

@extends("cn.layouts.app")

@section('contentheader_title')Edit Your Request @endsection

@section('main-content')

    <table class="table table-responsive" width="100%">

        {{ Form::open(array('action' => 'CenterController@updateRequest')) }}

        <tr><th colspan = "2"><hr><h1>Student Info</h1></th></tr>

        <tr style="font-size: 1.3em;">
            <th>Name:</th>
            <td>{{ $student->firstName }} {{ $student->lastName }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Gender:</th>
            <td>{{ str_replace("_", " ", $student->sex) }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Age:</th>
            <td>{{ $student->age }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Phone Number:</th>
            <td>{{ $student->phone }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Email:</th>
            <td>{{ $student_email }}</td>
        </tr>

        <tr><th colspan = "2"><hr><h1>Institution Info</h1></th></tr>

        <tr style="font-size: 1.3em;">
            <th>Name:</th>
            <td>{{ $institution->institution_name }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Description:</th>
            <td>{{ $institution->description }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Phone:</th>
            <td>{{ $institution->phone }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Country:</th>
            <td>{{ $institution->country }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Province:</th>
            <td>{{ $institution->province }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>City:</th>
            <td>{{ $institution->city }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Street Address:</th>
            <td>{{ $institution->street_address }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Postal Code:</th>
            <td>{{ $institution->postal_code }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Contact Name:</th>
            <td>{{ $institution->contact_name }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Contact Email:</th>
            <td>{{ $institution->contact_email }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Contact Phone:</th>
            <td>{{ $institution->contact_phone }}</td>
        </tr>

        <tr><th colspan = "2"><hr><h1>Exam Info</h1></th></tr>

        <tr style="font-size: 1.3em;">
            <td>{{ Form::label('scheduled_date', 'Scheduled Date:') }}</td>
            <td>
                <span class="glyphicon glyphicon-calendar"></span>
                {{ Form::date('scheduled_date', \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request->scheduled_date)->toDateString()) }}
                <span class="glyphicon glyphicon-time"></span>
                {{ Form::time('scheduled_time', \Carbon\Carbon::createFromFormat('H:i', \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request->scheduled_time)->Format('H:i'))->toTimeString()) }}
            </td>
        </tr>


        <tr style="font-size: 1.3em;">
            <th>Preferred Date 1:</th>
            <td>{{ $request->preferred_date_1 }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Preferred Date 2:</th>
            <td>{{ $request->preferred_date_2 }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Course Code:</th>
            <td>{{ $request->course_code }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Additional Requirements:</th>
            <td>{{ $request->additional_requirements }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Exam Type:</th>
            <td>{{ $request->exam_type }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Exam Medium:</th>
            <td>{{ $request->exam_medium }}</td>
        </tr>


        <tr style="font-size: 1.3em;">
            <th>Computer Required:</th>
            <td>{{ $request->computer_required }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Student Notes:</th>
            <td>{{ $request->student_notes }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <td>{{ Form::label('center_notes', 'Center Notes:') }}</td>
            <td>{{ Form::textarea('center_notes', $request->center_notes) }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Student Approval Status:</th>
            <td>
                @if($request->student_approval == 2)
                    Approved
                @elseif($request->student_approval == 1)
                    Undecided
                @elseif($request->student_approval == 0)
                    Denied
                @endif
            </td>
        </tr>

        <tr style="font-size: 1.3em;">
            <td>{{ Form::label('center_approval', 'Center Approval Status:') }}</td>
            <td>{{ Form::select('center_approval', [
                '2' => 'Approve',
                '1' => 'Undecided',
                '0' => 'Deny'
                ], $request->center_approval
            ) }}</td>
        </tr>

        {{ Form::hidden('rid', $request->rid) }}
        {{ Form::hidden('cid', $request->cid) }}
        {{ Form::hidden('sid', $request->sid) }}
        {{ Form::hidden('iid', $request->iid) }}

        <tr>
            <th></th>
            <td>
                <div class="btn-group btn-group-lg">
                    {{ Form::submit('Submit', $attributes = array('id'=>"submitButton", 'class'=>"btn btn-primary")) }}
                </div>
            </td>
        </tr>

        {{ Form::close() }}

    </table>

@stop