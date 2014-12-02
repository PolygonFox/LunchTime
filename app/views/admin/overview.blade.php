@extends('layouts.base')

@section('title')
	Beheer
@stop

@section('content')
	<div>
		<h2>Gebruikers:</h2>
		<a href="{{URL::to('beheer/GebruikerToevoegen')}}">Gebruiker Toevoegen</a>
		<table>
			<tr><th>E-Mail</th><th>Beheerder</th><th>Verwijderen</th></tr>
			@foreach($users as $user)
			<tr><td>{{$user->email}}</td><td>
				@if($user->admin)
					Ja
				@else
					Nee
				@endif
				@if($user->blocked == 0)
					</td><td><a href='{{URL::to("beheer/user/{$user->id}/delete")}}'>Blokkeer</a></td></tr>
				@else
					</td><td><a href='{{URL::to("beheer/user/{$user->id}/activate")}}'>Activeer</a></td></tr>
				@endif
			@endforeach
		</table>
	</div>
@stop