@extends('layouts.base')

@section('title') Maak nieuwe groep aan 

@stop

@section("head") 
    <script type="text/javascript" src="{{URL::asset('js/Confirm.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/Errors.js')}}"></script>
@stop

@section('content')
	<h1>Nieuwe groep maken</h1>
	<div class='messages_bar'>
		@if(isset($message))
			@if(is_array($message))
				@foreach($message as $msg)
					<div>{{$msg}}</div>
				@endforeach
			@elseif(is_object($message))
				@foreach($message->all() as $msg)
					<div>{{$msg}}</div>
				@endforeach
			@else
				<div>{{$message}}</div>
			@endif
		@endif
	</div>
	{{Form::open()}}
	{{Form::text('name', null, array('placeholder' => 'Groep naam', 'class' => 'item_inp'))}}<br>
	{{Form::submit('Maak nieuwe groep', array('class' => 'item_inp'))}}<br>
	{{Form::close()}}
	<a class="button submit_input" href="{{URL::to('/boodschappenlijsten')}}">Terug</a>
@stop