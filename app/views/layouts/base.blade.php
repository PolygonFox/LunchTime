@extends('layouts.main')
@section('vulling')
<div class="container">
	
	    <ul class="navbar-list"><div class="navbar-container">
			<li class="navbar-item">
				<a href="{{URL::to('boodschappenlijsten')}}">Boodschappenlijsten</a>
			</li>
			<li class="navbar-item">
				<a href="{{URL::to('controleitems')}}">Items ter controle</a>
			</li>
			<li class="navbar-item">
				<a href="{{URL::to('standaarditems')}}">Standaarditems</a>
			</li>
						@if(Auth::User()->admin)
			<li class="navbar-item">
				<a href="{{URL::to('beheer')}}">Beheer</a>
			</li>
			@endif
			<li class="navbar-item">
				<p>Mijn Account</p>
				<ul>
					<li><p>{{ Auth::User()->email }}</p></li>
					<li class="navbar-item-sub"><a href="{{URL::to('account')}}">Beheer mijn account</a></li>
					<li class="navbar-item-sub"><a href="{{URL::to('logout')}}">Uitloggen</a></li>
				</ul>
			</li>

	</div>
		</ul>

    <div class="one-half column">      
    	
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
    	@yield('content')
	</div>
</div>
@stop