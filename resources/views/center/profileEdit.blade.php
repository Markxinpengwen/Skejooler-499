@extends("cn.layouts.app")

@section('title', 'Profile')

@section('main-content')
    <table>

        {{ Form::open(array('action' => 'CenterController@updateProfile')) }}

            <tr><th colspan = "2"><h1>General Info</h1></th></tr>

            <tr>
                <th>{{ Form::label('name', 'Name:') }}</th>
                <td>{{ Form::text('name', $center->name) }}</td>
            </tr>

            <tr>
                <th>{{ Form::label('description', 'Description:') }}</th>
                <td>{{ Form::textarea('description', $center->description) }}</td>
            </tr>

            <tr>
                <th>{{ Form::label('canSupportOnlineExam', 'Online Exam Support:') }}</th>
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
                <th>{{ Form::label('cost', 'Exam Cost:') }}</th>
                <td>{{ Form::text('cost', $center->cost) }}</td>
            </tr>

            <tr><th colspan = "2"><hr><h1>Contact</h1></th></tr>

            <tr>
                <th>{{ Form::label('phone', 'Phone Number:') }}</th>
                <td>{{ Form::text('phone', $center->phone) }}</td>
            </tr>

            <tr>
                <th>Login Email:</th>
                <td>{{ $login_email or "Email not found" }}</td>
            </tr>

            <tr>
                <th>{{ Form::label('center_email', 'Email:') }}</th>
                <td>{{ Form::email('center_email', $center->center_email) }}</td>
            </tr>

            {{--TODO - add website--}}
            {{--<tr>--}}
                {{--<td>{{ Form::label('website', 'Website:') }}</td>--}}
                {{--<td>{{ Form::text('website') }}</td>--}}
            {{--</tr>--}}

            <tr><th colspan = "2"><hr><h1>Address</h1></th></tr>

            <tr>
                <th>{{ Form::label('street_address', 'Street Address:') }}</th>
                <td>{{ Form::text('street_address', $center->street_address) }}</td>
            </tr>

            <tr>
                <th>{{ Form::label('city', 'City:') }}</th>
                <td>{{ Form::text('city', $center->city) }}</td>
            </tr>

            <tr>
                <th>{{ Form::label('province', 'Province:') }}</th>
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
                    ], $center->province
                    ) }}</td>
            </tr>

            <tr>
                <th>{{ Form::label('country', 'Country:') }}</th>
                <td>{{ Form::select('country', [
                    'Canada' => 'Canada'
                    ], $center->country) }}</td>
            </tr>

            <tr>
                <th>{{ Form::label('postal_code', 'Postal Code:') }}</th>
                <td>{{ Form::text('postal_code', $center->postal_code) }}</td>
            </tr>

            {{--TODO - delete--}}
            <tr>
                <th>{{ Form::label('longitude', 'Longitude:') }}</th>
                <td>{{ Form::text('longitude', $center->longitude) }}</td>
            </tr>

            {{--TODO - delete--}}
            <tr>
                <th>{{ Form::label('latitude', 'Latitude:') }}</th>
                <td>{{ Form::text('latitude', $center->latitude) }}</td>
            </tr>

            {{ Form::hidden('cid', $center->cid) }}

            <tr>
                <th></th>
                <td>{{ Form::submit('Submit') }}</td>
            </tr>

        {{ Form::close() }}

    </table>
@stop