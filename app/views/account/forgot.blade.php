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
		<h1>Wachtwoord wijzigen</h1>
		<p>We sturen u een email met een link om uw wachtwoord te wijzigen.</p>
	</div>
	@foreach($errors->all() as $error)
	<p class="error">Error: {{$error}}</p><br/>
	@endforeach
	{{Form::open()}}
	{{Form::email('email',"", array('placeholder' => 'E-mail', 'class' => 'main_inp'))}}<br><br><br>
	{{Form::submit('Verstuur', array('class' => 'color submit_input'))}}
	{{Form::close()}}
	<a class="button submit_input color" href="{{URL::to('/login')}}">Terug</a>
</div>

@stop