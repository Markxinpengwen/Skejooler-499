@extends("st.layouts.app")

@section('title', 'Request')

@section('main-content')

    <table>

        <tr><th colspan = "2"><hr><h1>Center Info</h1></th></tr>

        <tr>
            <th>Name:</th>
            <td>{{ $center->name }}</td>
        </tr>

        <tr>
            <th>Description:</th>
            <td>{{ $center->description or "Description not found" }}</td>
        </tr>

        <tr>
            <th>Online Exam Support:</th>
            <td>
                @if($center->canSupportOnlineExam == 1)
                    Yes
                @elseif($center->canSupportOnlineExam == 0)
                    No
                @else
                    Online support not found
                @endif</td>
        </tr>

        <tr>
            <th>Exam Cost:</th>
            <td>{{'$'}}{{ $center->cost or "Exam cost not found" }}</td>
        </tr>

        <tr>
            <th>Phone Number:</th>
            <td>{{ $center->phone or "Phone number not found" }}</td>
        </tr>

        <tr>
            <th>Center Email:</th>
            <td>{{ $center_email }}</td>
        </tr>

        <tr>
            <th>Street Address:</th>
            <td>{{ $center->street_address or "Street address not found" }}</td>
        </tr>

        <tr>
            <th>City:</th>
            <td>{{ $center->city or "City not found" }}</td>
        </tr>

        <tr>
            <th>Province:</th>
            <td>{{ str_replace("_", " ", $center->province) }}</td>
        </tr>

        <tr>
            <th>Country:</th>
            <td>{{ $center->country or "Country not found" }}</td>
        </tr>

        <tr>
            <th>Postal Code:</th>
            <td>{{ $center->postal_code }}</td>
        </tr>

        {{--TODO - delete--}}
        <tr>
            <th>Longitude:</th>
            <td>{{ $center->longitude }}</td>
        </tr>

        {{--TODO - delete--}}
        <tr>
            <th>Latitude:</th>
            <td>{{ $center->latitude }}</td>
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

        <tr><th colspan = "2"><hr><h1>Exam Info</h1></th></tr>

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
            <th>Center Notes:</th>
            <td>{{ $request->center_notes }}</td>
        </tr>

        <tr>
            <th>Student Notes:</th>
            <td>{{ $request->student_notes }}</td>
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

        @if($editable)

            {{ Form::open(array('action' => 'StudentController@editRequest')) }}

            {{ Form::hidden('rid', $request->rid) }}
            {{ Form::hidden('cid', $center->cid) }}
            {{ Form::hidden('iid', $institution->iid) }}

            <tr>
                <td></td>
                <td>{{ Form::submit('Edit') }}</td>
            </tr>

            {{ Form::close() }}

        @endif

    </table>

@stop