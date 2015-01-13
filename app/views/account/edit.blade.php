@extends('layouts.base')

@section('title')
Wachtwoord Wijzigen
@stop

@section('content')
<div class="user_data">
<h1>Wachtwoord Wijzigen</h1>

@foreach($errors->all() as $error)
	<label>{{$error}}</label><br/>
@endforeach

{{Form::open()}}

{{Form::password('old_password', array ('placeholder' => 'Oude Wachtwoord', 'class' => 'main_inp'))}}<br>

{{Form::password('new_password', array ('placeholder' => 'Nieuwe Wachtwoord', 'class' => 'main_inp'))}}<br>

{{Form::password('new_password_repeat', array ('placeholder' => 'Herhaal Wachtwoord', 'class' => 'main_inp'))}}<br>

{{Form::submit('Wijzigen', array ('class' => 'submit_input'))}}
{{Form::close()}}
<a class="button submit_input" href="{{URL::to('/account')}}">Terug</a>
</div>

@stop