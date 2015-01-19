@extends('layouts.main')

@section('title')
Nieuw account activeren
@stop

@section('head')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/login.css')}}" >
@stop

@section('vulling')
<div class="main_page">
{{Form::open( array('class' => 'login_form'))}}
	<h1>Lunchtime</h1>
	<h5>Activeer account</h5>
{{Form::password('wachtwoord', array('placeholder' => 'Wachtwoord', 'class' => 'login'))}}
{{Form::password('wachtwoord2', array('placeholder' => 'Herhaal Wachtwoord', 'class' => 'login'))}}<br>
	@foreach ($errors->all() as $error)
		<p class="error">{{$error}}</p>
	@endforeach
	<br>
{{Form::submit('Account activeren', array('class' => 'color'))}}
{{Form::close()}}
</div>
@stop