@extends('la.layouts.app')

@section('contentheader_title') Add a Institution @endsection

@section('main-content')

    {{ Form::open(array('action' => 'LA\DashboardController@addI')) }}
    <label class="control-label" for="iname">Institution Name:</label>
    <input type="text"  id="iname" name="iname" required>*<br>
    <label class="control-label" for="email">Email:</label>
    <input type="text"  id="email" name="email"required>*<br>
    <label class="control-label" for="paid">Has Paid:</label>
    <input type="text"  id="paid" name="paid"><br>
    <label class="control-label" for="cname">Contact Name:</label>
    <input type="text"  id="cname" name="cname"required>*<br>
    <label class="control-label" for="cemail">Contact Email:</label>
    <input type="text"  id="cemail" name="cemail"required>*<br>
    <label class="control-label" for="cphone">Contact Phone:</label>
    <input type="text"  id="cphone" name="cphone"required>*<br>




    <button type="submit" class="btn btn-default">ADD</button>
    {{ Form::close() }}


@stop