@extends('layouts.base')

@section('title')
Wachtwoord Wijzigen
@stop

@section('content')
<div class="changepasscontent">
<h1>Wachtwoord Wijzigen</h1>

@foreach($errors->all() as $error)
	<label>Error: {{$error}}</label><br/>
@endforeach

{{Form::open()}}

{{Form::label('old_password','Oud wachtwoord:')}}
{{Form::password('old_password')}}<br>

{{Form::label('new_password','Nieuw wachtwoord:')}}
{{Form::password('new_password')}}<br>

{{Form::label('new_password_repeat','Herhaal wachtwoord:')}}
{{Form::password('new_password_repeat')}}

{{Form::submit('Wijzigen')}}
{{Form::close()}}
</div>

@stop