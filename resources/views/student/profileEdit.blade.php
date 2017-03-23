@extends('layouts.dashboard')

@section('title', 'Profile')

@section('content')

    <!--This Profile code was initially writen by Brett Schaad, but later modified by Barrett for the Student view-->

    <!--Profile Edit Table -->

    <table>

        {{ Form::open(array('action' => 'StudentController@updateProfile')) }}

            <tr><th colspan = "2"><h1>General Info</h1></th></tr>

            <tr>
                <th> {{ Form::label('firstName', 'Student First Name:') }} </th>
                <td> {{ Form::text('firstName', $student->firstName) }} </td>
            </tr>

            <tr>
                <th> {{ Form::label('lastName', 'Student Last Name:') }} </th>
                <td> {{ Form::text('lastName', $student->lastName) }} </td>
            </tr>

            <tr>
                <th>{{ Form::label('sex', 'Gender:') }}</th>
                <td>{{ Form::select('sex',[
                    'not_declared' => 'Not Declared',
                    'male'=>'Male', 'female'=>'Female',
                    'other'=>'Other'
                ], $student->sex) }}
                </td>
            </tr>

            <tr>
                <th>{{ Form::label('age', 'Age:') }}</th>
                <td>{{ Form::number('age', $student->age) }}</td>
            </tr>

            <tr>
                <th>{{ Form::label('institution', 'Institution Number:') }}</th>
                <td>{{ Form::number('institution', $student->institution) }}</td>
            </tr>

            <tr><th colspan = "2"><hr><h1>Contact</h1></th></tr>

            <tr>
                <th> {{ Form::label('phone', 'Phone Number:') }} </th>
                <td> {{ Form::number('phone', $student->phone) }} </td>
            </tr>

            <tr>
                <th>Login Email:</th>
                <td>{{ $login_email or "Email not found" }}</td>
            </tr>

            <tr>
                <th></th>
                <td>{{ Form::submit('Submit') }}</td>
            </tr>

        {{ Form::close() }}

    </table>
@stop