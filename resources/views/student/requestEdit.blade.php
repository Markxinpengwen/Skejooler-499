@extends("cn.layouts.app")

@section('title', 'Request')

@section('main-content')

    <table>

        {{ Form::open(array('action' => 'CenterController@updateRequest')) }}

        <tr><th colspan = "2"><hr><h1>Center Info</h1></th></tr>

        <tr>
            <th>Name:</th>
            <td>{{ $center->name }}</td>
        </tr>

        <tr>
            <th>Email:</th>
            <td>{{ $center_email }}</td>
        </tr>

        {{--TODO - add rest of center into--}}

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
            <th>Center Notes:</th>
            <td>{{ $request->centert_notes }}</td>
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

        <tr>
            <td></td>
            <td>{{ Form::submit('Submit') }}</td>
        </tr>

        {{ Form::close() }}

    </table>

@stop