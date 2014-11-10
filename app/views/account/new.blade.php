@extends('layouts.base')

@section('title')
LunchTime - Maak nieuw account
@stop

@section('content')
<h1>Nieuw account aanmaken</h1>

{{Form::open()}}

{{Form::label('email','Email')}}
{{Form::text('email')}}
<br/>
{{Form::label('password','Wachtwoord')}}
{{Form::password('password')}}
<br/>
{{Form::label('repeatpassword','Herhaal Wachtwoord')}}
{{Form::password('repeatpassword')}}
<br/>
{{Form::label('repeatpassword','Herhaal Wachtwoord')}}
{{Form::checkbox('admin', '1');}}
<br/>
{{Form::submit('Maak nieuw account')}}
{{Form::close()}}

@stop
