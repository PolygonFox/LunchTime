@extends('layouts.base')

@section('title')
Controle Items
@stop
@section("head")
		<script type="text/javascript" src="{{URL::asset('js/Confirm.js')}}"></script>
		<script type="text/javascript" src="{{URL::asset('js/EditTable.js')}}"></script>

		<script type="text/javascript" src="{{URL::asset('js/Checkitems.js')}}"></script>
		<script type="text/javascript" src="{{URL::asset('js/Errors.js')}}"></script>
@stop

@section('content')
	<h1>Controle Items</h1>
	<table class='table-responsive shoppinglist'>
	<tr><th>Hoeveelheid</td><th>Naam</td></td><th>Toevoegen aan lijst</td></tr>
	@foreach($checklist as $i => $item)
	<tr data-id="{{$item->id}}">
		<td>{{$item->amount}}</td>
		<td>{{$item->name}}</td>	
		<td><i class="button_addtolist fa fa-2x fa-plus-square sudo-button" title="Toevoegen aan Nieuwe Lijst"></i></td>
		<td><i class="button_delete fa fa-2x fa-trash sudo-button" title="Verwijderen"></i></td>
	</tr>
	@endforeach
</table>
		{{Form::text('amount', null, array('placeholder' => 'Hoeveelheid', 'class' => 'input_amount item_inp'))}}<br>
		{{Form::text('New_item', null, array('placeholder' => 'Nieuw Item', 'class' => 'input_newname item_inp'))}}<br>
		<button class="button_add submit_input sudo-button">Voeg Toe!</button>
@stop
	