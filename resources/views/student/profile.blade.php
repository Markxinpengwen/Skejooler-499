@extends("st.layouts.app")

@section('title', 'Profile')

@section('main-content')

    <table>

        <tr><th colspan = "2"><h1>General Info</h1></th></tr>

        <tr>
            <th>First Name:</th>
            <td>{{ $student->firstName or "First name not found" }}</td>
        </tr>

        <tr>
            <th>Last Name:</th>
            <td>{{ $student->lastName or "Last name not found" }}</td>
        </tr>

        <tr>
            <th>Gender:</th>
            <td>{{ $student->sex or "Gender not found" }}</td>
        </tr>

        <tr>
            <th>Age:</th>
            <td>{{ $student->age or "Age not found" }}</td>
        </tr>

        <tr><th colspan = "2"><hr><h1>Contact</h1></th></tr>

        <tr>
            <th>Phone Number:</th>
            <td>{{ $student->phone or "Phone number not found" }}</td>
        </tr>

        <tr>
            <th>Login Email:</th>
            <td>{{ $login_email or "Email not found" }}</td>
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

        {{ Form::open(array('action' => 'StudentController@editProfile')) }}

        {{ Form::hidden('sid', $student->sid) }}

        <tr>
            <th></th>
            <td>{{ Form::submit('Edit') }}</td>
        </tr>

        {{ Form::close() }}
    </table>
@stop