@extends("cn.layouts.app")

@section('title', 'Request')

@section('main-content')
    <table>
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
            {{--TODO <td>{{ $student-> }}</td>--}}
        </tr>

        <tr>
            <th>Age:</th>
            <td>{{ $student->age }}</td>
        </tr>

        <tr>
            <th>Sex:</th>
            <td>{{ $student->sex }}</td>
        </tr>

        <tr><th colspan = "2"><hr>Exam Info</th></tr>

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
            <th>Student Notes:</th>
            <td>{{ $request->student_notes }}</td>
        </tr>

        <tr>
            <th>Center Notes:</th>
            <td>{{ $request->center_notes }}</td>
        </tr>

        {{--@if($editable)--}}
            {{ Form::open(array('action' => 'CenterController@editRequest')) }}
            {{ Form::hidden('rid', $request->rid) }}
            {{ Form::hidden('student', $student->sid) }}

            <tr>
                <td></td>
                <td>{{ Form::submit('Edit') }}</td>
            </tr>

            {{ Form::close() }}
        {{--@endif--}}
    </table>
@stop