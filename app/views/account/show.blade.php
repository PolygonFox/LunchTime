@extends('layouts.base')

@section('title')
Mijn Account
@stop

@section('content')
<h1>Mijn gegevens</h1>
<label>E-mail: {{$user->email}}</label><br>
<label>U heeft de status beheerder.</label><br>
<a href="{{URL::to('account/edit')}}">Wachtwoord wijzigen</a><br>
@if($user->admin)

@endif
@stop