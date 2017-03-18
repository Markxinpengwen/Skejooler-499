@extends("cn.layouts.app")

@section('title', 'Request')

@section('main-content')
    <table>
        {{ Form::open(array('action' => 'CenterController@updateRequest')) }}
        {{ Form::hidden('rid', $request->rid) }}
        {{ Form::hidden('center', $request->center) }}
        {{ Form::hidden('student', $request->student) }}

        <tr><th colspan = "2"><hr>General Info</th></tr>

        <tr>
            <td></td>
            <td>{{ Form::submit('Submit') }}</td>
        </tr>

        {{ Form::close() }}
    </table>
@stop