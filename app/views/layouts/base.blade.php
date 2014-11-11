@extends('layouts.main')
@section('vulling')

	<div class="menu_ver">
		{{{ isset($message ) ? $message : '' }}}
		<ul>
		<li><a class="menu_a" href="{{URL::to('')}}">Overzicht</a></li>
		<li><a class="menu_a" href="{{URL::to('account')}}">Mijn Account</a></li>
		@if(Auth::User()->admin)
		<li><a class="menu_a" href="{{URL::to('beheer')}}">Beheer</a></li>
		@endif
		<li><a class="menu_a" href="{{URL::to('logout')}}">Uitloggen</a></li>
		<ul>
	</div>
		<div class='content'>
			@yield('content')
		</div>
@stop