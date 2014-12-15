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
	{{Form::email('email',"", array('placeholder' => 'Je Email', 'class' => 'main_inp'))}}<br>
	{{Form::submit('Verstuur', array('class' => 'close_input'))}}
	{{Form::close()}}
	<a href='{{URL::to('login')}}'>
		<button class="main_btn">
			<i class="fa fa-arrow-left"></i>
			&nbsp;&nbsp;Terug
		</button>
	</a>
</div>

@stop