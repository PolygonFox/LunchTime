@extends('layouts.base')

@section('title')
Login
@stop

@section('content')
<h1>Wachtwoord Wijzigen</h1>

@foreach($errors->all() as $error)
	<label>Error: {{$error}}</label><br/>
@endforeach

{{Form::open()}}

{{Form::label('old_password','Oud wachtwoord:')}}
{{Form::password('old_password')}}

{{Form::label('new_password[0]','Nieuw wachtwoord:')}}
{{Form::password('new_password[0]')}}

{{Form::label('new_password[1]','Herhaal wachtwoord:')}}
{{Form::password('new_password[1]')}}

{{Form::submit('Wijzigen')}}
{{Form::close()}}

@stop