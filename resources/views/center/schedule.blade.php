@extends("cn.layouts.app")

@section('title', 'Schedule')

@section('main-content')
    <table width = "100%">

        <tr><th colspan = "6">Upcoming Exams</th></tr>

        {{--TODO - need schedule table then implement display--}}

        {{--TODO delete after testing--}}
        {{--{{var_dump($upcoming)}}--}}
        {{--{{var_dump($pending)}}--}}
        {{--{{var_dump($past)}}--}}
        @foreach($upcoming as $u)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showSchedule')) }}
                {{--TODO add hidden value for editting{{ Form::hidden('id', $id) }}--}}
                <td align = "center">{{ $u->preferred_date_1 }}</td>
                <td align = "center">{{ $u->preferred_date_2 }}</td>
                <td align = "center">{{ $u->course_code }}</td>
                <td align = "center">{{ $u->exam_medium }}</td>
                <td align = "center">{{ $u->exam_type }}</td>
                <td align = "center">{{ Form::submit('View Details') }}</td>
            </tr>
        @endforeach

        <tr><th colspan = "6"><hr>Exams Pending Approval</th></tr>

        @foreach($pending as $p)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showSchedule')) }}
                {{--TODO add hidden value for editting{{ Form::hidden('id', $id) }}--}}
                <td align = "center">{{ $p->preferred_date_1 }}</td>
                <td align = "center">{{ $p->preferred_date_2 }}</td>
                <td align = "center">{{ $p->course_code }}</td>
                <td align = "center">{{ $p->exam_medium }}</td>
                <td align = "center">{{ $p->exam_type }}</td>
                <td align = "center">{{ Form::submit('View Details') }}</td>
            </tr>
        @endforeach

        <tr><th colspan = "6"><hr>Past Exams</th></tr>

        @foreach($past as $pa)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showSchedule')) }}
                {{--TODO add hidden value for editting{{ Form::hidden('id', $id) }}--}}
                <td align = "center">{{ $pa->preferred_date_1 }}</td>
                <td align = "center">{{ $pa->preferred_date_2 }}</td>
                <td align = "center">{{ $pa->course_code }}</td>
                <td align = "center">{{ $pa->exam_medium }}</td>
                <td align = "center">{{ $pa->exam_type }}</td>
                <td align = "center">{{ Form::submit('View Details') }}</td>
            </tr>
        @endforeach

    </table>
@stop