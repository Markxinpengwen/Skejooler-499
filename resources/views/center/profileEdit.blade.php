{{--
    Author: Brett Schaad
--}}

@extends("cn.layouts.app")

@section('contentheader_title')Edit Your Profile @endsection

@section('main-content')
    <table class="table table-responsive" width="100%">

        {{ Form::open(array('action' => 'CenterController@updateProfile')) }}

            <tr><th colspan = "2"><h1>General Info</h1></th></tr>

            <tr style="font-size: 1.3em;">
                <th>{{ Form::label('center_name', 'Name:') }}</th>
                <td>{{ Form::text('center_name', $center->center_name) }}</td>
            </tr>

            <tr style="font-size: 1.3em;"r>
                <th>{{ Form::label('description', 'Description:') }}</th>
                <td>{{ Form::textarea('description', $center->description) }}</td>
            </tr>

            <tr style="font-size: 1.3em;">
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

            <tr style="font-size: 1.3em;">
                <th>{{ Form::label('cost', 'Exam Cost:') }}</th>
                <td>{{ Form::text('cost', $center->cost) }}</td>
            </tr>

            <tr><th colspan = "2"><hr><h1>Contact</h1></th></tr>

            <tr style="font-size: 1.3em;">
                <th>{{ Form::label('phone', 'Phone Number:') }}</th>
                <td>{{ Form::text('phone', $center->phone) }}</td>
            </tr>

            <tr style="font-size: 1.3em;">
                <th>Login Email:</th>
                <td>{{ $login_email or "Email not found" }}</td>
            </tr>

            <tr style="font-size: 1.3em;">
                <th>{{ Form::label('center_email', 'Center Email:') }}</th>
                <td>{{ Form::email('center_email', $center->center_email) }}</td>
            </tr>

            <tr><th colspan = "2"><hr><h1>Address</h1></th></tr>

            <tr style="font-size: 1.3em;">
                <th>{{ Form::label('street_address', 'Street Address:') }}</th>
                <td>{{ Form::text('street_address', $center->street_address) }}</td>
            </tr>

            <tr style="font-size: 1.3em;">
                <th>{{ Form::label('city', 'City:') }}</th>
                <td>{{ Form::text('city', $center->city) }}</td>
            </tr>

            <tr style="font-size: 1.3em;">
                <th>{{ Form::label('province', 'Province:') }}</th>
                <td>{{ Form::select('province', [
                    'british_columbia' => 'British Columbia' ,
                    'alberta' => 'Alberta',
                    'sasketchewan' => 'Sasketchewan',
                    'manitoba' => 'Manitoba',
                    'ontario' => 'Ontario',
                    'quebec' => 'Quebec',
                    'nova_scotia' => 'Nova Scotia',
                    'newfoundland_and_labrador' => 'Newfoundland and Labrador',
                    'new_brunswick' => 'New Brunswick',
                    'prince_edward_island' => 'Prince Edward Island',
                    'yukon' => 'Yukon',
                    'northwest_territories' => 'Northwest Territories',
                    'nunavut' => 'nunavut',
                    ], $center->province
                    ) }}</td>
            </tr>

            <tr style="font-size: 1.3em;">
                <th>{{ Form::label('country', 'Country:') }}</th>
                <td>{{ Form::select('country', [
                    'Canada' => 'Canada'
                    ], $center->country) }}</td>
            </tr>

            <tr style="font-size: 1.3em;">
                <th>{{ Form::label('postal_code', 'Postal Code:') }}</th>
                <td>{{ Form::text('postal_code', $center->postal_code) }}</td>
            </tr>


            {{--TODO - delete--}}
            <tr style="font-size: 1.3em;">
                <th>{{ Form::label('longitude', 'Longitude:') }}</th>
                <td>{{ Form::text('longitude', $center->longitude) }}</td>
            </tr>

            {{--TODO - delete--}}
            <tr style="font-size: 1.3em;">
                <th>{{ Form::label('latitude', 'Latitude:') }}</th>
                <td>{{ Form::text('latitude', $center->latitude) }}</td>
            </tr>

            {{ Form::hidden('cid', $center->cid) }}

            <tr>
                <th></th>
                <td>
                    <div class="btn-group btn-group-lg">
                        {{ Form::submit('Submit', $attributes = array('id'=>"submitButton", 'class'=>"btn btn-primary")) }}
                    </div>
                </td>
            </tr>

        {{ Form::close() }}

    </table>
@stop