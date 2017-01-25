@extends('layouts.dashboard')

@section('title', 'Profile')

@section('content')
    <table>
        {{ Form::open(array('action' => 'CenterController@editProfile')) }}

        {{--TODO - delete--}}
        <tr><th colspan = "2">Unchangeable</th></tr>

        {{--TODO - delete--}}
        <tr>
            <td>Center ID:</td>
            <td>{{ $center->cid or "Center ID not found" }}</td>
        </tr>

        <tr><th colspan = "2"><hr>General Info</th></tr>

        <tr>
            <td>Name:</td>
            <td>{{ $center->name or "Name not found" }}</td>
        </tr>

        <tr>
            <td>Description:</td>
            <td>{{ $center->description or "Description not found" }}</td>
        </tr>

        <tr>
            <td>Online Exam Support:</td>
            <td>{{ $center->canSupportOnlineExam or "Online support not found" }}</td>
        </tr>

        <tr>
            <td>Exam Cost:</td>
            <td>{{ $center->cost or "Exam cost not found" }}</td>
        </tr>

        <tr><th colspan = "2"><hr>Contact</th></tr>

        <tr>
            <td>Phone Number:</td>
            <td>{{ $center->phone or "Phone number not found" }}</td>
        </tr>

        <tr>
            <td>Email:</td>
            <td>{{ $center->email or "Email not found" }}</td>
        </tr>

        <tr>
            <td>Website:</td>
            <td>{{ $center->website or "Website not found" }}</td>
        </tr>

        <tr><th colspan = "2"><hr>Address</th></tr>

        <tr>
            <td>Street Address:</td>
            <td>{{ $center->street_name or "Street address not found" }}</td>
        </tr>

        <tr>
            <td>City:</td>
            <td>{{ $center->city or "City not found" }}</td>
        </tr>

        <tr>
            <td>Province:</td>
            <td>{{ $center->province or "Province not found" }}</td>
        </tr>

        <tr>
            <td>Country:</td>
            <td>{{ $center->country or "Country not found" }}</td>
        </tr>

        <tr>
            <td>Postal Code:</td>
            <td>{{ $center->postal_code }}</td>
        </tr>

        {{--TODO - delete--}}
        <tr>
            <td>Longitude:</td>
            <td>{{ $center->longitude }}</td>
        </tr>

        {{--TODO - delete--}}
        <tr>
            <td>Latitude:</td>
            <td>{{ $center->latitude }}</td>
        </tr>

        <tr>
            <td></td>
            <td>{{ Form::submit('Edit') }}</td>
        </tr>

        {{ Form::close() }}
    </table>
@stop