@extends("cn.layouts.app")

@section('title', 'Profile')

@section('main-content')
    <table>
    {{ Form::open(array('action' => 'CenterController@updateProfile')) }}

        {{--TODO - delete--}}
        <tr><th colspan = "2">Unchangeable</th></tr>

        {{--TODO - delete--}}
        <tr>
            <td>{{ Form::label('cid', 'Center ID:') }}</td>
            <td>{{ Form::number('cid', $center->cid) }}</td>
        </tr>

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
            {{--TODO if/else to determine radio fill--}}
            <td>Yes{{ Form::radio('canSupportOnlineExam-yes') }}
                No{{ Form::radio('canSupportOnlineExam-no') }}</td>
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
            <td>{{ Form::label('email', 'Email:') }}</td>
            <td>{{ Form::email('email', $center->email) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('website', 'Website:') }}</td>
            <td>{{ Form::text('website') }}</td>
        </tr>

        <tr><th colspan = "2"><hr>Address</th></tr>

        <tr>
            <td>{{ Form::label('street_name', 'Street Name:') }}</td>
            <td>{{ Form::text('street_name', $center->street_name) }}</td>
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