@extends('layouts.base')

@section('title')
Groepen
@stop

@section('content')

<h1>Mijn groepen</h1>
<div class='messages_bar'>
	@if(isset($message))
		@if(is_array($message))
			@foreach($message as $msg)
				<div>{{$msg}}</div>
			@endforeach
		@else
			<div>{{$message}}</div>
		@endif
	@endif
</div>
@if(isset($organisations[0]))
	<ul class="overview">
		@foreach($organisations as $org)
		<li class="shop">
			<a href='{{URL::to($org->id . '/boodschappenlijsten')}}'>{{ucfirst($org->name)}}</a>
			@if($org->beheerder)
				<a style="background-color: #1EAEDB;" href="{{URL::to($org->id.'/beheer')}}">Instellingen</a>
			@endif
		</li>
		@endforeach
	</ul>
@else
	<p>U heeft nog geen groepen.</p>
@endif
<a href='{{URL::to('groep/nieuw')}}' class='button overview'>Nieuwe groep maken</a>
@stop