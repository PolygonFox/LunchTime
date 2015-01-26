@extends('layouts.base')

@section('title')
Groepen
@stop

@section('content')

<h1>Mijn groepen</h1>
@if(!isset($organisations[0]))
	<ul class="overview">
		@foreach($organisations as $organisation)
		<li class='shop'><a href='#'>{{ucfirst($organisation->name)}}</a></li>
		@endforeach
	</ul>
@else
	<p>U heeft nog geen groepen.</p>
	<a href='{{URL::to('groep/nieuw')}}' class='button overview'>Nieuwe groep maken</a>
@endif

@stop