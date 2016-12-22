@extends('layouts/dashboard')

@section('title', 'Profile')

@section('content')
    <table>
        {{ Form::open(array('url' => '/center/profileEdit')) }}

        {{--TODO - delete--}}
        <tr><th colspan = "2">Unchangeable</th></tr>

        {{--TODO - delete--}}
        <tr>
            <td>Center ID</td>
            <td>{{ "" }}</td>
        </tr>

        <tr><th colspan = "2"><hr>General Info</th></tr>

        <tr>
            <td>Name</td>
            <td>{{ "" }}</td>
        </tr>

        <tr>
            <td>Description</td>
            <td>{{ "" }}</td>
        </tr>

        <tr>
            <td>Online Exam Support</td>
            <td>{{ "" }}</td>
        </tr>

        <tr>
            <td>Exam Cost</td>
            <td>{{ "" }}</td>
        </tr>

        <tr><th colspan = "2"><hr>Contact</th></tr>

        <tr>
            <td>Phone Number</td>
            <td>{{ "" }}</td>
        </tr>

        <tr>
            <td>Email</td>
            <td>{{ "" }}</td>
        </tr>

        <tr>
            <td>Website</td>
            <td>{{ "" }}</td>
        </tr>

        <tr><th colspan = "2"><hr>Address</th></tr>

        <tr>
            <td>Street Address</td>
            <td>{{ "" }}</td>
        </tr>

        <tr>
            <td>City</td>
            <td>{{ "" }}</td>
        </tr>

        <tr>
            <td>Province</td>
            <td>{{ "" }}</td>
        </tr>

        <tr>
            <td>Country</td>
            <td>{{ "" }}</td>
        </tr>

        <tr>
            <td>Postal Code</td>
            <td>{{ "" }}</td>
        </tr>

        {{--TODO - delete--}}
        <tr>
            <td>Longitude</td>
            <td>{{ "" }}</td>
        </tr>

        {{--TODO - delete--}}
        <tr>
            <td>Latitude</td>
            <td>{{ "" }}</td>
        </tr>


        <tr>
            <td></td>
            <td>{{ Form::submit('Edit') }}</td>
        </tr>

        {{ Form::close() }}
    </table>
@stop