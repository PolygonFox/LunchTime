@extends('layouts.base')

@section('title')
Controle Items
@stop

@section('content')
	<h1>Controle items.</h1>
	<ul>
		<li>
			{{Form::open()}}
			{{Form::text('amount', null, array('placeholder' => 'Hoeveel'))}}
			{{Form::text('New_item', null, array('placeholder' => 'Nieuw Item'))}}
			{{Form::submit('Toevoegen'); Form::close();}}
		</li>
		@foreach ($checklist as $check)
			<li>{{$check['amount'];}}x {{$check['name'];}} - {{$check['user']['email'];}} 
			<a href="{{URL::asset('/controleitems/del/'.$check['id'])}}">Verwijderen</a></li>
		@endforeach
	</ul>

@stop
	