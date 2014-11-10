@extends('layouts.base')

@section('title')
Mijn Account
@stop

@section('content')
<label>E-mail: {{$user->email}}</label>
<a href="{{URL::to('account/edit')}}">Wachtwoord wijzigen</a>
@if($user->admin)
<label>Je bent een beheerder</label>
@endif
@stop