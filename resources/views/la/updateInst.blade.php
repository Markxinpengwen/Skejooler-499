@extends('la.layouts.app')

@section('contentheader_title') Update a Institution @endsection

@section('main-content')

    {{ Form::open(array('action' => 'LA\DashboardController@updateC')) }}
    <h2>USER ID:       {{$id}}</h2>

    <label class="control-label" for="canme">Center Name:</label>
    <input type="text"  id="cname" name="cname" required>*<br>
    <label class="control-label" for="email">Email:</label>
    <input type="text"  id="eamil" name="email" required>*<br>
    <label class="control-label" for="phone">Phone:</label>
    <input type="text"  id="phone" name="phone"><br>
    <label class="control-label" for="cost">Cost:</label>
    <input type="text"  id="cost" name="cost"><br>

    {{ Form::hidden('id', $id) }}
    <button type="submit" class="btn btn-default">UPDATE</button>
    {{ Form::close() }}


@stop