@extends('layouts.base')

@section('title')
Item wijzigen
@stop

@section('content')
<h1>Item wijzigen</h1>
		{{Form::open()}}
		{{Form::text('amount', $item->amount, array('placeholder' => 'Hoeveel'))}}<br>
		{{Form::text('name', $item->name, array('placeholder' => 'Nieuw Item'))}}<br>
		{{Form::submit('Wijzig item'); Form::close();}}
@stop