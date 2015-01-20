@extends('layouts.main')
@section('vulling')
<div class="container">
	
	    <ul class="navbar-list"><div class="navbar-container">
			<a href="{{URL::to('boodschappenlijsten')}}">
				<li class="navbar-item">
					Boodschappenlijsten
				</li>
			</a>
			<a href="{{URL::to('controleitems')}}">
				<li class="navbar-item">
					Items ter controle
				</li>
			</a>
			<a href="{{URL::to('standaarditems')}}">	
				<li class="navbar-item">
					Standaarditems
				</li>
			</a>
			@if(Auth::User()->admin)
				<a href="{{URL::to('beheer')}}">
					<li class="navbar-item">
						Beheer
					</li>
				</a>
			@endif
			<li class="navbar-item">
				<p>Mijn Account</p>
				<ul>
					<li class="navbar-item-sub"><p>{{ Auth::User()->email }}</p></li>
					<li class="navbar-item-sub"><a href="{{URL::to('account')}}">Beheer mijn account</a></li>
					<li class="navbar-item-sub"><a href="{{URL::to('logout')}}">Uitloggen</a></li>
				</ul>
			</li>

	</div>
		</ul>

    <div class="one-half column">          	
    	@yield('content')
	</div>
</div>
@stop