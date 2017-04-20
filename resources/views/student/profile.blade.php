@extends("st.layouts.app")

@section('title', 'Profile')

@section('main-content')

    {{--<script type="javascript">--}}
    {{--//Method to assign a DOM click event to submit the given form.--}}
    {{--var assignSubmitAction = function(formName){--}}
    {{--document.getElementById("").classList.add('class');--}}
    {{--};--}}

    {{--//Once window loads, begin--}}
    {{--window.onload = function(){--}}
    {{--assignSubmitAction("upcomingForm");--}}
    {{--console.log("Set submit event");--}}
    {{--};--}}
    {{--</script>--}}

    <table class="table table-responsive table-hover" width="100%">

        <tr><th colspan = "2"><h1>General Info</h1></th></tr>

        <tr style="font-size: 1.3em;">
            <th>First Name:</th>
            <td>{{ $student->firstName or "First name not found" }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Last Name:</th>
            <td>{{ $student->lastName or "Last name not found" }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Gender:</th>
            <td>{{ $student->sex or "Gender not found" }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Age:</th>
            <td>{{ $student->age or "Age not found" }}</td>
        </tr>

        <tr style="font-size: 1.3em;"><th colspan = "2"><h1>Contact</h1></th></tr>

        <tr style="font-size: 1.3em;">
            <th>Phone Number:</th>
            <td>{{ $student->phone or "Phone number not found" }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Login Email:</th>
            <td>{{ $login_email or "Email not found" }}</td>
        </tr>

        <tr><th colspan = "2"><h1>Institution Info</h1></th></tr>

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

        {{ Form::open(array('action' => 'StudentController@editProfile')) }}

        {{ Form::hidden('sid', $student->sid) }}

        <tr>
            <th></th>
            <td>
                <div class="btn-group btn-group-lg">
                    {{ Form::submit('Edit', $attributes = array('id'=>"editButton", 'class'=>"btn btn-primary")) }}
                </div>
            </td>
        </tr>

        {{ Form::close() }}
    </table>
@stop