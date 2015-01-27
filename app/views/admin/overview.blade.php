@extends('layouts.base')

@section('title')
	Beheer
@stop

@section('content')
	<div class="user_man">
		<a class="refresh" onClick="window.location.reload()"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Verversen</a><br><br>
		<a href="{{URL::to('beheer/groepen')}}"><button class="submit_input">Groepen overzicht</button></a>
		<h2>Gebruikers:</h2>
		@if(!isset($disableMessages))
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
    @endif
		<table class="table-responsive">
			<tr><th>E-mail</th><th></th><th></th></tr>
			@foreach($users as $user)
			<tr><td>{{$user->email}}</td><td>
				@if($user->admin)
					<a href='{{URL::to("beheer/user/{$user->id}/makeuser")}}'><i class="fa fa-asterisk "></i></a>
				@else
					<a href='{{URL::to("beheer/user/{$user->id}/makeadmin")}}'>Maak<br> beheerder</a>
				@endif
				@if($user->blocked == 0)
					</td><td><br><a href='{{URL::to("beheer/user/{$user->id}/delete")}}'><i class="fa unblock-us fa-user"></i></a></td></tr>
				@else
					</td><td><br><a href='{{URL::to("beheer/user/{$user->id}/activate")}}'><i class="fa block-us fa-user"></a></td></tr>
				@endif
			@endforeach
		</table>
		<a href="{{URL::to('beheer/GebruikerToevoegen')}}"><button class="submit_input">Gebruiker Toevoegen</button></a>

		<br><p><i class="fa fa-asterisk "></i> = Beheerder, klik op het sterretje om hem weer een gebruiker te maken.</p>
		<p><i class="fa unblock-us fa-user "></i> = Niet geblokkeerd. Klik op icoon om account te blokkeren.</p>
		<p><i class="fa block-us fa-user "></i> = Geblokkeerd. Klik op icoon om account te activeren.</p><br>
	</div>
@stop