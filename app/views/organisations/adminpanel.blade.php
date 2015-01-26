@extends('layouts.base')

@section('title') Instellingen groep 

@stop

@section("head") 
    <script type="text/javascript" src="{{URL::asset('js/Confirm.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/Errors.js')}}"></script>
@stop

@section('content')
	<h1>Instellingen groep</h1>
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
	<strong>Voeg gebruiker toe aan uw groep</strong>
	{{Form::open()}}
	{{Form::text('email', null, array('placeholder' => 'E-mail van gebruiker', 'class' => 'item_inp'))}}<br>
	{{Form::submit('Voeg gebruiker toe', array('class' => 'item_inp'))}}<br>
	{{Form::close()}}
	<button class="submit_input" style="background-color: #FF5252;color: #fff" onclick="confirmBox.TouchDelete('deze groep', '{{URL::to($organisation->id."/delete")}}', 
	function(){window.location.replace({{URL::to('groepen')}})})">Verwijder groep</button>
	<a class="button submit_input" href="{{URL::to('/boodschappenlijsten')}}">Terug</a>
@stop