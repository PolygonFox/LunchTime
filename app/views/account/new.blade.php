@extends('layouts.main')

@section('title')
	Maak nieuw account
@stop

@section('head')
	<link rel="stylesheet" type="text/css" href="{{URL::asset('css/login.css')}}" >
@stop

@section('vulling')
	<div class="main_page">
		<h1>Registeren</h1>
		<p>U krijgt een e-mail waar u uw account mee kunt activeren.</p>

		{{Form::open(array('class' => 'new'))}}
			{{Form::email('email', null, array('placeholder' => 'E-mail', 'class' => 'main_inp'))}}
			<br/>
			@foreach ($errors->all() as $error)
				<p class="error">{{$errors->first('email')}}</p><br>
			@endforeach
			{{Form::submit('Registreer account', array( 'class' => 'submit_input'))}}
		{{Form::close()}}
		<a class="submit_input" href="{{URL::to('/login')}}"><button class="color"><p>Terug naar login</p></button></a>
	</div>
@stop