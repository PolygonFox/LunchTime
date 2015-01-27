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
		<li class="groups">
			<a  class="group_ttl" href='{{URL::to($org->id . '/boodschappenlijsten')}}'><h5>{{ucfirst($org->name)}}</h5></a>
			@if($org->beheerder)
				<a class="group_stngs" href="{{URL::to($org->id.'/beheer')}}"><i title="Instellingen" class="fa fa-wrench"></i>    Instelingen</a>
			@endif
		</li>
		@endforeach
	</ul>
@else
	<p>U heeft nog geen groepen.</p>
@endif
<a href='{{URL::to('groep/nieuw')}}' class='button overview'>Nieuwe groep maken</a>
@stop