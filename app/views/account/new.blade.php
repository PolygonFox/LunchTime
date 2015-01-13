@extends('layouts.base')

@section('title')
Maak nieuw account
@stop

@section('content')
<h1>Nieuwe gebruiker aanmaken</h1>

{{$errors->first('email')}}<br>

{{Form::open(array('class' => 'new'))}}

{{Form::email('email', null, array('placeholder' => 'Email', 'class' => 'main_inp'))}}
<br/>
{{Form::label('admin','Beheerder')}}
{{Form::checkbox('admin', '1')}}
<br/>
{{Form::submit('Maak nieuw account', array( 'class' => 'main_btn'))}}
{{Form::close()}}

@stop
