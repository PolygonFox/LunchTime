@extends('layouts.main')
@section('vulling')

	    <ul class="navbar-list">
	        <li class="navbar-item">
	            <a href="{{URL::to('/')}}">Home</a>
	        </li>
	        <li class="navbar-item">
	        	{{ Auth::User()->email }}
	        </li>
			<li class="navbar-item">
				<a href="{{URL::to('/')}}">BoodschappenLijsten</a>
			</li>
			<li class="navbar-item">
				<a href="{{URL::to('controleitems')}}">Items Ter Controle</a>
			</li>
			<li class="navbar-item">
				<a href="{{URL::to('standaarditems')}}">Standaard Items</a>
			</li>
			<li class="navbar-item">
				<a href="{{URL::to('account')}}">Mijn Account</a>
			</li>
			@if(Auth::User()->admin)
			<li class="navbar-item">
				<a href="{{URL::to('beheer')}}">Beheer</a>
			</li>
			@endif
			<li class="navbar-item">
				<a href="{{URL::to('logout')}}">Uitloggen</a>
			</li>
		<ul>
<div class="container">
            <div class="one-half column" style="margin-top: 25%">      
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
				@yield('content')
			</div>
		</div>
</div>
@stop