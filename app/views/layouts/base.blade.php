@extends('layouts.main')
@section('vulling')
<div class="container">
	
	    <ul class="navbar-list"><div class="navbar-container">
	        <li class="navbar-item">
	            <a href="{{URL::to('/')}}">Home</a>
	        </li>
			<li class="navbar-item">
				<a href="{{URL::to('boodschappenlijsten')}}">BoodschappenLijsten</a>
			</li>
			<li class="navbar-item">
				<a href="{{URL::to('controleitems')}}">Items Ter Controle</a>
			</li>
			<li class="navbar-item">
				<a href="{{URL::to('standaarditems')}}">Standaard Items</a>
			</li>
			<li class="navbar-item">
				<p class="name">{{ Auth::User()->email }}</p>
				<ul>
					<li class="navbar-item-sub"><a href="{{URL::to('account')}}">Mijn Account</a></li>
					<li class="navbar-item-sub"><a href="{{URL::to('logout')}}">Uitloggen</a></li>
				</ul>
			</li>
			@if(Auth::User()->admin)
			<li class="navbar-item">
				<a href="{{URL::to('beheer')}}">Beheer</a>
			</li>
			@endif
			<li class="navbar-item">
				
			</li>	</div>
		</ul>

    <div class="one-half column">      
    	
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
@stop