@extends('layouts.dashboard')

@section('title', 'Profile')

@section('content')

    <!--This Profile code was initially writen by Brett Schaad, but later modified by Barrett for the Student view-->

    <!--Profile Edit Table -->

    <table>
    {{ Form::open(array('action' => 'StudentController@updateProfile')) }}
        <tr>
            <th colspan = "2">Unchangeable</th>
        </tr>
        <tr>
            <td>{{ Form::label('sid', 'Student ID:') }}</td>
            <td>{{ Form::number('sid', $student['sid']) }}</td>
        </tr>
        <tr>
            <th colspan = "2"><hr>General Info</th>
        </tr>
        <tr>
            <td> {!! Form::label('firstName','Student First Name:') !!} </td>
            <td> {!! Form::text('firstName', $student['firstName']) !!} </td>
        </tr>
        <tr>
            <td> {!! Form::label('lastName','Student Last Name:') !!} </td>
            <td> {!! Form::text('lastName', $student['lastName']) !!} </td>
        </tr>
        <tr>
            <td>{!! Form::label('institution','Institution Number:') !!}</td>
            <td>{!! Form::number('institution',$student['institution']) !!}</td>
        </tr>
        <tr>
            <td>{!! Form::label('sex','Gender:') !!}</td>
            <td>{!! Form::select('sex',['not_declared' => 'Not Declared', 'male'=>'Male', 'female'=>'Female', 'other'=>'Other'],$student['sex']) !!}</td>
        </tr>
        <tr>
            <td>{!! Form::label('age','Age:') !!}</td>
            <td>{!! Form::number('age',$student['age']) !!}</td>
        </tr>
        <tr>
            <td> {!! Form::label('phone','Phone Number:') !!} </td>
            <td> {!! Form::number('phone', $student['phone']) !!} </td>
        </tr>

        <!-- Currently don't have email value for students, according to dfd. Maybe username?
        <tr>
            <td> {!! //Form::label('studentEmail','Student Email Address:') //Student Email!!} </td>
            <td> {!! //Form::email('studentEmail', $student['']) !!} </td>
        </tr>
        -->

        <!--Submit-->

        <tr>
            <td></td>
            <td>{{ Form::submit('Submit') }}</td>
        </tr>

    {{ Form::close() }}
    </table>
@stop