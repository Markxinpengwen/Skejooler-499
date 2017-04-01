@extends("cn.layouts.app")

@section('title', 'Request')

@section('main-content')

    <table>

        <tr><th colspan = "2"><hr><h1>Student Info</h1></th></tr>

        <tr>
            <th>Name:</th>
            <td>{{ $student->firstName }} {{ $student->lastName }}</td>
        </tr>

        <tr>
            <th>Gender:</th>
            <td>{{ str_replace("_", " ", $student->sex) }}</td>
        </tr>

        <tr>
            <th>Age:</th>
            <td>{{ $student->age }}</td>
        </tr>

        <tr>
            <th>Phone Number:</th>
            <td>{{ $student->phone }}</td>
        </tr>

        <tr>
            <th>Email:</th>
            <td>{{ $student_email }}</td>
        </tr>

        <tr><th colspan = "2"><hr><h1>Institution Info</h1></th></tr>

        <tr>
            <th>Name:</th>
            <td>{{ $institution->institution_name }}</td>
        </tr>

        <tr>
            <th>Description:</th>
            <td>{{ $institution->description }}</td>
        </tr>

        <tr>
            <th>Phone:</th>
            <td>{{ $institution->phone }}</td>
        </tr>

        <tr>
            <th>Country:</th>
            <td>{{ $institution->country }}</td>
        </tr>

        <tr>
            <th>Province:</th>
            <td>{{ $institution->province }}</td>
        </tr>

        <tr>
            <th>City:</th>
            <td>{{ $institution->city }}</td>
        </tr>

        <tr>
            <th>Street Address:</th>
            <td>{{ $institution->street_address }}</td>
        </tr>

        <tr>
            <th>Postal Code:</th>
            <td>{{ $institution->postal_code }}</td>
        </tr>

        <tr>
            <th>Contact Name:</th>
            <td>{{ $institution->contact_name }}</td>
        </tr>

        <tr>
            <th>Contact Email:</th>
            <td>{{ $institution->contact_email }}</td>
        </tr>

        <tr>
            <th>Contact Phone:</th>
            <td>{{ $institution->contact_phone }}</td>
        </tr>

        <tr><th colspan = "2"><hr><h1>Exam Info</h1></th></tr>

        <tr>
        <tr>
            <th>Scheduled Date:</th>
            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request->scheduled_date)->format('l\\, jS \\of F Y \\a\\t h:i A') }}</td>
        </tr>

        <tr>
            <th>First Preferred Date:</th>
            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request->preferred_date_1)->format('l\\, jS \\of F Y \\a\\t h:i A') }}</td>
        </tr>

        <tr>
            <th>Second Preferred Date:</th>
            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request->preferred_date_2)->format('l\\, jS \\of F Y \\a\\t h:i A') }}</td>
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
            <th>Computer Required:</th>
            <td>{{ $request->computer_required }}</td>
        </tr>

        <tr>
            <th>Student Notes:</th>
            <td>{{ $request->student_notes }}</td>
        </tr>

        <tr>
            <th>Center Notes:</th>
            <td>{{ $request->center_notes }}</td>
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

        @if($editable)

            {{ Form::open(array('action' => 'CenterController@editRequest')) }}

            {{ Form::hidden('rid', $request->rid) }}
            {{ Form::hidden('sid', $student->sid) }}
            {{ Form::hidden('iid', $institution->iid) }}

            <tr>
                <td></td>
                <td>{{ Form::submit('Edit') }}</td>
            </tr>

            {{ Form::close() }}

        @endif

    </table>

@stop