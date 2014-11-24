@extends('layouts.main')
@section('vulling')

        <!-- Sidebar -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="{{URL::to('/')}}">LunchTime</a>
        </li>
        <li class="email">
        	{{ Auth::User()->email }}
        </li>
		<li>
			<a href="{{URL::to('/')}}">Overzicht</a>
		</li>
		<li>
			<a href="{{URL::to('controleitems')}}">Controle Items</a>
		</li>
		<li>
			<a href="{{URL::to('standaarditems')}}">Standaard Items</a>
		</li>
		<li>
			<a href="{{URL::to('account')}}">Mijn Account</a>
		</li>
		@if(Auth::User()->admin)
		<li>
			<a href="{{URL::to('beheer')}}">Beheer</a>
		</li>
		@endif
		<li>
			<a href="{{URL::to('logout')}}">Uitloggen</a>
		</li>
	<ul>
</div>
<!-- /#sidebar-wrapper -->

<!-- Page Content -->
<div id="page-content-wrapper">
	<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
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
</div>
@stop