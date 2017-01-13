<!DOCTYPE html>
<html lang="en">

@section('htmlheader')
    @include('cn.layouts.partials.htmlheader')
@show
<body class="{{ LAConfigs::getByKey('skin') }} {{ LAConfigs::getByKey('layout') }} @if(LAConfigs::getByKey('layout') == 'sidebar-mini') sidebar-collapse @endif" bsurl="{{ url('') }}" adminRoute="{{ url('/center') }}">
<div class="wrapper">

@include('cn.layouts.partials.mainheader')

@if(LAConfigs::getByKey('layout') != 'layout-top-nav')
    @include('cn.layouts.partials.sidebar')
@endif

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @if(LAConfigs::getByKey('layout') == 'layout-top-nav') <div class="container"> @endif
        @if(!isset($no_header))
            @include('cn.layouts.partials.contentheader')
        @endif

        <!-- Main content -->
            <section class="content {{ $no_padding or '' }}">
                <!-- Your Page Content Here -->
                @yield('main-content')
            </section><!-- /.content -->

            @if(LAConfigs::getByKey('layout') == 'layout-top-nav') </div> @endif
    </div><!-- /.content-wrapper -->

    @include('cn.layouts.partials.controlsidebar')

    @include('cn.layouts.partials.footer')

</div><!-- ./wrapper -->

@include('cn.layouts.partials.file_manager')

@section('scripts')
    @include('cn.layouts.partials.scripts')
@show

</body>
</html>
