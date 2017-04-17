{{--
    Author: Brett Schaad
--}}

@extends("st.layouts.app")

@section('contentheader_title')Edit Your Request @endsection

@section('main-content')

    <table>

        {{ Form::open(array('action' => 'StudentController@updateRequest')) }}

        <tr><th colspan = "2"><hr><h1>Center Info</h1></th></tr>

        <tr>
            <th>Name:</th>
            <td>{{ $center->center_name }}</td>
        </tr>

        <tr>
            <th>Description:</th>
            <td>{{ $center->description or "Description not found" }}</td>
        </tr>

        <tr>
            <th>Online Exam Support:</th>
            <td>
                @if($center->canSupportOnlineExam == 1)
                    Yes
                @elseif($center->canSupportOnlineExam == 0)
                    No
                @else
                    Online support not found
                @endif</td>
        </tr>

        <tr>
            <th>Exam Cost:</th>
            <td>{{'$'}}{{ $center->cost or "Exam cost not found" }}</td>
        </tr>

        <tr>
            <th>Phone Number:</th>
            <td>{{ $center->phone or "Phone number not found" }}</td>
        </tr>

        <tr>
            <th>Center Email:</th>
            <td>{{ $center_email }}</td>
        </tr>

        <tr>
            <th>Street Address:</th>
            <td>{{ $center->street_address or "Street address not found" }}</td>
        </tr>

        <tr>
            <th>City:</th>
            <td>{{ $center->city or "City not found" }}</td>
        </tr>

        <tr>
            <th>Province:</th>
            <td>{{ str_replace("_", " ", $center->province) }}</td>
        </tr>

        <tr>
            <th>Country:</th>
            <td>{{ $center->country or "Country not found" }}</td>
        </tr>

        <tr>
            <th>Postal Code:</th>
            <td>{{ $center->postal_code }}</td>
        </tr>

        {{--TODO - delete--}}
        <tr>
            <th>Longitude:</th>
            <td>{{ $center->longitude }}</td>
        </tr>

        {{--TODO - delete--}}
        <tr>
            <th>Latitude:</th>
            <td>{{ $center->latitude }}</td>
        </tr>

        <tr><th colspan = "2"><hr><h1>Institution Info</h1></th></tr>

        <tr>
            <th>Name:</th>
            <td>{{ $institution->institution_name }}</td>
        </tr>

        <tr>
            <th>Description:</th>
            <td>{{ $institution->description }}</td>
        </tr>

        <tr>
            <th>Phone:</th>
            <td>{{ $institution->phone }}</td>
        </tr>

        <tr>
            <th>Country:</th>
            <td>{{ $institution->country }}</td>
        </tr>

        <tr>
            <th>Province:</th>
            <td>{{ $institution->province }}</td>
        </tr>

        <tr>
            <th>City:</th>
            <td>{{ $institution->city }}</td>
        </tr>

        <tr>
            <th>Street Address:</th>
            <td>{{ $institution->street_address }}</td>
        </tr>

        <tr>
            <th>Postal Code:</th>
            <td>{{ $institution->postal_code }}</td>
        </tr>

        <tr>
            <th>Contact Name:</th>
            <td>{{ $institution->contact_name }}</td>
        </tr>

        <tr>
            <th>Contact Email:</th>
            <td>{{ $institution->contact_email }}</td>
        </tr>

        <tr>
            <th>Contact Phone:</th>
            <td>{{ $institution->contact_phone }}</td>
        </tr>

        <tr><th colspan = "2"><hr><h1>Exam Info</h1></th></tr>

        <tr>
            <th>Scheduled Date:</th>
            <td>
                @if($request->scheduled_date == "1970-01-02 00:00:00" || $request->scheduled_date == null)
                    {{ "Date not scheduled" }}
                @else
                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request->scheduled_date)->format('l\\, jS \\of F Y \\a\\t h:i A') }}
                @endif
            </td>
        </tr>

        <tr>
            <td>{{ Form::label('preferred_date_1', 'First Preferred Date:') }}</td>
            <td>{{ Form::date('preferred_date_1', \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request->preferred_date_1)->toDateString()) }}</td>
            <td>{{ Form::time('preferred_time_1', \Carbon\Carbon::createFromFormat('H:i', \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request->preferred_date_1)->Format('H:i'))->toTimeString()) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('preferred_date_2', 'Second Preferred Date') }}</td>
            <td>{{ Form::date('preferred_date_2', \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request->preferred_date_2)->toDateString()) }}</td>
            <td>{{ Form::time('preferred_time_2', \Carbon\Carbon::createFromFormat('H:i', \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request->preferred_date_2)->Format('H:i'))->toTimeString()) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('course_code', 'Course Code:') }}</td>
            <td>{{ Form::text('course_code', $request->course_code) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('additional_requirements', 'Additional Requirements:') }}</td>
            <td>{{ Form::textarea('additional_requirements', $request->additional_requirements) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('exam_type', 'Exam Type:') }}</td>
            <td>{{ Form::select('exam_type', [
                'Midterm' => 'Midterm',
                'Final' => 'Final',
                'Other' => 'Other'
                ], $request->exam_type
            ) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('exam_medium', 'Exam Medium:') }}</td>
            <td>{{ Form::select('exam_medium', [
                'Paper' => 'Paper',
                'Online' => 'Online',
                'Other' => 'Other'
                ], $request->exam_medium
            ) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('computer_required', 'Computer Required:') }}</td>
            <td>{{ Form::select('computer_required', [
                'Yes' => 'Yes',
                'No' => 'No'
                ], $request->computer_required
            ) }}</td>
        </tr>

        <tr>
            <th>Center Notes:</th>
            <td>{{ $request->center_notes }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('student_notes', 'Student Notes:') }}</td>
            <td>{{ Form::textarea('student_notes', $request->student_notes) }}</td>
        </tr>

        <tr>
            <th>Center Approval Status:</th>
            <td>
                @if($request->center_approval == 2)
                    Approved
                @elseif($request->center_approval == 1)
                    Undecided
                @elseif($request->center_approval == 0)
                    Denied
                @endif
            </td>
        </tr>

        <tr>
            <td>{{ Form::label('student_approval', 'Student Approval Status:') }}</td>
            <td>{{ Form::select('student_approval', [
                '2' => 'Approve',
                '1' => 'Undecided',
                '0' => 'Deny'
                ], $request->student_approval
            ) }}</td>
        </tr>

        {{ Form::hidden('rid', $request->rid) }}
        {{ Form::hidden('sid', $request->sid) }}
        {{ Form::hidden('cid', $request->cid) }}
        {{ Form::hidden('iid', $request->iid) }}

        <tr>
            <td></td>
            <td>{{ Form::submit('Submit') }}</td>
        </tr>

        {{ Form::close() }}

    </table>

@stop