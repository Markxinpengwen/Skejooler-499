@extends("cn.layouts.app")

@section('title', 'Profile')

@section('main-content')

    <table class="table table-responsive table-hover" width="100%">

        <tr><th colspan = "2"><h1>General Info</h1></th></tr>

        <tr style="font-size: 1.3em;">
            <th>Name:</th>
            <td>{{ $center->center_name or "Name not found" }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Description:</th>
            <td>{{ $center->description or "Description not found" }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
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

        <tr style="font-size: 1.3em;">
            <th>Exam Cost:</th>
            <td>{{'$'}}{{ $center->cost or "Exam cost not found" }}</td>
        </tr>

        <tr><th colspan = "2"><hr><h1>Contact</h1></th></tr>

        <tr style="font-size: 1.3em;">
            <th>Phone Number:</th>
            <td>{{ $center->phone or "Phone number not found" }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Login Email:</th>
            <td>{{ $login_email or "Email not found" }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Center Email:</th>
            <td>{{ $center->center_email or "Email not found" }}</td>
        </tr>

        {{--TODO add website--}}
        {{--<tr>--}}
            {{--<th>Website:</th>--}}
            {{--<td>{{ $center->website or "Website not found" }}</td>--}}
        {{--</tr>--}}

        <tr><th colspan = "2"><hr><h1>Address</h1></th></tr>

        <tr style="font-size: 1.3em;">
            <th>Street Address:</th>
            <td>{{ $center->street_address or "Street address not found" }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>City:</th>
            <td>{{ $center->city or "City not found" }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Province:</th>
            <td>{{ str_replace("_", " ", $center->province) }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Country:</th>
            <td>{{ $center->country or "Country not found" }}</td>
        </tr>

        <tr style="font-size: 1.3em;">
            <th>Postal Code:</th>
            <td>{{ $center->postal_code }}</td>
        </tr>

        {{--TODO - delete--}}
        <tr style="font-size: 1.3em;">
            <th>Longitude:</th>
            <td>{{ $center->longitude }}</td>
        </tr>

        {{--TODO - delete--}}
        <tr style="font-size: 1.3em;">
            <th>Latitude:</th>
            <td>{{ $center->latitude }}</td>
        </tr>

        {{ Form::open(array('action' => 'CenterController@editProfile')) }}

        {{ Form::hidden('cid', $center->cid) }}

        <tr>
            <th></th>
            <td>
                <div class="btn-group btn-group-lg">
                    {{ Form::submit('Edit', $attributes = array('id'=>"editButton", 'class'=>"btn btn-primary")) }}
                </div>
            </td>
        </tr>

        {{ Form::close() }}
    </table>
@stop