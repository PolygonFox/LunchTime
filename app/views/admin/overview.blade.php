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
			</td><td><a href='{{URL::to("beheer/user/{$user->id}/delete")}}'>Verwijderen</a></td></tr>
			@endforeach
		</table>
	</div>
@stop