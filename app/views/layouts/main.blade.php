<!doctype html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="{{URL::asset('css/css.css')}}">
		<link rel="stylesheet" type="text/css" href="{{URL::asset('css/simple-sidebar.css')}}" >
		<link rel="stylesheet" type="text/css" href="{{URL::asset('css/bootstrap.css')}}" >
		<link rel="stylesheet" type="text/css" href="{{URL::asset('css/font-awesome.min.css')}}" >
		<script type="text/javascript" src="{{URL::asset('js/jquery.js')}}"></script>
		@yield('head')
		<title>LunchTime - @yield('title')</title>
	</head>
	<body>
		<div id="wrapper">
			@yield('vulling')
		</div>
	    <script src="{{URL::asset('js/jquery.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
	</body>
</html>