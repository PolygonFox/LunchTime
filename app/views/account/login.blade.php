@extends('layouts.base')

@section('title')
Login
@stop

@section('content')
<h1>Halloo !!!</h1>

{{Form::open()}}
{{Form::label('email','Email')}}
{{Form::text('email')}}
{{Form::label('password','Wachtwoord')}}
{{Form::password('password')}}
{{Form::submit('Login')}}
{{Form::close()}}

@stop
