<!doctype html>
	<head>
		<!-- Mobile Specific Metas
		–––––––––––––––––––––––––––––––––––––––––––––––––– -->
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- FONT
		–––––––––––––––––––––––––––––––––––––––––––––––––– -->
		<link href='//fonts.googleapis.com/css?family=Raleway:400,300,600' rel='stylesheet' type='text/css'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="{{URL::asset('css/css.css')}}">
		<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}">
		<link rel="stylesheet" type="text/css" href="{{URL::asset('css/normalize.css')}}" >
		<link rel="stylesheet" type="text/css" href="{{URL::asset('css/skeleton.css')}}" >
		<link rel="stylesheet" type="text/css" href="{{URL::asset('css/font-awesome.min.css')}}" >
		<script type="text/javascript" src="{{URL::asset('js/jquery.js')}}"></script>
		<script type="text/javascript" src="{{URL::asset('js/Errors.js')}}"></script>
		@yield('head')
		<title>Lunchtime - @yield('title')</title>
	</head>
	<body>
		<div id="wrapper">
			@yield('vulling')
		</div>
	    <script src="{{URL::asset('js/jquery.js')}}"></script>
	</body>
</html>