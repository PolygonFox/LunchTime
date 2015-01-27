@extends('layouts.base')

@section('title')
	Boodschappenlijsten
@stop
@section('content')
	<h1>Boodschappenlijsten</h1>
	{{Form::open(array('url' => URL::to($organisation->id .'/new')))}}
		<p><input type="submit" class="submit_input"value="Maak een nieuwe lijst"/></p>
	{{Form::close()}}
	<ul class='overview'>
		@foreach($shoppinglists as $shoppinglist)
			<li class="shop">
				@if($shoppinglist->locked == 1)
					<i class="fa listlock fa-lock"></i>
				@endif
				<a href='{{URL::to($organisation->id . "/boodschappenlijst/{$shoppinglist->id}")}}'>Boodschappenlijst van:<br>
					<p class="smaller">
						@if($shoppinglist->detailed)
							{{ date('d M Y H:i:s',strtotime($shoppinglist->created_at)) }}
						@else
							{{ date('d M Y',strtotime($shoppinglist->created_at)) }}
						@endif
					</p>
				</a>
			</li>
		@endforeach
	</ul>
	<a class="button submit_input" href="{{URL::to('groepen')}}">Terug naar groepen</a>
@stop
	

