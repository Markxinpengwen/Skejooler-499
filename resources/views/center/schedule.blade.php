@extends("cn.layouts.app")

@section('title', 'Schedule')

@section('main-content')
    <table>

        <tr><th colspan = "6">Upcoming Exams</th></tr>

        {{--TODO - need schedule table then implement display--}}
        @php $id = 0 @endphp
        @while($id < 3)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showSchedule')) }}
                {{ Form::hidden('id', $id) }}
                <td>April 10th, 2016</td>
                <td>11:00am</td>
                <td>POL SCI 100</td>
                <td>BCIT - Vancouver</td>
                <td>Midterm 1</td>
                <td>{{ Form::submit('View Details') }}</td>
                @php $id++ @endphp
            </tr>
        @endwhile

        <tr><th colspan = "6"><hr>Exams Pending Approval</th></tr>

        @php $id = 0 @endphp
        @while($id < 6)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showSchedule')) }}
                {{ Form::hidden('id', $id) }}
                <td>April 10th, 2016</td>
                <td>11:00am</td>
                <td>POL SCI 100</td>
                <td>BCIT - Vancouver</td>
                <td>Midterm 1</td>
                <td>{{ Form::submit('View Details') }}</td>
                @php $id++ @endphp
            </tr>
        @endwhile

        <tr><th colspan = "6"><hr>Past Exams</th></tr>

        @php $id = 0 @endphp
        @while($id < 5)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showSchedule')) }}
                {{ Form::hidden('id', $id) }}
                <td>{{ $id }}</td>
                <td>{{ $id }}</td>
                <td>{{ $id }}</td>
                <td>{{ $id }}</td>
                <td>{{ $id }}</td>
                <td>{{ Form::submit('View Details') }}</td>
                @php $id++ @endphp
            </tr>
        @endwhile

    </table>
@stop