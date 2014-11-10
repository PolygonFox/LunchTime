@extends('layouts.main')

@section('title')
LunchTime - Login
@stop

@section('vulling')
<h1>Inloggen</h1>
{{Form::open()}}
{{Form::label('email','Email')}}
{{Form::email('email')}}<br>
{{Form::label('password','Wachtwoord')}}
{{Form::password('password')}}<br>
{{Form::submit('Login')}}
{{Form::close()}}
@stop