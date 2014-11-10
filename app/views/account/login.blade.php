@extends('layouts.base')

@section('title')
LunchTime - Login
@stop

@section('content')
<h1>Inloggen</h1>
{{{ isset($message ) ? $message : '' }}}
{{Form::open()}}
{{Form::label('email','Email')}}
{{Form::text('email')}}
{{Form::label('password','Wachtwoord')}}
{{Form::password('password')}}
{{Form::submit('Login')}}
{{Form::close()}}
@stop