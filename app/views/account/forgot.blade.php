@extends('layouts.main')

@section('title')
Wachtwoord Resetten
@stop

@section('head')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/login.css')}}" >
@stop

@section('vulling')
<div class="main_page">
	<div  class="reset_txt">
		<h1>Wachtwoord Resetten</h1>
		<p>Om je wachtwoord te resetten moet je uw emailadres invullen en op verstuur drukken.</p>
	</div>
	{{Form::open()}}
	{{Form::email('email',"", array('placeholder' => 'Je Email', 'class' => 'main_inp'))}}<br><br><br>
	{{Form::submit('Verstuur', array('class' => 'color submit_input'))}}
	{{Form::close()}}
	<a class="button submit_input color" href="{{URL::to('/login')}}">Terug</a>
</div>

@stop