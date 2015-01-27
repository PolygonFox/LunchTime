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
			@elseif(Session::has('message'))
				<div>{{ Session::get('message') }}</div>
			@else
				<div>{{$message}}</div>
			@endif
		@endif
	</div>
	<strong>Voeg een gebruiker toe aan uw groep</strong>
	{{Form::open()}}
	{{Form::text('email', null, array('placeholder' => 'E-mail van gebruiker', 'class' => 'item_inp'))}}<br>
	{{Form::submit('Voeg gebruiker toe', array('class' => 'item_inp'))}}<br>
	{{Form::close()}}
	<h5>Leden</h5>
	<ul>
		@foreach($members as $member)
		<li>
			{{$member->user->email}} - @if($member->mod)Beheerder @else Gebruiker @endif
			<button class=""  onclick="confirmBox.TouchDelete('Weet u zeker dat u {{$member->user->email}} @if($member->mod)gebruiker @else beheerder @endif wilt maken?', '{{URL::to($organisation->id."/changerank/".$member->user->id)}}', function(){window.location.replace(document.URL)}, true)">
				@if($member->mod)Maak gebruiker @else Maak beheerder @endif
			</button>
			<button class=""  onclick="confirmBox.TouchDelete('{{$member->user->email}}', '{{URL::to($organisation->id."/deleteuser/".$member->user->id)}}', function(){window.location.replace(document.URL)})">Gebruiker verwijderen</button>
		</li>
		@endforeach
	</ul>
	<button class="submit_input" style="background-color: #FF5252;color: #fff" onclick="confirmBox.TouchDelete('deze groep', '{{URL::to($organisation->id."/delete")}}', function(){window.location.replace('{{URL::to('groepen')}}')})">Groep verwijderen</button>
	<a class="button submit_input" href="{{URL::to('/groepen')}}">Terug</a>
@stop