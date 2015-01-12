@extends('layouts.main')

@section('title')
Login
@stop

@section('head')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/login.css')}}" >
@stop

@section('vulling')
<div class="main_page">
{{Form::open( array('class' => 'login_form'))}}
	<h1>LunchTime</h1><br>
{{Form::email('e-mail', Input::old('email'), array('placeholder' => 'Email', 'class' => 'login'))}}<br>
{{Form::password('wachtwoord', array('placeholder' => 'Password', 'class' => 'login'))}}<br><br><br>

	@foreach ($errors->all() as $error)
		<p class="error">{{ $error}}</p>
	@endforeach
{{Form::submit('Login', array('class' => 'color'))}}<br>


{{Form::close()}}
<a class="main_a" href='{{URL::to('account/forgot')}}'><button class="color"><p>Wachtwoord Vergeten</p></button></a>
</div>
@stop