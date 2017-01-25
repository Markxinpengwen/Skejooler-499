@extends('layouts.dashboard')

@section('title', 'Schedule')

@section('content')
    <table>

        <tr><th colspan = "5">Upcoming Exams</th></tr>

        {{--TODO - need schedule table then implement display--}}
        @php $i = 0 @endphp
        @while($i < 3)
            <tr>
                <td>April 10th, 2016</td>
                <td>11:00am</td>
                <td>POL SCI 100</td>
                <td>BCIT - Vancouver</td>
                <td>Midterm 1</td>
                @php $i++ @endphp
            </tr>
        @endwhile

        <tr><th colspan = "5"><hr>Exams Pending Approval</th></tr>

        @php $i = 0 @endphp
        @while($i < 6)
            <tr>
                <td>April 10th, 2016</td>
                <td>11:00am</td>
                <td>POL SCI 100</td>
                <td>BCIT - Vancouver</td>
                <td>Midterm 1</td>
                @php $i++ @endphp
            </tr>
        @endwhile

        <tr><th colspan = "5"><hr>Past Exams</th></tr>

        @php $i = 0 @endphp
        @while($i < 5)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $i }}</td>
                <td>{{ $i }}</td>
                <td>{{ $i }}</td>
                <td>{{ $i }}</td>
                @php $i++ @endphp
            </tr>
        @endwhile

    </table>
@stop