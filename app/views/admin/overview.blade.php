@extends('layouts.base')

@section('title')
	Beheer
@stop

@section('content')
	<div class="user_man">
		<h2>Gebruikers:</h2>
		<a class="refresh" onClick="window.location.reload()"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Refresh</a><br><br>
		<a href="{{URL::to('beheer/GebruikerToevoegen')}}"><button class="submit_input">Gebruiker Toevoegen</button></a>
		<table class="table-responsive">
			<tr><th>E-Mail</th><th></th><th></th></tr>
			@foreach($users as $user)
			<tr><td>{{$user->email}}</td><td>
				@if($user->admin)
					<i class="fa fa-asterisk "> </i>
				@else
				@endif
				@if($user->blocked == 0)
					</td><td><a href='{{URL::to("beheer/user/{$user->id}/delete")}}'><i class="fa unblock-us fa-user"></i></a></td></tr>
				@else
					</td><td><a href='{{URL::to("beheer/user/{$user->id}/activate")}}'><i class="fa block-us fa-user"></a></td></tr>
				@endif
			@endforeach

		</table>
		<br><p><i class="fa fa-asterisk "></i> = Administrator</p><br>
		<p><i class="fa unblock-us fa-user "></i> = Niet geblokkeerd. Klik op icoon om account te blokkeren</p>
		<p><i class="fa block-us fa-user "></i> = Geblokkeerd. Klik op icoon om account te activeren</p>
	</div>
@stop