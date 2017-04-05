@extends('la.layouts.app')

@section('contentheader_title') Add a Cen @endsection

@section('main-content')

    {{ Form::open(array('action' => 'LA\DashboardController@addC')) }}
    <label class="control-label" for="canme">Center Name:</label>
    <input type="text"  id="cname" name="cname" required>*<br>
    <label class="control-label" for="email">Email:</label>
    <input type="text"  id="eamil" name="email" required>*<br>
    <label class="control-label" for="phone">Phone:</label>
    <input type="text"  id="phone" name="phone"><br>
    <label class="control-label" for="cost">Cost:</label>
    <input type="text"  id="cost" name="cost"><br>




    <button type="submit" class="btn btn-default">ADD</button>
    {{ Form::close() }}


@stop