@extends('layouts.main')

@section('title')
Nieuw wachtwoord
@stop

@section('vulling')
<div class="changepasscontent">
<h1>Nieuw Wachtwoord</h1>

@foreach($errors->all() as $error)
	<label>Error: {{$error}}</label><br/>
@endforeach

{{Form::open()}}

{{Form::password('new_password', array('placeholder' => 'Nieuw Wachtwoord'))}}
{{Form::password('new_password_repeat', array('placeholder' => 'Herhaal Wachtwoord'))}}

{{Form::submit('Verstuur')}}
{{Form::close()}}
</div>

@stop