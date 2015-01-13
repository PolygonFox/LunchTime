@extends('layouts.main')

@section('title')
Nieuw wachtwoord
@stop

@section('head')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/login.css')}}" >
@stop

@section('vulling')
<div class="main_page">
<h1>Nieuw wachtwoord</h1>

@foreach($errors->all() as $error)
	<p class="error">{{$error}}</p><br/>
@endforeach

{{Form::open()}}

{{Form::password('new_password', array('placeholder' => 'Nieuw wachtwoord', 'class' => 'login'))}}<br>
{{Form::password('new_password_repeat', array('placeholder' => 'Herhaal wachtwoord', 'class' => 'login'))}}<br>

{{Form::submit('Wachtwoord wijzigen', array('class' => 'color'))}}
{{Form::close()}}
</div>

@stop