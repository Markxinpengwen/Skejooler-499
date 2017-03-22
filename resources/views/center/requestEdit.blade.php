@extends("cn.layouts.app")

@section('title', 'Request')

@section('main-content')

    <table>
        {{ Form::open(array('action' => 'CenterController@updateRequest')) }}
        {{ Form::hidden('rid', $request->rid) }}
        {{ Form::hidden('center', $request->center) }}
        {{ Form::hidden('student', $request->student) }}

        <tr><th colspan = "2"><hr>Student Info</th></tr>

        <tr>
            <th>Name:</th>
            <td>{{ $student->firstName }} {{ $student->lastName }}</td>
        </tr>

        <tr>
            <th>Institution:</th>
            <td>{{ $student->institution }}</td>
        </tr>

        <tr>
            <th>Phone:</th>
            <td>{{ $student->phone }}</td>
        </tr>

        <tr>
            <th>Email:</th>
            <td>{{ $student_email }}</td>
        </tr>

        <tr>
            <th>Age:</th>
            <td>{{ $student->age }}</td>
        </tr>

        <tr>
            <th>Sex:</th>
            <td>{{ str_replace("_", " ", $student->sex) }}</td>
        </tr>

        <tr><th colspan = "2"><hr>Exam Info</th></tr>

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

        <tr>
            <td></td>
            <td>{{ Form::submit('Submit') }}</td>
        </tr>

        {{ Form::close() }}
    </table>
@stop