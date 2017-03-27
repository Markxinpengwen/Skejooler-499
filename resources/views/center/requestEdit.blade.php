@extends("cn.layouts.app")

@section('title', 'Request')

@section('main-content')

    <table>

        {{ Form::open(array('action' => 'CenterController@updateRequest')) }}

        <tr><th colspan = "2"><hr><h1>Student Info</h1></th></tr>

        <tr>
            <th>Name:</th>
            <td>{{ $student->firstName }} {{ $student->lastName }}</td>
        </tr>

        <tr>
            <th>Gender:</th>
            <td>{{ str_replace("_", " ", $student->sex) }}</td>
        </tr>

        <tr>
            <th>Age:</th>
            <td>{{ $student->age }}</td>
        </tr>

        <tr>
            <th>Institution Number:</th>
            <td>{{ $student->institution }}</td>
        </tr>

        <tr>
            <th>Phone Number:</th>
            <td>{{ $student->phone }}</td>
        </tr>

        <tr>
            <th>Email:</th>
            <td>{{ $student_email }}</td>
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
            <td>{{ Form::label('scheduled_date', 'Scheduled Date:') }}</td>
            <td>{{ Form::datetime('scheduled_date', $request->scheduled_date) }}</td>
        </tr>

        <tr>
            <th>Preferred Date 1:</th>
            <td>{{ $request->preferred_date_1 }}</td>
        </tr>

        <tr>
            <th>Preferred Date 2:</th>
            <td>{{ $request->preferred_date_2 }}</td>
        </tr>

        <tr>
            <th>Course Code:</th>
            <td>{{ $request->course_code }}</td>
        </tr>

        <tr>
            <th>Additional Requirements:</th>
            <td>{{ $request->additional_requirements }}</td>
        </tr>

        <tr>
            <th>Exam Type:</th>
            <td>{{ $request->exam_type }}</td>
        </tr>

        <tr>
            <th>Exam Medium:</th>
            <td>{{ $request->exam_medium }}</td>
        </tr>

        <tr>
            <th>Student Notes:</th>
            <td>{{ $request->student_notes }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('center_notes', 'Center Notes:') }}</td>
            <td>{{ Form::textarea('center_notes', $request->center_notes) }}</td>
        </tr>

        <tr>
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

        <tr>
            <td>{{ Form::label('center_approval', 'Center Approval Status:') }}</td>
            <td>
                @if($request->center_approval == 2)
                    Approve{{ Form::radio('center_approval', '2', true) }}
                    Undecided{{ Form::radio('center_approval', '1') }}
                    Deny{{ Form::radio('center_approval', '0') }}
                @elseif($request->center_approval == 1)
                    Approve{{ Form::radio('center_approval', '2') }}
                    Undecided{{ Form::radio('center_approval', '1', true) }}
                    Deny{{ Form::radio('center_approval', '0')}}
                @elseif($request->center_approval == 0)
                    Approve{{ Form::radio('center_approval', '2') }}
                    Undecided{{ Form::radio('center_approval', '1') }}
                    Deny{{ Form::radio('center_approval', '0', true)}}
                @endif
            </td>
        </tr>

        {{ Form::hidden('rid', $request->rid) }}
        {{ Form::hidden('cid', $request->cid) }}
        {{ Form::hidden('sid', $request->sid) }}
        {{ Form::hidden('iid', $request->iid) }}

        <tr>
            <td></td>
            <td>{{ Form::submit('Submit') }}</td>
        </tr>

        {{ Form::close() }}

    </table>

@stop