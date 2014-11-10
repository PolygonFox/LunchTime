@extends('layouts.main')
@section('vulling')
		
		<a href="{{URL::to('')}}">Overzicht</a>
		<a href="{{URL::to('account')}}">Mijn Account</a>
		@if(Auth::User()->admin)
		<a href="{{URL::to('beheer')}}">Beheer</a>
		@endif
		<a href="{{URL::to('logout')}}">Uitloggen</a>
		<div class='content'>
			{{{ isset($message ) ? $message : '' }}}
			@yield('content')
		</div>
@stop