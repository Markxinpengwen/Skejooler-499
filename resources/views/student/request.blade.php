{{--
    Author: Brett Schaad
--}}

@extends("st.layouts.app")

@section('contentheader_title')Requests @endsection

@section('main-content')

    <table class="table table-responsive table-hover" width="100%">

        <tr><th colspan = "2"><hr><h1>Center Info</h1></th></tr>

        <tr style="font-size: 1.3em;">
            <th>Name:</th>
            <td>{{ $center->center_name }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Description:</th>
            <td>{{ $center->description or "Description not found" }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
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

        <tr style="font-size: 1.3em;">
            <th>Exam Cost:</th>
            <td>{{'$'}}{{ $center->cost or "Exam cost not found" }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Phone Number:</th>
            <td>{{ $center->phone or "Phone number not found" }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Center Email:</th>
            <td>{{ $center_email }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Street Address:</th>
            <td>{{ $center->street_address or "Street address not found" }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>City:</th>
            <td>{{ $center->city or "City not found" }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Province:</th>
            <td>{{ str_replace("_", " ", $center->province) }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Country:</th>
            <td>{{ $center->country or "Country not found" }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Postal Code:</th>
            <td>{{ $center->postal_code }}</td>
        </tr>


        {{--TODO - delete--}}
        <tr style="font-size: 1.3em;">
            <th>Longitude:</th>
            <td>{{ $center->longitude }}</td>
        </tr>

        {{--TODO - delete--}}
        <tr style="font-size: 1.3em;">
            <th>Latitude:</th>
            <td>{{ $center->latitude }}</td>
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

        <tr>

        <tr style="font-size: 1.3em;">
            <th>Center Notes:</th>
            <td>{{ $request->center_notes }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Student Notes:</th>
            <td>{{ $request->student_notes }}</td>
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

        @if($editable)

            {{ Form::open(array('action' => 'StudentController@editRequest')) }}

            {{ Form::hidden('rid', $request->rid) }}
            {{ Form::hidden('cid', $center->cid) }}
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