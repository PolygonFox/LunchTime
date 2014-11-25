@extends('layouts.base')

@section('content')
			<h1>Maak een nieuwe boodschappenlijst</h1>	
			{{Form::open(array('url' => URL::to('/new')))}}
				<p><input type="submit" value="Nieuwe lijst"/></p>
			{{Form::close()}}
			<ul class='overview'>
				@foreach($shoppinglists as $shoppinglist)
				<li><a href="{{URL::to("boodschappenlijst/{$shoppinglist->id}")}}">Boodschappenlijst van 
					@if($shoppinglist->detailed)
						{{ date('d M Y H:i:s',strtotime($shoppinglist->created_at)) }}
					@else
						{{ date('d M Y',strtotime($shoppinglist->created_at)) }}
					@endif
				</a></li>
				@endforeach
			</ul>

@stop
	

