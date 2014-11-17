@extends('layouts.base')
@section('title')
Boodschappenlijsten
@stop
@section("head")
		<script type="text/javascript" src="{{URL::asset('js/Confirm.js')}}"></script>
@stop
@section('content')
			<h1>Maak een nieuw boodschappenlijst</h1>
			{{Form::open(array('url' => URL::to('/new')))}}
				<p><input type="submit" value="Nieuw lijst"/></p>
			{{Form::close()}}
			<ul>
				@foreach($shoppinglists as $shoppinglist)
				<li><a href="{{URL::to("boodschappenlijst/{$shoppinglist->id}")}}">Boodschappenlijst van {{ date('d M Y',strtotime($shoppinglist->created_at)) }}</a></li>
				@endforeach
			</ul>
@stop