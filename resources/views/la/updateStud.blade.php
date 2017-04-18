@extends('la.layouts.app')

@section('contentheader_title') Update a Student @endsection

@section('main-content')

    {{ Form::open(array('action' => 'LA\DashboardController@updateS')) }}
    <h2>USER ID:       {{$id}}</h2>

    <label class="control-label" for="fanme">First Name:</label>
    <input type="text"  id="fname" name="fname" required>*<br>
    <label class="control-label" for="lname">Last Name:</label>
    <input type="text"  id="lname" name="lname" required>*<br>
    <label class="control-label" for="sex">Sex:</label>
    <input type="text"  id="sex" name="sex"required>*<br>
    <label class="control-label" for="age">Age:</label>
    <input type="text"  id="age" name="age"required>*<br>
    <label class="control-label" for="phone">Phone:</label>
    <input type="text"  id="phone" name="phone"required>*<br>

    {{ Form::hidden('id', $id) }}
    <button type="submit" class="btn btn-default">UPDATE</button>
    {{ Form::close() }}


@stop