@extends('layouts.base')

@section('title')
Maak nieuw account
@stop

@section('content')
<h1>Nieuwe gebruiker aanmaken</h1>

{{$errors->first('email')}}<br>
{{$errors->first('password')}}<br>
{{$errors->first('repeatpassword')}}<br>

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
{{Form::label('admin','Beheerder')}}
{{Form::checkbox('admin', '1');}}
<br/>
{{Form::submit('Maak nieuw account')}}
{{Form::close()}}

@stop
