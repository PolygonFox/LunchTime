@extends('layouts.main')

@section('title')
Maak nieuw account
@stop

@section('head')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/login.css')}}" >
@stop

@section('vulling')
<div class="main_page">
<h1>Registeren</h1>
<p>U krijgt een email waar u uw account mee kunt activeren.</p>
{{$errors->first('email')}}<br>

{{Form::open(array('class' => 'new'))}}

{{Form::email('email', null, array('placeholder' => 'Email', 'class' => 'main_inp'))}}
<br/>
{{Form::submit('Registreer account', array( 'class' => 'submit_input'))}}
{{Form::close()}}
</div>
@stop
