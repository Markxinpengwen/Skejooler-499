@extends('layouts/dashboard')

@section('title', 'Profile')

@section('content')
    <table>
    {{ Form::model($centers, array('action' => 'CenterController@profileEditor')) }}

        {{--TODO - delete--}}
        <tr><th colspan = "2">Unchangeable</th></tr>

        {{--TODO - delete--}}
        <tr>
            <td>{{ Form::label('cid', 'Center ID') }}</td>
            <td>{{ Form::number('cid') }}</td>
        </tr>

        <tr><th colspan = "2"><hr>General Info</th></tr>

        <tr>
            <td>{{ Form::label('name', 'Name') }}</td>
            <td>{{ Form::text('name') }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('description', 'Description') }}</td>
            <td>{{ Form::textarea('description') }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('canSupportOnlineExam', 'Online Exam Support') }}</td>
            <td>Yes{{ Form::radio('canSupportOnlineExam-yes') }}
                No{{ Form::radio('canSupportOnlineExam-no') }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('cost', 'Exam Cost') }}</td>
            <td>{{ Form::text('cost') }}</td>
        </tr>

        <tr><th colspan = "2"><hr>Contact</th></tr>

        <tr>
            <td>{{ Form::label('phone', 'Phone Number') }}</td>
            <td>{{ Form::text('phone') }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('email', 'Email') }}</td>
            <td>{{ Form::email('email') }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('website', 'Website') }}</td>
            <td>{{ Form::text('website') }}</td>
        </tr>

        <tr><th colspan = "2"><hr>Address</th></tr>

        <tr>
            <td>{{ Form::label('street_address', 'Street Address') }}</td>
            <td>{{ Form::text('street_address') }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('city', 'City') }}</td>
            <td>{{ Form::text('city') }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('province', 'Province') }}</td>
            <td>{{ Form::select('province', array(
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
                )) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('country', 'Country') }}</td>
            <td>{{ Form::select('province', array(
                'Canada' => 'Canada'
                )) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('', 'Postal Code') }}</td>
            <td>{{ Form::text('') }}</td>
        </tr>

        {{--TODO - delete--}}
        <tr>
            <td>{{ Form::label('', 'Longitude') }}</td>
            <td>{{ Form::text('') }}</td>
        </tr>

        {{--TODO - delete--}}
        <tr>
            <td>{{ Form::label('', 'Latitude') }}</td>
            <td>{{ Form::text('') }}</td>
        </tr>


        <tr>
            <td></td>
            <td>{{ Form::submit('Submit') }}</td>
        </tr>

    {{ Form::close() }}
    </table>
@stop