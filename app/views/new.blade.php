@extends('layouts.base')

@section('content')
			<h1>Maak en nieuw boodschappenlijst</h1>
			
		
			
			{{Form::open()}}

			<p><input type="submit" value="Nieuw lijst"/></p>

			{{Form::close()}}

			<ul>
				@foreach($shoppinglists as $shoppinglist)
				<li>{{$shoppinglist->created_at}}</li>
				@endforeach
			</ul>

@stop
	

