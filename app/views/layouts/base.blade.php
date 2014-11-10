@extends('layouts.main')
@section('vulling')
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
@stop