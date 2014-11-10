@extends('layouts.main')

@section('title')
LunchTime - Login
@stop

@section('vulling')
<h1>Inloggen</h1>
{{Form::open()}}
{{Form::label('email','Email')}}
{{Form::text('email')}}
{{Form::label('password','Wachtwoord')}}
{{Form::password('password')}}
{{Form::submit('Login')}}
{{Form::close()}}
@stop