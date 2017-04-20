@extends('st.layouts.app')

@section('title', 'Profile')

@section('main-content')

    <table class="table table-responsive" width="100%">

        {{ Form::open(array('action' => 'StudentController@updateProfile')) }}

            <tr><th colspan = "2"><h1>General Info</h1></th></tr>
            <tr style="font-size: 1.3em;">
                <td> {{ Form::label('firstName', 'First Name:') }} </td>
                <td> {{ Form::text('firstName', $student->firstName) }} </td>
            </tr>

            <tr style="font-size: 1.3em;">
                <th> {{ Form::label('lastName', 'Last Name:') }} </th>
                <td> {{ Form::text('lastName', $student->lastName) }} </td>
            </tr>

            <tr style="font-size: 1.3em;">
                <th>{{ Form::label('sex', 'Gender:') }}</th>
                <td>{{ Form::select('sex',[
                    'not_declared' => 'Not Declared',
                    'male'=>'Male', 'female'=>'Female',
                    'other'=>'Other'
                ], $student->sex) }}
                </td>
            </tr>

            <tr style="font-size: 1.3em;">
                <th>{{ Form::label('age', 'Age:') }}</th>
                <td>{{ Form::number('age', $student->age) }}</td>
            </tr>

            <tr><th colspan = "2"><hr><h1>Contact</h1></th></tr>

            <tr style="font-size: 1.3em;">
                <th> {{ Form::label('phone', 'Phone Number:') }} </th>
                <td> {{ Form::number('phone', $student->phone) }} </td>
            </tr>

            <tr style="font-size: 1.3em;">
                <th>Login Email:</th>
                <td>{{ $login_email or "Email not found" }}</td>
            </tr>

            <tr style="font-size: 1.3em;">
                <th>{{ Form::label('iid', 'Institution:') }}</th>
                <td>
                    {{ Form::select('iid', $institution, $student->iid) }}
                </td>
            </tr>

            {{ Form::hidden('sid', $student->sid) }}

            <tr>
                <th></th>
                <td>
                    <div class="btn-group btn-group-lg">
                        {{ Form::submit('Submit', $attributes = array('id'=>"submitButton", 'class'=>"btn btn-primary")) }}
                    </div>
                </td>
            </tr>

        {{ Form::close() }}

    </table>
@stop