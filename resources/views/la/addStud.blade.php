@extends('la.layouts.app')

@section('contentheader_title') Add a Student @endsection

@section('main-content')

    {{ Form::open(array('action' => 'LA\DashboardController@addS')) }}
    <label class="control-label" for="fanme">First Name:</label>
    <input type="text"  id="fname" name="fname" required>*<br>
    <label class="control-label" for="lname">Last Name:</label>
    <input type="text"  id="lname" name="lname" required>*<br>
    <label class="control-label" for="email">Email:</label>
    <input type="text"  id="eamil" name="email" required>*<br>
    <label class="control-label" for="sex">Sex:</label>
    <input type="text"  id="sex" name="sex"><br>
    <label class="control-label" for="age">Age:</label>
    <input type="text"  id="age" name="age"><br>
    <label class="control-label" for="phone">Phone:</label>
    <input type="text"  id="phone" name="phone"><br>



    <button type="submit" class="btn btn-default">ADD</button>
    {{ Form::close() }}


@stop