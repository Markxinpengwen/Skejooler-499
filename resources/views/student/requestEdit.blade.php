@extends("st.layouts.app")

@section('title', 'Request')

@section('main-content')

    <table>

        {{ Form::open(array('action' => 'StudentController@updateRequest')) }}

        <tr><th colspan = "2"><hr><h1>Center Info</h1></th></tr>

        <tr>
            <th>Name:</th>
            <td>{{ $center->name }}</td>
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
            <td>{{ $institution->name }}</td>
        </tr>

        <tr>
            <th>Description:</th>
            <td>{{ $institution->description }}</td>
        </tr>

        <tr><th colspan = "2"><hr><h1>Exam Info</h1></th></tr>

        <tr>
            <th>Scheduled Date:</th>
            <td>{{ $request->scheduled_date }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('preferred_date_1', 'Preferred Date 1:') }}</td>
            <td>{{ Form::datetime('preferred_date_1', $request->preferred_date_1) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('preferred_date_2', 'Preferred Date 12') }}</td>
            <td>{{ Form::datetime('preferred_date_2', $request->preferred_date_2) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('course_code', 'Course Code:') }}</td>
            <td>{{ Form::datetime('course_code', $request->course_code) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('additional_requirements', 'Additional Requirements:') }}</td>
            <td>{{ Form::datetime('additional_requirements', $request->additional_requirements) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('exam_type', 'Exam Type:') }}</td>
            <td>{{ Form::datetime('exam_type', $request->exam_type) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('exam_medium', 'Exam Medium:') }}</td>
            <td>{{ Form::datetime('exam_medium', $request->exam_medium) }}</td>
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
            <td>
                @if($request->student_approval == 2)
                    Approve{{ Form::radio('student_approval', '2', true) }}
                    Undecided{{ Form::radio('student_approval', '1') }}
                    Deny{{ Form::radio('student_approval', '0') }}
                @elseif($request->student_approval == 1)
                    Approve{{ Form::radio('student_approval', '2') }}
                    Undecided{{ Form::radio('student_approval', '1', true) }}
                    Deny{{ Form::radio('student_approval', '0')}}
                @elseif($request->student_approval == 0)
                    Approve{{ Form::radio('student_approval', '2') }}
                    Undecided{{ Form::radio('student_approval', '1') }}
                    Deny{{ Form::radio('student_approval', '0', true)}}
                @endif
            </td>
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