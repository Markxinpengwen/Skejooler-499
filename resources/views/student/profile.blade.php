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

        {{-- TODO - display institution info if there is any--}}
        <tr>
            <th>Institution Number:</th>
            <td>{{ $student->iid or "Institution Number not found" }}</td>
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

        {{ Form::open(array('action' => 'StudentController@editProfile')) }}

        {{ Form::hidden('sid', $student->sid) }}

        <tr>
            <th></th>
            <td>{{ Form::submit('Edit') }}</td>
        </tr>

        {{ Form::close() }}
    </table>
@stop