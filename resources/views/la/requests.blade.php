@extends('la.layouts.app')

{{--@section('htmlheader_title') Dashboard @endsection--}}
@section('contentheader_title') Requests @endsection
{{--@section('contentheader_description') Requests Overview @endsection--}}

@section('main-content')
<!-- Main content -->
        <section class="content">
			<?php
			$array = DB::select('SELECT * FROM requests');
			$array = json_decode(json_encode($array), true);
			?>
				<table class="table table-striped table-hover">
					<thead>
					<tr>
						<th>rid</th>
						<th>sid</th>
						<th>cid</th>
						<th>iid</th>
						<th>Preferred Date 1</th>
						<th>Preferred Date 2</th>
						<th>Scheduled Date</th>
						<th>Course Code</th>
						<th>Additional Requirements</th>
                        <th>Exam Type</th>
                        <th>Exam Medium</th>
                        <th>Computer Required</th>
                        <th>Student Approval</th>
                        <th>Student Note</th>
                        <th>Center Approval</th>
                        <th>Center Note</th>
					</tr>
					</thead>

					<tbody>
					@foreach($array as $attr)
						<tr>
							<td>{{$attr['rid']}}</td>
							<td>{{$attr['sid']}}</td>
							<td>{{$attr['cid']}}</td>
							<td>{{$attr['iid']}}</td>
							<td>{{$attr['preferred_date_1']}}</td>
							<td>{{$attr['preferred_date_2']}}</td>
							<td>{{$attr['scheduled_date']}}</td>
							<td>{{$attr['course_code']}}</td>
                            <td>{{$attr['additional_requirements']}}</td>
                            <td>{{$attr['exam_type']}}</td>
                            <td>{{$attr['exam_medium']}}</td>
                            <td>{{$attr['computer_required']}}</td>
                            <td>{{$attr['student_approval']}}</td>
                            <td>{{$attr['student_notes']}}</td>
                            <td>{{$attr['center_approval']}}</td>
                            <td>{{$attr['center_notes']}}</td>
							<td>
								<a href="delReq/{{$attr['id']}}" role="button" class="btn btn-danger btn-xs">Delete</a>
							</td>
						</tr>
					@endforeach
					</tbody>

        </section><!-- /.content -->
@endsection

@push('styles')
<!-- Morris chart -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/morris/morris.css') }}">
<!-- jvectormap -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
<!-- Date Picker -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/datepicker/datepicker3.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/daterangepicker/daterangepicker-bs3.css') }}">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush


@push('scripts')
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('la-assets/plugins/morris/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('la-assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('la-assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('la-assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('la-assets/plugins/knob/jquery.knob.js') }}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('la-assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('la-assets/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('la-assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('la-assets/plugins/fastclick/fastclick.js') }}"></script>
<!-- dashboard -->
<script src="{{ asset('la-assets/js/pages/dashboard.js') }}"></script>
@endpush

{{--@push('scripts')--}}
{{--<script>--}}
{{--(function($) {--}}
	{{--$('body').pgNotification({--}}
		{{--style: 'circle',--}}
		{{--title: 'Skejooler',--}}
		{{--message: "Welcome to Skejooler",--}}
		{{--position: "top-right",--}}
		{{--timeout: 0,--}}
		{{--type: "success",--}}
		{{--thumbnail: '<img width="40" height="40" style="display: inline-block;" src="{{ Gravatar::fallback(asset('la-assets/img/user2-160x160.jpg'))->get(Auth::user()->email, 'default') }}" data-src="assets/img/profiles/avatar.jpg" data-src-retina="assets/img/profiles/avatar2x.jpg" alt="">'--}}
	{{--}).show();--}}
{{--})(window.jQuery);--}}
{{--</script>--}}
{{--@endpush--}}