@extends('layouts.base')

@section('title')
Maak nieuw account
@stop

@section('content')
<h1>Nieuwe gebruiker aanmaken</h1>

{{$errors->first('email')}}<br>
{{$errors->first('password')}}<br>
{{$errors->first('repeatpassword')}}<br>

{{Form::open(array('class' => 'new'))}}

{{Form::text('email', null, array('placeholder' => 'Email', 'class' => 'main_inp'))}}
<br/>
{{Form::password('password', array('placeholder' => 'Wachtwoord', 'class' => 'main_inp'))}}
<br/>
{{Form::password('repeatpassword', array('placeholder' => 'Herhaal Wachtwoord', 'class' => 'main_inp'))}}
<br/>
{{Form::label('admin','Beheerder')}}
{{Form::checkbox('admin', '1')}}
<br/>
{{Form::submit('Maak nieuw account', array( 'class' => 'main_btn'))}}
{{Form::close()}}

@stop
