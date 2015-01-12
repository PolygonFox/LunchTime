@extends('layouts.main')

@section('title')
Geblokkeerd
@stop

@section('head')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/login.css')}}" >
@stop

@section('vulling')
<div class="main_page">
	<h1>Dit account is geblokkeerd.</h1>
	<p>Neem voor meer informatie contact op met de beheerder.</p>
</div>
@stop