{{--
    Author: Brett Schaad, Barrett Sharpe
--}}

@extends("st.layouts.app")

@section('contentheader_title')Schedule @endsection

@section('main-content')


    <table class="table table-responsive table-hover table-striped" width="100%">

        <tr>
            <th colspan = "5"><h1>Upcoming Exams</h1></th>
            <td colspan = "5"><h2>{{ $upcomingCount }} exams</h2></td>
        </tr>

        <tr>
            <td align = "center" style="text-decoration: underline;"><b>Request ID</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Scheduled Date</b></td>
            <td align = "center" style="text-decoration: underline;"><b>First Preferred Date</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Second Preferred Date</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Center</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Institution</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Course Code</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Exam Medium</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Exam Type</b></td>
            <td align = "center" style="text-decoration: underline;"></td>
        </tr>

        @foreach($upcoming as $u)
            <tr id="request{{ $u->rid }}">
                {{ Form::open(array('action' => 'StudentController@showRequest', 'name' => "upcomingForm")) }}
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
                    <td align = "center">{{ $u->center_name }}</td>
                    <td align = "center">{{ $u->institution_name }}</td>
                    <td align = "center">{{ $u->course_code }}</td>
                    <td align = "center">{{ $u->exam_medium }}</td>
                    <td align = "center">{{ $u->exam_type }}</td>
                    {{ Form::hidden('rid', $u->rid) }}
                    {{ Form::hidden('sid', $u->sid) }}
                    {{ Form::hidden('cid', $u->cid) }}
                    {{ Form::hidden('iid', $u->iid) }}
                    <td align="center">
                        <div class="btn-group btn-group-xs">
                            {{ Form::submit('View Details', $attributes = array('class'=>"btn btn-primary")) }}
                        </div>
                    </td>
                {{ Form::close() }}
            </tr>
        @endforeach

        <tr>
            <th colspan = "5"><h1>Exams Pending Student's Approval</h1></th>
            <td colspan = "5"><h2>{{ $pendingStudentCount }} exams</h2></td>
        </tr>

        <tr>
            <td align = "center" style="text-decoration: underline;"><b>Request ID</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Scheduled Date</b></td>
            <td align = "center" style="text-decoration: underline;"><b>First Preferred Date</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Second Preferred Date</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Center</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Institution</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Course Code</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Exam Medium</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Exam Type</b></td>
            <td align = "center" style="text-decoration: underline;"></td>
        </tr>

        @foreach($pendingStudent as $ps)
            <tr>
                {{ Form::open(array('action' => 'StudentController@showRequest')) }}
                    <td align = "center">{{ $ps->rid }}</td>
                    <td align = "center">
                        @if($ps->scheduled_date == "1970-01-02 00:00:00")
                            {{ "Date not scheduled" }}
                        @else
                            {{ $ps->scheduled_date }}
                        @endif
                    </td>
                    <td align = "center">{{ $ps->preferred_date_1 }}</td>
                    <td align = "center">{{ $ps->preferred_date_2 }}</td>
                    <td align = "center">{{ $ps->center_name }}</td>
                    <td align = "center">{{ $ps->institution_name }}</td>
                    <td align = "center">{{ $ps->course_code }}</td>
                    <td align = "center">{{ $ps->exam_medium }}</td>
                    <td align = "center">{{ $ps->exam_type }}</td>
                    {{ Form::hidden('rid', $ps->rid) }}
                    {{ Form::hidden('sid', $ps->sid) }}
                    {{ Form::hidden('cid', $ps->cid) }}
                    {{ Form::hidden('iid', $ps->iid) }}
                    <td align="center">
                        <div class="btn-group btn-group-xs">
                            {{ Form::submit('View Details', $attributes = array('class'=>"btn btn-primary")) }}
                        </div>
                    </td>
                {{ Form::close() }}
            </tr>
        @endforeach

        <tr>
            <th colspan = "5"><h1>Exams Pending Center's Approval</h1></th>
            <td colspan = "5"><h2>{{ $pendingCenterCount }} exams</h2></td>
        </tr>

        <tr>
            <td align = "center" style="text-decoration: underline;"><b>Request ID</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Scheduled Date</b></td>
            <td align = "center" style="text-decoration: underline;"><b>First Preferred Date</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Second Preferred Date</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Center</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Institution</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Course Code</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Exam Medium</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Exam Type</b></td>
            <td align = "center" style="text-decoration: underline;"></td>
        </tr>

        @foreach($pendingCenter as $pc)
            <tr>
                {{ Form::open(array('action' => 'StudentController@showRequest')) }}
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
                    <td align = "center">{{ $pc->center_name }}</td>
                    <td align = "center">{{ $pc->institution_name }}</td>
                    <td align = "center">{{ $pc->course_code }}</td>
                    <td align = "center">{{ $pc->exam_medium }}</td>
                    <td align = "center">{{ $pc->exam_type }}</td>
                    {{ Form::hidden('rid', $pc->rid) }}
                    {{ Form::hidden('sid', $pc->sid) }}
                    {{ Form::hidden('cid', $pc->cid) }}
                    {{ Form::hidden('iid', $pc->iid) }}
                    <td align="center">
                        <div class="btn-group btn-group-xs">
                            {{ Form::submit('View Details', $attributes = array('class'=>"btn btn-primary")) }}
                        </div>
                    </td>
                {{ Form::close() }}
            </tr>
        @endforeach

        <tr>
            <th colspan = "5"><h1>Exams Denied By Center</h1></th>
            <td colspan = "5"><h2>{{ $deniedCenterCount }} exams</h2></td>
        </tr>

        <tr>
            <td align = "center" style="text-decoration: underline;"><b>Request ID</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Scheduled Date</b></td>
            <td align = "center" style="text-decoration: underline;"><b>First Preferred Date</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Second Preferred Date</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Center</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Institution</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Course Code</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Exam Medium</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Exam Type</b></td>
            <td align = "center" style="text-decoration: underline;"></td>
        </tr>

        @foreach($deniedCenter as $dc)
            <tr>
                {{ Form::open(array('action' => 'StudentController@showRequest')) }}
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
                    <td align = "center">{{ $dc->center_name }}</td>
                    <td align = "center">{{ $dc->institution_name }}</td>
                    <td align = "center">{{ $dc->course_code }}</td>
                    <td align = "center">{{ $dc->exam_medium }}</td>
                    <td align = "center">{{ $dc->exam_type }}</td>
                    {{ Form::hidden('rid', $dc->rid) }}
                    {{ Form::hidden('sid', $dc->sid) }}
                    {{ Form::hidden('cid', $dc->cid) }}
                    {{ Form::hidden('iid', $dc->iid) }}
                    <td align="center">
                        <div class="btn-group btn-group-xs">
                            {{ Form::submit('View Details', $attributes = array('class'=>"btn btn-primary")) }}
                        </div>
                    </td>
                {{ Form::close() }}
            </tr>
        @endforeach

        <tr>
            <th colspan = "5"><h1>Exams Denied By Student</h1></th>
            <td colspan = "5"><h2>{{ $deniedStudentCount }} exams</h2></td>
        </tr>

        <tr>
            <td align = "center" style="text-decoration: underline;"><b>Request ID</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Scheduled Date</b></td>
            <td align = "center" style="text-decoration: underline;"><b>First Preferred Date</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Second Preferred Date</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Center</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Institution</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Course Code</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Exam Medium</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Exam Type</b></td>
            <td align = "center" style="text-decoration: underline;"></td>
        </tr>

        @foreach($deniedStudent as $ds)
            <tr>
                {{ Form::open(array('action' => 'StudentController@showRequest')) }}
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
                    <td align = "center">{{ $ds->center_name }}</td>
                    <td align = "center">{{ $ds->institution_name }}</td>
                    <td align = "center">{{ $ds->course_code }}</td>
                    <td align = "center">{{ $ds->exam_medium }}</td>
                    <td align = "center">{{ $ds->exam_type }}</td>
                    {{ Form::hidden('rid', $ds->rid) }}
                    {{ Form::hidden('sid', $ds->sid) }}
                    {{ Form::hidden('cid', $ds->cid) }}
                    {{ Form::hidden('iid', $ds->iid) }}
                    <td align="center">
                        <div class="btn-group btn-group-xs">
                            {{ Form::submit('View Details', $attributes = array('class'=>"btn btn-primary")) }}
                        </div>
                    </td>
                {{ Form::close() }}
            </tr>
        @endforeach

        <tr>
            <th colspan = "5"><h1>Past Exams</h1></th>
            <td colspan = "5"><h2>{{ $pastCount }} exams</h2></td>
        </tr>

        <tr>
            <td align = "center" style="text-decoration: underline;"><b>Request ID</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Scheduled Date</b></td>
            <td align = "center" style="text-decoration: underline;"><b>First Preferred Date</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Second Preferred Date</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Center</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Institution</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Course Code</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Exam Medium</b></td>
            <td align = "center" style="text-decoration: underline;"><b>Exam Type</b></td>
            <td align = "center" style="text-decoration: underline;"></td>
        </tr>

        @foreach($past as $pa)
            <tr>
                {{ Form::open(array('action' => 'StudentController@showRequest')) }}
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
                    <td align = "center">{{ $pa->center_name }}</td>
                    <td align = "center">{{ $pa->institution_name }}</td>
                    <td align = "center">{{ $pa->course_code }}</td>
                    <td align = "center">{{ $pa->exam_medium }}</td>
                    <td align = "center">{{ $pa->exam_type }}</td>
                    {{ Form::hidden('rid', $pa->rid) }}
                    {{ Form::hidden('sid', $pa->sid) }}
                    {{ Form::hidden('cid', $pa->cid) }}
                    {{ Form::hidden('iid', $pa->iid) }}
                    <td align="center">
                        <div class="btn-group btn-group-xs">
                            {{ Form::submit('View Details', $attributes = array('class'=>"btn btn-primary")) }}
                        </div>
                    </td>
                {{ Form::close() }}
            </tr>
        @endforeach

    </table>

@stop