{{--
    Author: Brett Schaad
--}}

@extends("cn.layouts.app")

@section('title', 'Profile')

@section('main-content')

    <table>

        <tr><th colspan = "2"><h1>General Info</h1></th></tr>

        <tr>
            <th>Name:</th>
            <td>{{ $center->center_name or "Name not found" }}</td>
        </tr>

        <tr>
            <th>Description:</th>
            <td>{{ $center->description or "Description not found" }}</td>
        </tr>

        <tr>
            <th>Online Exam Support:</th>
            <td>
            @if($center->canSupportOnlineExam == 1)
                Yes
            @elseif($center->canSupportOnlineExam == 0)
                No
            @else
                Online support not found
            @endif</td>
        </tr>

        <tr>
            <th>Exam Cost:</th>
            <td>{{'$'}}{{ $center->cost or "Exam cost not found" }}</td>
        </tr>

        <tr><th colspan = "2"><hr><h1>Contact</h1></th></tr>

        <tr>
            <th>Phone Number:</th>
            <td>{{ $center->phone or "Phone number not found" }}</td>
        </tr>

        <tr>
            <th>Login Email:</th>
            <td>{{ $login_email or "Email not found" }}</td>
        </tr>

        <tr>
            <th>Center Email:</th>
            <td>{{ $center->center_email or "Email not found" }}</td>
        </tr>

        {{--TODO add website--}}
        {{--<tr>--}}
            {{--<th>Website:</th>--}}
            {{--<td>{{ $center->website or "Website not found" }}</td>--}}
        {{--</tr>--}}

        <tr><th colspan = "2"><hr><h1>Address</h1></th></tr>

        <tr>
            <th>Street Address:</th>
            <td>{{ $center->street_address or "Street address not found" }}</td>
        </tr>

        <tr>
            <th>City:</th>
            <td>{{ $center->city or "City not found" }}</td>
        </tr>

        <tr>
            <th>Province:</th>
            <td>{{ str_replace("_", " ", $center->province) }}</td>
        </tr>

        <tr>
            <th>Country:</th>
            <td>{{ $center->country or "Country not found" }}</td>
        </tr>

        <tr>
            <th>Postal Code:</th>
            <td>{{ $center->postal_code }}</td>
        </tr>

        {{--TODO - delete--}}
        <tr>
            <th>Longitude:</th>
            <td>{{ $center->longitude }}</td>
        </tr>

        {{--TODO - delete--}}
        <tr>
            <th>Latitude:</th>
            <td>{{ $center->latitude }}</td>
        </tr>

        {{ Form::open(array('action' => 'CenterController@editProfile')) }}

        {{ Form::hidden('cid', $center->cid) }}

        <tr>
            <th></th>
            <td>{{ Form::submit('Edit') }}</td>
        </tr>

        {{ Form::close() }}
    </table>
@stop