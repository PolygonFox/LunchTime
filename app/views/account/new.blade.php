@extends('layouts.base')

@section('title')
Maak nieuw account
@stop

@section('content')
<div class="user_data">
<h1>Nieuwe gebruiker aanmaken</h1>

{{$errors->first('email')}}<br>

{{Form::open(array('class' => 'new'))}}

{{Form::email('email', null, array('placeholder' => 'Email', 'class' => 'main_inp'))}}

{{Form::label('admin','Beheerder')}}

<br/>
{{Form::submit('Maak nieuw account', array( 'class' => 'submit_input'))}}
{{Form::close()}}
</div>
@stop
