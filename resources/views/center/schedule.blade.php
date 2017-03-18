@extends("cn.layouts.app")

@section('title', 'Schedule')

@section('main-content')
    <table width = "100%">

        <tr><th colspan = "6" align = "center">Upcoming Exams</th></tr>

        @foreach($upcoming as $u)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showRequest')) }}
                <td align = "center">{{ $u->scheduled_date }}</td>
                <td align = "center">{{ $u->course_code }}</td>
                <td align = "center">{{ $u->exam_medium }}</td>
                <td align = "center">{{ $u->exam_type }}</td>
                {{ Form::hidden('rid', $u->rid) }}
                {{ Form::hidden('student', $u->student) }}
                {{ Form::hidden('center', $u->center) }}
                <td align = "center">{{ Form::submit('View Details') }}</td>
                {{ Form::close() }}
            </tr>
        @endforeach

        <tr><th colspan = "6"><hr>Exams Pending Center's Approval</th></tr>

        @foreach($pendingCenter as $pc)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showRequest')) }}
                <td align = "center">{{ $pc->preferred_date_1 }}</td>
                <td align = "center">{{ $pc->preferred_date_2 }}</td>
                <td align = "center">{{ $pc->course_code }}</td>
                <td align = "center">{{ $pc->exam_medium }}</td>
                <td align = "center">{{ $pc->exam_type }}</td>
                {{ Form::hidden('rid', $pc->rid) }}
                {{ Form::hidden('student', $pc->student) }}
                {{ Form::hidden('center', $pc->center) }}
                <td align = "center">{{ Form::submit('View Details') }}</td>
                {{ Form::close() }}
            </tr>
        @endforeach

        <tr><th colspan = "6"><hr>Exams Pending Student's Approval</th></tr>

        @foreach($pendingStudent as $ps)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showRequest')) }}
                <td align = "center">{{ $ps->preferred_date_1 }}</td>
                <td align = "center">{{ $ps->preferred_date_2 }}</td>
                <td align = "center">{{ $ps->course_code }}</td>
                <td align = "center">{{ $ps->exam_medium }}</td>
                <td align = "center">{{ $ps->exam_type }}</td>
                {{ Form::hidden('rid', $ps->rid) }}
                {{ Form::hidden('student', $ps->student) }}
                {{ Form::hidden('center', $ps->center) }}
                <td align = "center">{{ Form::submit('View Details') }}</td>
                {{ Form::close() }}
            </tr>
        @endforeach

        <tr><th colspan = "6"><hr>Exams Denied by Student</th></tr>

        @foreach($denied as $d)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showRequest')) }}
                {{--TODO add hidden value for editting{{ Form::hidden('id', $id) }}--}}
                <td align = "center">{{ $d->preferred_date_1 }}</td>
                <td align = "center">{{ $d->preferred_date_2 }}</td>
                <td align = "center">{{ $d->course_code }}</td>
                <td align = "center">{{ $d->exam_medium }}</td>
                <td align = "center">{{ $d->exam_type }}</td>
                {{ Form::hidden('rid', $d->rid) }}
                {{ Form::hidden('student', $d->student) }}
                {{ Form::hidden('center', $d->center) }}
                <td align = "center">{{ Form::submit('View Details') }}</td>
                {{ Form::close() }}
            </tr>
        @endforeach

        <tr><th colspan = "6"><hr>Past Exams</th></tr>

        @foreach($past as $pa)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showRequest')) }}
                {{--TODO add hidden value for editting{{ Form::hidden('id', $id) }}--}}
                <td align = "center">{{ $pa->scheduled_date }}</td>
                <td align = "center">{{ $pa->course_code }}</td>
                <td align = "center">{{ $pa->exam_medium }}</td>
                <td align = "center">{{ $pa->exam_type }}</td>
                {{ Form::hidden('rid', $pa->rid) }}
                {{ Form::hidden('student', $pa->student) }}
                {{ Form::hidden('center', $pa->center) }}
                <td align = "center">{{ Form::submit('View Details') }}</td>
                {{ Form::close() }}
            </tr>
        @endforeach

    </table>
@stop