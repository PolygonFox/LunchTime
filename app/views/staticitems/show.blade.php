@extends('layouts.base')

@section('title')
Standaard Items
@stop
@section("head")
		<script type="text/javascript" src="{{URL::asset('js/Confirm.js')}}"></script>
		<script type="text/javascript" src="{{URL::asset('js/EditTable.js')}}"></script>
		<script type="text/javascript" src="{{URL::asset('js/Staticitems.js')}}"></script>
		<script type="text/javascript" src="{{URL::asset('js/Errors.js')}}"></script>
@stop

@section('content')
	<h1>Standaard items</h1>
	<table class='shoppinglist'>
	<tr><th>Hoeveelheid</td><th>Naam</td><th>Gebruiker</td><th>Verwijderen</td></tr>
	@foreach($staticlist as $i => $item)
	<tr data-id="{{$item->id}}">
		<td>{{$item->amount}}</td>
		<td>{{$item->name}}</td>
		<td>
			@if(isset($item->user->email))
				{{$item->user->email}}
			@else
				-
			@endif
		</td>
		<td><i class="button_delete fa fa-2x fa-trash sudo-button"></i></td>
	</tr>
	@endforeach
</table>
	{{Form::text('amount', null, array('placeholder' => 'Hoeveelheid', 'class' => 'input_amount'))}}
	{{Form::text('New_item', null, array('placeholder' => 'Nieuw Item', 'class' => 'input_newname'))}}
	<i class="button_add fa fa-2x fa-plus-square sudo-button"></i>
@stop
	