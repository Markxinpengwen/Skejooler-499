@extends('st.layouts.app')

@section('title', 'Profile')

@section('main-content')

    <table>

        {{ Form::open(array('action' => 'StudentController@updateProfile')) }}

            <tr><th colspan = "2"><h1>General Info</h1></th></tr>
            <tr>
                <th> {{ Form::label('firstName', 'First Name:') }} </th>
                <td> {{ Form::text('firstName', $student->firstName) }} </td>
            </tr>

            <tr>
                <th> {{ Form::label('lastName', 'Last Name:') }} </th>
                <td> {{ Form::text('lastName', $student->lastName) }} </td>
            </tr>

            <tr>
                <th>{{ Form::label('sex', 'Gender:') }}</th>
                <td>{{ Form::select('sex',[
                    'not_declared' => 'Not Declared',
                    'male'=>'Male',
                    'female'=>'Female',
                    'transgender' => 'Transgender',
                    'other'=>'Other'
                ], $student->sex) }}
                </td>
            </tr>

            <tr>
                <th>{{ Form::label('age', 'Age:') }}</th>
                <td>{{ Form::number('age', $student->age) }}</td>
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
                <th>{{ Form::label('iid', 'Institution') }}</th>
                <td>
                    {{ Form::select('iid', $institution, $student->iid) }}
                </td>
            </tr>

            {{ Form::hidden('sid', $student->sid) }}

            <tr>
                <th></th>
                <td>{{ Form::submit('Submit') }}</td>
            </tr>

        {{ Form::close() }}

    </table>
@stop