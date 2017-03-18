@extends("cn.layouts.app")

@section('title', 'Profile')

@section('main-content')
    <table>
    {{ Form::open(array('action' => 'CenterController@updateProfile')) }}

        {{ Form::hidden('cid', $center->cid) }}

        <tr><th colspan = "2"><hr>General Info</th></tr>

        <tr>
            <td>{{ Form::label('cname', 'Name:') }}</td>
            <td>{{ Form::text('name', $center->name) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('description', 'Description:') }}</td>
            <td>{{ Form::textarea('description', $center->description) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('canSupportOnlineExam', 'Online Exam Support:') }}</td>
            <td>
                @if($center->canSupportOnlineExam == 1)
                    Yes{{ Form::radio('canSupportOnlineExam', '1', true) }}
                    No{{ Form::radio('canSupportOnlineExam', '0') }}
                @elseif($center->canSupportOnlineExam == 0)
                    Yes{{ Form::radio('canSupportOnlineExam', '1') }}
                    No{{ Form::radio('canSupportOnlineExam', '0', true)}}
                @endif
            </td>
        </tr>

        <tr>
            <td>{{ Form::label('cost', 'Exam Cost:') }}</td>
            <td>{{ Form::text('cost', $center->cost) }}</td>
        </tr>

        <tr><th colspan = "2"><hr>Contact</th></tr>

        <tr>
            <td>{{ Form::label('phone', 'Phone Number:') }}</td>
            <td>{{ Form::text('phone', $center->phone) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('center_email', 'Email:') }}</td>
            <td>{{ Form::email('center_email', $center->center_email) }}</td>
        </tr>

        {{--TODO - add website--}}
        {{--<tr>--}}
            {{--<td>{{ Form::label('website', 'Website:') }}</td>--}}
            {{--<td>{{ Form::text('website') }}</td>--}}
        {{--</tr>--}}

        <tr><th colspan = "2"><hr>Address</th></tr>

        <tr>
            <td>{{ Form::label('street_address', 'Street Address:') }}</td>
            <td>{{ Form::text('street_address', $center->street_address) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('city', 'City:') }}</td>
            <td>{{ Form::text('city', $center->city) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('province', 'Province:') }}</td>
            <td>{{ Form::select('province', [
                'British_Columbia' => 'British Columbia',
                'Alberta' => 'Alberta',
                'Sasketchewan' => 'Sasketchewan',
                'Manitoba' => 'Manitoba',
                'Ontario' => 'Ontario',
                'Quebec' => 'Quebec',
                'Nova_Scotia' => 'Nova Scotia',
                'Newfoundland_and_Labrador' => 'Newfoundland and Labrador',
                'New_Brunswick' => 'New Brunswick',
                'Prince_Edward_Island' => 'Prince Edward Island',
                'Yukon' => 'Yukon',
                'Northwest_Territories' => 'Northwest Territories',
                'Nunavut' => 'Nunavut'
                ], $center['province']
                ) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('country', 'Country:') }}</td>
            <td>{{ Form::select('country', [
                'Canada' => 'Canada'
                ], $center['country']) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('postal_code', 'Postal Code:') }}</td>
            <td>{{ Form::text('postal_code', $center->postal_code) }}</td>
        </tr>

        {{--TODO - delete--}}
        <tr>
            <td>{{ Form::label('longitude', 'Longitude:') }}</td>
            <td>{{ Form::text('longitude', $center->longitude) }}</td>
        </tr>

        {{--TODO - delete--}}
        <tr>
            <td>{{ Form::label('latitude', 'Latitude:') }}</td>
            <td>{{ Form::text('latitude', $center->latitude) }}</td>
        </tr>

        <tr>
            <td></td>
            <td>{{ Form::submit('Submit') }}</td>
        </tr>

    {{ Form::close() }}
    </table>
@stop