@extends('layouts.main')

@section('title')
LunchTime - Login
@stop

@section('vulling')

{{Form::open( array('class' => 'login_form'))}}
	<h1 class="login">Inloggen</h1>
{{Form::email('email', null, array('placeholder' => 'Email', 'class' => 'login'))}}<br>
{{Form::password('password', array('placeholder' => 'Password', 'class' => 'login'))}}<br>

	@foreach ($errors->all() as $error)
		<p class="error">{{ $error}}</p>
	@endforeach
{{Form::submit('Login', array('class' => 'close_input'))}}
{{Form::close()}}
@stop