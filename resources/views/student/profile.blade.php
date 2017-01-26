@extends('layouts.dashboard')

@section('title', 'Profile')

@section('content')
    <!--This Profile code was initially writen by Brett Schaad, but later modified by Barrett for the Student view-->

    <!-- Profile Table-->

    <table>
        {{ Form::open(array('action' => 'StudentController@editProfile')) }}

        {{--TODO - delete--}}
        <tr><th colspan = "2">Unchangeable</th></tr>

        {{--TODO - delete--}}
        <tr>
            <td>Student ID:</td>
            <td>{{ $student['sid'] or "Student ID not found" }}</td>
        </tr>
        <tr>
            <th colspan = "2"><hr>Student Information</th>
        </tr>
        <tr>
            <td>First Name:</td>
            <td>{{ $student['firstName'] or "First name not found" }}</td>
        </tr>
        <tr>
            <td>Last Name:</td>
            <td>{{ $student['lastName'] or "Last name not found" }}</td>
        </tr>
        <tr>
            <td>Institution Number:</td>
            <td>{{ $student['institution'] or "Institution Number not found" }}</td>
        </tr>
        <tr>
            <td>Gender:</td>
            <td>{{ $student['sex'] or "Gender not found" }}</td>
        </tr>
        <tr>
            <td>Age:</td>
            <td>{{ $student['age'] or "Age not found" }}</td>
        </tr>
        <tr>
            <th colspan = "2"><hr>Contact Information</th>
        </tr>
        <tr>
            <td>Phone Number:</td>
            <td>{{ $student['phone'] or "Phone number not found" }}</td>
        </tr>

        <!-- Currently don't have email value for students, according to dfd. Maybe username?
        <tr>
            <td>Email:</td>
            <td>{{ $student['email'] or "Email not found" }}</td>
        </tr>
        -->

        <!--Submit-->

        <tr>
            <td></td>
            <td>{{ Form::submit('Edit') }}</td>
        </tr>

        {{ Form::close() }}
    </table>
@stop