@extends('layouts.main')

@section('title')
Login
@stop

@section('head')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/login.css')}}" >
@stop

@section('vulling')
<div class="login">
{{Form::open( array('class' => 'login_form'))}}
	<h1 class="login_H">LunchTime</h1><br>
	<h3 class="login_H">LogIn</h3>
{{Form::email('email', Input::get('email'), array('placeholder' => 'Email', 'class' => 'login'))}}<br>
{{Form::password('password', array('placeholder' => 'Password', 'class' => 'login'))}}<br>

	@foreach ($errors->all() as $error)
		<p class="error">{{ $error}}</p>
	@endforeach
{{Form::submit('Login', array('class' => 'close_input'))}}<br>


{{Form::close()}}
<a class="main_a" href='{{URL::to('account/forgot')}}'><button class="main_btn"><i class="fa fa-question"></i>                  Wachtwoord Vergeten</button></a>
</div>
@stop