@extends("st.layouts.app")

@section('title', 'Request')

@section('main-content')

    <table>

        <tr><th colspan = "2"><hr><h1>Center Info</h1></th></tr>

        <tr>
            <th>Name:</th>
            <td>{{ $center->name }}</td>
        </tr>

        <tr>
            <th>Email:</th>
            <td>{{ $center_email }}</td>
        </tr>

        {{--TODO add rest of center info--}}

        <tr><th colspan = "2"><hr><h1>Exam Info</h1></th></tr>

        <tr>
            <th>Scheduled Date:</th>
            <td>{{ $request->scheduled_date or "Not Scheduled" }}</td>
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
            <td>{{ $request->center_notes }}</td>
        </tr>

        <tr>
            <th>Student Notes:</th>
            <td>{{ $request->student_notes }}</td>
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

        @if($editable)

            {{ Form::open(array('action' => 'StudentController@editRequest')) }}

            {{ Form::hidden('rid', $request->rid) }}
            {{ Form::hidden('cid', $center->cid) }}

            <tr>
                <td></td>
                <td>{{ Form::submit('Edit') }}</td>
            </tr>

            {{ Form::close() }}

        @endif

    </table>

@stop