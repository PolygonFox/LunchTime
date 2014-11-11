@extends('layouts.base')

@section('title')
Mijn Account
@stop

@section('content')
<h1>Mijn gegevens</h1>
<label>E-mail: {{$user->email}}</label>
<a href="{{URL::to('account/edit')}}">Wachtwoord wijzigen</a>
@if($user->admin)
<label>U heeft de status beheerder.</label>
@endif
@stop