@extends('layouts.base')

@section('title')
	Boodschappenlijsten
@stop
@section('content')

			<h1>Boodschappenlijstjes</h1>
			{{Form::open(array('url' => URL::to('/new')))}}
				<p><input type="submit" class="submit_input"value="Maak een nieuwe lijst"/></p>
			{{Form::close()}}
			<ul class='overview'>
				@foreach($shoppinglists as $shoppinglist)
				<li class="shop"><a href="{{URL::to("boodschappenlijst/{$shoppinglist->id}")}}">Boodschappenlijst van:<br>
					<p class="smaller">
					@if($shoppinglist->detailed)
						{{ date('d M Y H:i:s',strtotime($shoppinglist->created_at)) }}
					@else
						{{ date('d M Y',strtotime($shoppinglist->created_at)) }}
					@endif
				</p>
				</a>
				@endforeach
			</ul>
@stop
	

