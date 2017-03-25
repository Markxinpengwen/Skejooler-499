@extends("cn.layouts.app")

@section('title', 'Schedule')

@section('main-content')
    <table width = "100%">

        <tr><td><hr></td></tr>

        <tr>
            <th colspan = "6" align = "center">
                <h1>Upcoming Exams</h1>
                <h2># = {{ $upcomingCount }}</h2>
                <hr>
            </th>
        </tr>

        <tr>
            <td align = "center"><b>Scheduled Date</b></td>
            <td align = "center"><b>First Preferred Date</b></td>
            <td align = "center"><b>Second Preferred Date</b></td>
            <td align = "center"><b>Course Code</b></td>
            <td align = "center"><b>Exam Medium</b></td>
            <td align = "center"><b>Exam Type</b></td>
        </tr>

        @foreach($upcoming as $u)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showRequest')) }}
                    <td align = "center">
                        @if($u->scheduled_date == "1970-01-02 00:00:01")
                            {{ "Date not scheduled" }}
                        @else
                            {{ $u->scheduled_date }}
                        @endif
                    </td>
                    <td align = "center">{{ $u->preferred_date_1 }}</td>
                    <td align = "center">{{ $u->preferred_date_2 }}</td>
                    <td align = "center">{{ $u->course_code }}</td>
                    <td align = "center">{{ $u->exam_medium }}</td>
                    <td align = "center">{{ $u->exam_type }}</td>
                    {{ Form::hidden('rid', $u->rid) }}
                    {{ Form::hidden('cid', $u->cid) }}
                    {{ Form::hidden('sid', $u->sid) }}
                    {{ Form::hidden('iid', $u->iid) }}
                    <td align = "center">{{ Form::submit('View Details') }}</td>
                    <td align = "center">{{ $u->rid }}</td>
                {{ Form::close() }}
            </tr>
        @endforeach

        <tr>
            <th colspan = "6" align = "center">
                <h1>Exams Pending Center's Approval</h1>
                <h2># = {{ $pendingCenterCount }}</h2>
                <hr>
            </th>
        </tr>

        <tr>
            <td align = "center"><b>Scheduled Date</b></td>
            <td align = "center"><b>Preferred Date 1</b></td>
            <td align = "center"><b>Preferred Date 2</b></td>
            <td align = "center"><b>Course Code</b></td>
            <td align = "center"><b>Exam Medium</b></td>
            <td align = "center"><b>Exam Type</b></td>
        </tr>

        @foreach($pendingCenter as $pc)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showRequest')) }}
                    <td align = "center">
                        @if($pc->scheduled_date == "1970-01-02 00:00:01")
                            {{ "Date not scheduled" }}
                        @else
                            {{ $pc->scheduled_date }}
                        @endif
                    </td>
                    <td align = "center">{{ $pc->preferred_date_1 }}</td>
                    <td align = "center">{{ $pc->preferred_date_2 }}</td>
                    <td align = "center">{{ $pc->course_code }}</td>
                    <td align = "center">{{ $pc->exam_medium }}</td>
                    <td align = "center">{{ $pc->exam_type }}</td>
                    {{ Form::hidden('rid', $pc->rid) }}
                    {{ Form::hidden('cid', $pc->cid) }}
                    {{ Form::hidden('sid', $pc->sid) }}
                    {{ Form::hidden('iid', $pc->iid) }}
                    <td align = "center">{{ Form::submit('View Details') }}</td>
                    <td align = "center">{{ $pc->rid }}</td>
                {{ Form::close() }}
            </tr>
        @endforeach

        <tr>
            <th colspan = "6" align = "center">
                <h1>Exams Pending Student's Approval</h1>
                <h2># = {{ $pendingStudentCount }}</h2>
                <hr>
            </th>
        </tr>

        <tr>
            <td align = "center"><b>Scheduled Date</b></td>
            <td align = "center"><b>Preferred Date 1</b></td>
            <td align = "center"><b>Preferred Date 2</b></td>
            <td align = "center"><b>Course Code</b></td>
            <td align = "center"><b>Exam Medium</b></td>
            <td align = "center"><b>Exam Type</b></td>
        </tr>

        @foreach($pendingStudent as $ps)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showRequest')) }}
                    <td align = "center">
                        @if($ps->scheduled_date == "1970-01-02 00:00:01")
                            {{ "Date not scheduled" }}
                        @else
                            {{ $ps->scheduled_date }}
                        @endif
                    </td>
                    <td align = "center">{{ $ps->preferred_date_1 }}</td>
                    <td align = "center">{{ $ps->preferred_date_2 }}</td>
                    <td align = "center">{{ $ps->course_code }}</td>
                    <td align = "center">{{ $ps->exam_medium }}</td>
                    <td align = "center">{{ $ps->exam_type }}</td>
                    {{ Form::hidden('rid', $ps->rid) }}
                    {{ Form::hidden('cid', $ps->cid) }}
                    {{ Form::hidden('sid', $ps->sid) }}
                    {{ Form::hidden('iid', $ps->iid) }}
                    <td align = "center">{{ Form::submit('View Details') }}</td>
                    <td align = "center">{{ $ps->rid }}</td>
                {{ Form::close() }}
            </tr>
        @endforeach

        <tr>
            <th colspan = "6" align = "center">
                <h1>Exams Denied By Student</h1>
                <h2># = {{ $deniedStudentCount }}</h2>
                <hr>
            </th>
        </tr>

        <tr>
            <td align = "center"><b>Scheduled Date</b></td>
            <td align = "center"><b>Preferred Date 1</b></td>
            <td align = "center"><b>Preferred Date 2</b></td>
            <td align = "center"><b>Course Code</b></td>
            <td align = "center"><b>Exam Medium</b></td>
            <td align = "center"><b>Exam Type</b></td>
        </tr>

         @foreach($deniedStudent as $ds)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showRequest')) }}
                    <td align = "center">
                        @if($ds->scheduled_date == "1970-01-02 00:00:01")
                            {{ "Date not scheduled" }}
                        @else
                            {{ $ds->scheduled_date }}
                        @endif
                    </td>
                    <td align = "center">{{ $ds->preferred_date_1 }}</td>
                    <td align = "center">{{ $ds->preferred_date_2 }}</td>
                    <td align = "center">{{ $ds->course_code }}</td>
                    <td align = "center">{{ $ds->exam_medium }}</td>
                    <td align = "center">{{ $ds->exam_type }}</td>
                    {{ Form::hidden('rid', $ds->rid) }}
                    {{ Form::hidden('cid', $ds->cid) }}
                    {{ Form::hidden('sid', $ds->sid) }}
                    {{ Form::hidden('iid', $ds->iid) }}
                    <td align = "center">{{ Form::submit('View Details') }}</td>
                    <td align = "center">{{ $ds->rid }}</td>
                {{ Form::close() }}
            </tr>
        @endforeach

        <tr>
            <th colspan = "6" align = "center">
                <h1>Exams Denied By Center</h1>
                <h2># = {{ $deniedCenterCount }}</h2>
                <hr>
            </th>
        </tr>

        <tr>
            <td align = "center"><b>Scheduled Date</b></td>
            <td align = "center"><b>Preferred Date 1</b></td>
            <td align = "center"><b>Preferred Date 2</b></td>
            <td align = "center"><b>Course Code</b></td>
            <td align = "center"><b>Exam Medium</b></td>
            <td align = "center"><b>Exam Type</b></td>
        </tr>

        @foreach($deniedCenter as $dc)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showRequest')) }}
                    <td align = "center">
                        @if($dc->scheduled_date == "1970-01-02 00:00:01")
                            {{ "Date not scheduled" }}
                        @else
                            {{ $dc->scheduled_date }}
                        @endif
                    </td>
                    <td align = "center">{{ $dc->preferred_date_1 }}</td>
                    <td align = "center">{{ $dc->preferred_date_2 }}</td>
                    <td align = "center">{{ $dc->course_code }}</td>
                    <td align = "center">{{ $dc->exam_medium }}</td>
                    <td align = "center">{{ $dc->exam_type }}</td>
                    {{ Form::hidden('rid', $dc->rid) }}
                    {{ Form::hidden('cid', $dc->cid) }}
                    {{ Form::hidden('sid', $dc->sid) }}
                    {{ Form::hidden('iid', $dc->iid) }}
                <td align = "center">{{ Form::submit('View Details') }}</td>
                    <td align = "center">{{ $dc->rid }}</td>
                {{ Form::close() }}
            </tr>
        @endforeach

        <tr>
            <th colspan = "6" align = "center">
                <h1>Past Exams</h1>
                <h2># = {{ $pastCount }}</h2>
                <hr>
            </th>
        </tr>

        <tr>
            <td align = "center"><b>Scheduled Date</b></td>
            <td align = "center"><b>Preferred Date 1</b></td>
            <td align = "center"><b>Preferred Date 2</b></td>
            <td align = "center"><b>Course Code</b></td>
            <td align = "center"><b>Exam Medium</b></td>
            <td align = "center"><b>Exam Type</b></td>
        </tr>

        @foreach($past as $pa)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showRequest')) }}
                    <td align = "center">
                        @if($pa->scheduled_date == "1970-01-02 00:00:01")
                            {{ "Date not scheduled" }}
                        @else
                            {{ $pa->scheduled_date }}
                        @endif
                    </td>
                    <td align = "center">{{ $pa->preferred_date_1 }}</td>
                    <td align = "center">{{ $pa->preferred_date_2 }}</td>
                    <td align = "center">{{ $pa->course_code }}</td>
                    <td align = "center">{{ $pa->exam_medium }}</td>
                    <td align = "center">{{ $pa->exam_type }}</td>
                    {{ Form::hidden('rid', $pa->rid) }}
                    {{ Form::hidden('cid', $pa->cid) }}
                    {{ Form::hidden('sid', $pa->sid) }}
                    {{ Form::hidden('iid', $pa->iid) }}
                    <td align = "center">{{ Form::submit('View Details') }}</td>
                    <td align = "center">{{ $pa->rid }}</td>
                {{ Form::close() }}
            </tr>
        @endforeach

    </table>
@stop