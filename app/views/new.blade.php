@extends('layouts.base')

@section('content')
			<h1>Maak en nieuw boodschappenlijst</h1>
			
		
			
			{{Form::open()}}

			<p><input type="submit" value="Nieuw lijst"/></p>

			{{Form::close()}}

			<ul>
				@foreach($shoppinglists as $shoppinglist)
				<li>{{ date('d.m.Y',strtotime($shoppinglist->created_at)) }}(<a href="{{URL::to('new')}}">Voeg Item Toe</a>)</li>
				@endforeach
			</ul>
@stop
	

