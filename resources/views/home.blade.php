<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ LAConfigs::getByKey('site_description') }}">
    <meta name="author" content="Dwij IT Solutions">

    <meta property="og:title" content="{{ LAConfigs::getByKey('sitename') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="{{ LAConfigs::getByKey('site_description') }}" />
    
    <meta property="og:url" content="http://laraadmin.com/" />
    <meta property="og:sitename" content="laraAdmin" />
	<meta property="og:image" content="http://demo.adminlte.acacha.org/img/LaraAdmin-600x600.jpg" />
    
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@laraadmin" />
    <meta name="twitter:creator" content="@laraadmin" />
    
    <title>{{ LAConfigs::getByKey('sitename') }}</title>
    
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/la-assets/css/bootstrap.css') }}" rel="stylesheet">

	<link href="{{ asset('la-assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- Custom styles for this template -->
    <link href="{{ asset('/la-assets/css/main.css') }}" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

    <script src="{{ asset('/la-assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('/la-assets/js/smoothscroll.js') }}"></script>


</head>

<body data-spy="scroll" data-offset="0" data-target="#navigation">

<!-- Fixed navbar -->
<div id="navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><b>{{ LAConfigs::getByKey('sitename') }}</b></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                <!--
                    redirect basic on user type
                    modified in controller:vendor/laravel/framework/src/Illuminate/Foundation/Auth/AuthenticatesUsers.php
                 -->
                    <?php
                    $uid = Auth::user()->uid;
                    if(Auth::user()->type == "student"){
                        $array = DB::select('select firstName from students where sid = ? ',[$uid]);
                        $array = json_decode(json_encode($array), true);
                        $name = $array[0]['firstName'];
                    }

                    elseif(Auth::user()->type == "center"){
                        $array = DB::select('select name from centers where cid = ? ', [$uid]);
                        $array = json_decode(json_encode($array), true);
                        $name = $array[0]['name'];
                    }
                    ?>
                    @if(Auth::user()->type == 'center')
                        <li><a href="{{ url('/center') }}">{{ $name }}</a></li>
                        <li><a href="{{ url('/logout') }}">Log out</a></li>
                    @elseif(Auth::user()->type == 'student')
                        <li><a href="{{ url('/student') }}">{{ $name }}</a></li>
                        <li><a href="{{ url('/logout') }}">Log out</a></li>
                    @else
                        <li><a href="{{ url(config('laraadmin.adminRoute')) }}">Admin</a></li>
                        <li><a href="{{ url('/logout') }}">Log out</a></li>
                    @endif
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<section id="home" name="home"></section>
<div id="headerwrap">
    <div class="container" >
        <div class="row centered">
            <div class="col-lg-12">
                <h1><b>BOOK YOUR EXAM</b></h1>
                <h3>login or register to get started:</h3>
                <h3><a href="{{ url('/login') }}" class="btn btn-lg btn-success">Get Started!</a></h3><br>
            </div>
        </div>
    </div> <!--/ .container -->
</div><!--/ #headerwrap -->

<!-- FEATURES WRAP -->
<div id="features">
    <h3 class="row centered"><strong>What is Skejooler?</strong></h3><br>
    <div class="container">

        <div class="col-xs-6">
                <img src="{{ asset('/la-assets/img/Desk.png') }}">
        </div>

        <div class ="col-xs-6">
            <p><i> Lorem ipsum dolor sit amet, consectetur adipiscing</i></p>
            <p><i> elit. Nullam sit amet justo eget ex ultrices vulputate.</i></p>
            <p><i> Ut euismod tempus arcu, quis fermentum neque imperdiet sit amet.</i></p>
            <p><i> Vestibulum pulvinar, urna luctus finibus egestas,</i></p>
            <p><i> massa arcu dictum ipsum, quis elementum justo</i></p>
            <p><i> diam a augue. Vivamus ultricies nunc ac magna.</i></p>
        </div>
    </div>
</div>

<section id="about" name="about"></section>
<!-- INTRO WRAP -->
<div id="intro">
    <div class="container">
        <div class="row centered">
            <h1>Why use Skejooler?</h1>
            <br>
            <br>
            <div class="col-xs-3">
                <img  src="{{ asset('/la-assets/img/search.jpg') }}">
                <h3>Easy-To-Use</h3>
                <p> Search</p>
            </div>
            <div class="col-xs-3">
                <img  src="{{ asset('/la-assets/img/schedule.jpg') }}">
                <h3>Schedule</h3>
            </div>
            <div class="col-xs-3">
                <img  src="{{ asset('/la-assets/img/centers.jpg') }}">
                <h3>Invigilation</h3>
                <p>Centres</p>
            </div>
            <div class="col-xs-3">
                <img  src="{{ asset('/la-assets/img/programs.jpg') }}">
                <h3>Online</h3>
                <p>Programs</p>
            </div>
        </div>
        <br>
        <hr>
    </div> <!--/ .container -->
</div><!--/ #introwrap -->


<section id="contact" name="contact"></section>
<div id="footerwrap">
    <div class="container">
        <div class="col-lg-4">
            <h3>SKEJOOLER</h3>
            <a href="{{ url('/login') }}">HOME</a><br>
            <a href="{{ url('/login') }}">MAP</a><br>
            <a href="{{ url('/login') }}">HELP</a><br>
            <a href="{{ url('/login') }}">REGISTERATION FORM</a><br>
        </div>

        <div class="col-lg-4">
            <h3>EXAM RESOURCES</h3>
            <a href="{{ url('/login') }}">INVIGILATION CENTER INFO</a><br>
            <a href="{{ url('/login') }}">ONLINE PROGRAMS</a><br>
            <a href="{{ url('/login') }}">ARTICLES & RESOURCES</a><br>
            <a href="{{ url('/login') }}">JOB POSTING</a><br>
        </div>

        <div class="col-lg-4">
            <h3>FOLLOW US</h3>
            <img  src="{{ asset('/la-assets/img/google_plus.jpg') }}">
            <img  src="{{ asset('/la-assets/img/facebook.jpg') }}">
        </div>
    </div>
</div>



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('/la-assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script>
    $('.carousel').carousel({
        interval: 3500
    })
</script>
</body>
</html>
