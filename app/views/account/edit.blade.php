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

{{Form::password('old_password', array ('placeholder' => 'Oude Wachtwoord', 'class' => 'main_inp'))}}<br>

{{Form::password('new_password', array ('placeholder' => 'Nieuwe Wachtwoord', 'class' => 'main_inp'))}}<br>

{{Form::password('new_password_repeat', array ('placeholder' => 'Herhaal Wachtwoord', 'class' => 'main_inp'))}}<br>

{{Form::submit('Wijzigen', array ('class' => 'main_btn'))}}
{{Form::close()}}
<a href="#">Terug</a>
</div>

@stop