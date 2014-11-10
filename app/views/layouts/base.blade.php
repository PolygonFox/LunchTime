<!doctype html>
	<head>
		<link rel="stylesheet" type="text/css" href="{{URL::asset('css/css.css')}}">
		<title>LunchTime - @yield('title')</title>
	</head>
	<body>
		{{{ isset($message ) ? $message : '' }}}
		<a href="{{URL::to('')}}">Overzicht</a>
		<a href="{{URL::to('account')}}">Mijn Account</a>
		@if(Auth::User()->admin)
		<a href="{{URL::to('beheer')}}">Beheer</a>
		@endif
		<a href="{{URL::to('logout')}}">Uitloggen</a>
		<div class='content'>
			@yield('content')
		</div>
	</body>
</html>