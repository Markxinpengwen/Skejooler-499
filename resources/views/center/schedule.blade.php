{{--
    Author: Brett Schaad
--}}

@extends("cn.layouts.app")

@section('contentheader_title')Schedule @endsection

@section('main-content')

    <table width = "100%">

        <tr>
            <th colspan = "4"><h1>Upcoming Exams</h1></th>
            <td colspan = "2"><h2>{{ $upcomingCount }} exams</h2></td>
        </tr>

        <tr>
            <td align = "center"><b>Request ID</b></td>
            <td align = "center"><b>Scheduled Date</b></td>
            <td align = "center"><b>First Preferred Date</b></td>
            <td align = "center"><b>Second Preferred Date</b></td>
            <td align = "center"><b>Student</b></td>
            <td align = "center"><b>Institution</b></td>
            <td align = "center"><b>Course Code</b></td>
            <td align = "center"><b>Exam Medium</b></td>
            <td align = "center"><b>Exam Type</b></td>
        </tr>

        @foreach($upcoming as $u)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showRequest')) }}
                    <td align = "center">{{ $u->rid }}</td>
                    <td align = "center">
                        @if($u->scheduled_date == "1970-01-02 00:00:00" || $u->scheduled_date == null)
                            {{ "Date not scheduled" }}
                        @else
                            {{ $u->scheduled_date }}
                        @endif
                    </td>
                    <td align = "center">{{ $u->preferred_date_1 }}</td>
                    <td align = "center">{{ $u->preferred_date_2 }}</td>
                    <td align = "center">{{ $u->firstName }} {{ $u->lastName }}</td>
                    <td align = "center">{{ $u->institution_name }}</td>
                    <td align = "center">{{ $u->course_code }}</td>
                    <td align = "center">{{ $u->exam_medium }}</td>
                    <td align = "center">{{ $u->exam_type }}</td>
                    {{ Form::hidden('rid', $u->rid) }}
                    {{ Form::hidden('cid', $u->cid) }}
                    {{ Form::hidden('sid', $u->sid) }}
                    {{ Form::hidden('iid', $u->iid) }}
                    <td align = "center">{{ Form::submit('View Details') }}</td>
                {{ Form::close() }}
            </tr>
        @endforeach

        <tr>
            <th colspan = "4"><h1>Exams Pending Center's Approval</h1></th>
            <td colspan = "2"><h2>{{ $pendingCenterCount }} exams</h2></td>
        </tr>

        <tr>
            <td align = "center"><b>Request ID</b></td>
            <td align = "center"><b>Scheduled Date</b></td>
            <td align = "center"><b>First Preferred Date</b></td>
            <td align = "center"><b>Second Preferred Date</b></td>
            <td align = "center"><b>Student</b></td>
            <td align = "center"><b>Institution</b></td>
            <td align = "center"><b>Course Code</b></td>
            <td align = "center"><b>Exam Medium</b></td>
            <td align = "center"><b>Exam Type</b></td>
        </tr>

        @foreach($pendingCenter as $pc)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showRequest')) }}
                    <td align = "center">{{ $pc->rid }}</td>
                    <td align = "center">
                        @if($pc->scheduled_date == "1970-01-02 00:00:00" || $pc->scheduled_date == null)
                            {{ "Date not scheduled" }}
                        @else
                            {{ $pc->scheduled_date }}
                        @endif
                    </td>
                    <td align = "center">{{ $pc->preferred_date_1 }}</td>
                    <td align = "center">{{ $pc->preferred_date_2 }}</td>
                    <td align = "center">{{ $pc->firstName }} {{ $pc->lastName }}</td>
                    <td align = "center">{{ $pc->institution_name }}</td>
                    <td align = "center">{{ $pc->course_code }}</td>
                    <td align = "center">{{ $pc->exam_medium }}</td>
                    <td align = "center">{{ $pc->exam_type }}</td>
                    {{ Form::hidden('rid', $pc->rid) }}
                    {{ Form::hidden('cid', $pc->cid) }}
                    {{ Form::hidden('sid', $pc->sid) }}
                    {{ Form::hidden('iid', $pc->iid) }}
                    <td align = "center">{{ Form::submit('View Details') }}</td>
                {{ Form::close() }}
            </tr>
        @endforeach

        <tr>
            <th colspan = "4"><h1>Exams Pending Student's Approval</h1></th>
            <td colspan = "2"><h2>{{ $pendingStudentCount }} exams</h2></td>
        </tr>

        <tr>
            <td align = "center"><b>Request ID</b></td>
            <td align = "center"><b>Scheduled Date</b></td>
            <td align = "center"><b>First Preferred Date</b></td>
            <td align = "center"><b>Second Preferred Date</b></td>
            <td align = "center"><b>Student</b></td>
            <td align = "center"><b>Institution</b></td>
            <td align = "center"><b>Course Code</b></td>
            <td align = "center"><b>Exam Medium</b></td>
            <td align = "center"><b>Exam Type</b></td>
        </tr>

        @foreach($pendingStudent as $ps)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showRequest')) }}
                    <td align = "center">{{ $ps->rid }}</td>
                    <td align = "center">
                        @if($ps->scheduled_date == "1970-01-02 00:00:00" || $ps->scheduled_date == null)
                            {{ "Date not scheduled" }}
                        @else
                            {{ $ps->scheduled_date }}
                        @endif
                    </td>
                    <td align = "center">{{ $ps->preferred_date_1 }}</td>
                    <td align = "center">{{ $ps->preferred_date_2 }}</td>
                    <td align = "center">{{ $ps->firstName }} {{ $ps->lastName }}</td>
                    <td align = "center">{{ $ps->institution_name }}</td>
                    <td align = "center">{{ $ps->course_code }}</td>
                    <td align = "center">{{ $ps->exam_medium }}</td>
                    <td align = "center">{{ $ps->exam_type }}</td>
                    {{ Form::hidden('rid', $ps->rid) }}
                    {{ Form::hidden('cid', $ps->cid) }}
                    {{ Form::hidden('sid', $ps->sid) }}
                    {{ Form::hidden('iid', $ps->iid) }}
                    <td align = "center">{{ Form::submit('View Details') }}</td>
                {{ Form::close() }}
            </tr>
        @endforeach

        <tr>
            <th colspan = "4"><h1>Exams Denied By Student</h1></th>
            <td colspan = "2"><h2>{{ $deniedStudentCount }} exams</h2></td>
        </tr>

        <tr>
            <td align = "center"><b>Request ID</b></td>
            <td align = "center"><b>Scheduled Date</b></td>
            <td align = "center"><b>First Preferred Date</b></td>
            <td align = "center"><b>Second Preferred Date</b></td>
            <td align = "center"><b>Student</b></td>
            <td align = "center"><b>Institution</b></td>
            <td align = "center"><b>Course Code</b></td>
            <td align = "center"><b>Exam Medium</b></td>
            <td align = "center"><b>Exam Type</b></td>
        </tr>

         @foreach($deniedStudent as $ds)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showRequest')) }}
                    <td align = "center">{{ $ds->rid }}</td>
                    <td align = "center">
                        @if($ds->scheduled_date == "1970-01-02 00:00:00" || $ds->scheduled_date == null)
                            {{ "Date not scheduled" }}
                        @else
                            {{ $ds->scheduled_date }}
                        @endif
                    </td>
                    <td align = "center">{{ $ds->preferred_date_1 }}</td>
                    <td align = "center">{{ $ds->preferred_date_2 }}</td>
                    <td align = "center">{{ $ds->firstName }} {{ $ds->lastName }}</td>
                    <td align = "center">{{ $ds->institution_name }}</td>
                    <td align = "center">{{ $ds->course_code }}</td>
                    <td align = "center">{{ $ds->exam_medium }}</td>
                    <td align = "center">{{ $ds->exam_type }}</td>
                    {{ Form::hidden('rid', $ds->rid) }}
                    {{ Form::hidden('cid', $ds->cid) }}
                    {{ Form::hidden('sid', $ds->sid) }}
                    {{ Form::hidden('iid', $ds->iid) }}
                    <td align = "center">{{ Form::submit('View Details') }}</td>
                {{ Form::close() }}
            </tr>
        @endforeach

        <tr>
            <th colspan = "4"><h1>Exams Denied By Center</h1></th>
            <td colspan = "2"><h2>{{ $deniedCenterCount }} exams</h2></td>
        </tr>

        <tr>
            <td align = "center"><b>Request ID</b></td>
            <td align = "center"><b>Scheduled Date</b></td>
            <td align = "center"><b>First Preferred Date</b></td>
            <td align = "center"><b>Second Preferred Date</b></td>
            <td align = "center"><b>Student</b></td>
            <td align = "center"><b>Institution</b></td>
            <td align = "center"><b>Course Code</b></td>
            <td align = "center"><b>Exam Medium</b></td>
            <td align = "center"><b>Exam Type</b></td>
        </tr>

        @foreach($deniedCenter as $dc)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showRequest')) }}
                    <td align = "center">{{ $dc->rid }}</td>
                    <td align = "center">
                        @if($dc->scheduled_date == "1970-01-02 00:00:00" || $dc->scheduled_date == null)
                            {{ "Date not scheduled" }}
                        @else
                            {{ $dc->scheduled_date }}
                        @endif
                    </td>
                    <td align = "center">{{ $dc->preferred_date_1 }}</td>
                    <td align = "center">{{ $dc->preferred_date_2 }}</td>
                    <td align = "center">{{ $dc->firstName }} {{ $dc->lastName }}</td>
                    <td align = "center">{{ $dc->institution_name }}</td>
                    <td align = "center">{{ $dc->course_code }}</td>
                    <td align = "center">{{ $dc->exam_medium }}</td>
                    <td align = "center">{{ $dc->exam_type }}</td>
                    {{ Form::hidden('rid', $dc->rid) }}
                    {{ Form::hidden('cid', $dc->cid) }}
                    {{ Form::hidden('sid', $dc->sid) }}
                    {{ Form::hidden('iid', $dc->iid) }}
                <td align = "center">{{ Form::submit('View Details') }}</td>
                {{ Form::close() }}
            </tr>
        @endforeach

        <tr>
            <th colspan = "4"><h1>Past Exams</h1></th>
            <td colspan = "2"><h2>{{ $pastCount }} exams</h2></td>
        </tr>

        <tr>
            <td align = "center"><b>Request ID</b></td>
            <td align = "center"><b>Scheduled Date</b></td>
            <td align = "center"><b>First Preferred Date</b></td>
            <td align = "center"><b>Second Preferred Date</b></td>
            <td align = "center"><b>Student</b></td>
            <td align = "center"><b>Institution</b></td>
            <td align = "center"><b>Course Code</b></td>
            <td align = "center"><b>Exam Medium</b></td>
            <td align = "center"><b>Exam Type</b></td>
        </tr>

        @foreach($past as $pa)
            <tr>
                {{ Form::open(array('action' => 'CenterController@showRequest')) }}
                    <td align = "center">{{ $pa->rid }}</td>
                    <td align = "center">
                        @if($pa->scheduled_date == "1970-01-02 00:00:00" || $pa->scheduled_date == null)
                            {{ "Date not scheduled" }}
                        @else
                            {{ $pa->scheduled_date }}
                        @endif
                    </td>
                    <td align = "center">{{ $pa->preferred_date_1 }}</td>
                    <td align = "center">{{ $pa->preferred_date_2 }}</td>
                    <td align = "center">{{ $pa->firstName }} {{ $pa->lastName }}</td>
                    <td align = "center">{{ $pa->institution_name }}</td>
                    <td align = "center">{{ $pa->course_code }}</td>
                    <td align = "center">{{ $pa->exam_medium }}</td>
                    <td align = "center">{{ $pa->exam_type }}</td>
                    {{ Form::hidden('rid', $pa->rid) }}
                    {{ Form::hidden('cid', $pa->cid) }}
                    {{ Form::hidden('sid', $pa->sid) }}
                    {{ Form::hidden('iid', $pa->iid) }}
                    <td align = "center">{{ Form::submit('View Details') }}</td>
                {{ Form::close() }}
            </tr>
        @endforeach

    </table>
@stop