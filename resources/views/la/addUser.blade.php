@extends('la.layouts.app')

@section('contentheader_title') Add a User @endsection

@section('main-content')

    {{ Form::open(array('action' => 'LA\DashboardController@addU')) }}
    <label class="control-label" for="email">Email:</label>
    <input type="text"  id="eamil" name="email" required><br>
    <label class="control-label" for="name">Name:</label>
    <input type="text"  id="name" name="name" required><br>
    <label class="control-label" for="type">Type:</label>
    <select id ="type" name = "type">
        <option value="student">Student</option>
        <option value="center">Center</option>
    </select><br>


    <button type="submit" class="btn btn-default">ADD</button>
    {{ Form::close() }}


@stop