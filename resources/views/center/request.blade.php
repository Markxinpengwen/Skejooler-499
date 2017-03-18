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
            <td>{{ $request->scheduled_date }}</td>
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