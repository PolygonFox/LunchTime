@extends('layouts.base')

@section('title')
Controle Items
@stop

@section('content')
	<h1>Controle items.</h1>
	{{Form::open()}}
	{{Form::text('amount', null, array('placeholder' => 'Hoeveel'))}}
	{{Form::text('new_item', null, array('placeholder' => 'Nieuw Item'))}}
	{{Form::submit('Toevoegen'); Form::close();}}<br>
	@foreach ($checklist as $check)
		{{$check['amount'];}} {{$check['name'];}} - {{$check['user']['email'];}} 
		<a href="{{URL::asset('/controleitems/del/'.$check['id'])}}">Verwijderen</a> 
		<a href="{{URL::asset('/controleitems/add/'.$check['id'])}}">Voeg toe aan lijst</a><br>
	@endforeach

@stop
	