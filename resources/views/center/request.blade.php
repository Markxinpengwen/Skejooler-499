{{--
    Author: Brett Schaad
--}}

@extends("cn.layouts.app")

@section('contentheader_title')Requests @endsection

@section('main-content')

    <table class="table table-responsive table-hover" width="100%">

        <tr><th colspan = "2"><hr><h1>Student Info</h1></th></tr>

        <tr style=" font-size: 1.3em;">
            <th>Name:</th>
            <td>{{ $student->firstName }} {{ $student->lastName }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Gender:</th>
            <td>{{ str_replace("_", " ", $student->sex) }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Age:</th>
            <td>{{ $student->age }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Phone Number:</th>
            <td>{{ $student->phone }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Email:</th>
            <td>{{ $student_email }}</td>
        </tr>

        <tr><th colspan = "2"><hr><h1>Institution Info</h1></th></tr>

        <tr style="font-size: 1.3em;">
            <th>Name:</th>
            <td>{{ $institution->institution_name }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Description:</th>
            <td>{{ $institution->description }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Phone:</th>
            <td>{{ $institution->phone }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Country:</th>
            <td>{{ $institution->country }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Province:</th>
            <td>{{ $institution->province }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>City:</th>
            <td>{{ $institution->city }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Street Address:</th>
            <td>{{ $institution->street_address }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Postal Code:</th>
            <td>{{ $institution->postal_code }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Contact Name:</th>
            <td>{{ $institution->contact_name }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Contact Email:</th>
            <td>{{ $institution->contact_email }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Contact Phone:</th>
            <td>{{ $institution->contact_phone }}</td>
        </tr>

        <tr><th colspan = "2"><hr><h1>Exam Info</h1></th></tr>


        <tr style="font-size: 1.3em;">
            <th>Scheduled Date:</th>
            <td>
                @if($request->scheduled_date == "1970-01-02 00:00:00" || $request->scheduled_date == null)
                    {{ "Date not scheduled" }}
                @else
                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request->scheduled_date)->format('l\\, jS \\of F Y \\a\\t h:i A') }}
                @endif
            </td>
        </tr>


        <tr style="font-size: 1.3em;">
            <th>Preferred Date 1:</th>
            <td>{{ $request->preferred_date_1 }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Preferred Date 2:</th>
            <td>{{ $request->preferred_date_2 }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Course Code:</th>
            <td>{{ $request->course_code }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Additional Requirements:</th>
            <td>{{ $request->additional_requirements }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Exam Type:</th>
            <td>{{ $request->exam_type }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Exam Medium:</th>
            <td>{{ $request->exam_medium }}</td>
        </tr>


        <tr style="font-size: 1.3em;">
            <th>Computer Required:</th>
            <td>{{ $request->computer_required }}</td>
        </tr>

      <tr style="font-size: 1.3em;">
            <th>Student Notes:</th>
            <td>{{ $request->student_notes }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Center Notes:</th>
            <td>{{ $request->center_notes }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
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

        <tr style="font-size: 1.3em;">
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

        @if($editable)

            {{ Form::open(array('action' => 'CenterController@editRequest')) }}

            {{ Form::hidden('rid', $request->rid) }}
            {{ Form::hidden('sid', $student->sid) }}
            {{ Form::hidden('iid', $institution->iid) }}

            <tr>
                <th></th>
                <td>
                    <div class="btn-group btn-group-lg">
                        {{ Form::submit('Edit', $attributes = array('id'=>"editButton", 'class'=>"btn btn-primary")) }}
                    </div>
                </td>
            </tr>

            {{ Form::close() }}

        @endif

    </table>

@stop