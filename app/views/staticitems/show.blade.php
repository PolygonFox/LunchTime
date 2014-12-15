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
	<a class="refresh" onClick="window.location.reload()"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Refresh</a><br><br>
	<table class='table-responsive shoppinglist'>
	<tr><th>Hoeveelheid</td><th>Naam</td>
	@foreach($staticlist as $i => $item)
	<tr data-id="{{$item->id}}">
		<td>{{$item->amount}}</td>
		<td>{{$item->name}}</td>
		<td><i class="button_delete fa fa-2x fa-trash sudo-button"></i></td>
	</tr>
	@endforeach
</table>
		{{Form::text('amount', null, array('placeholder' => 'Hoeveelheid', 'class' => 'input_amount item_inp'))}}<br>
		{{Form::text('New_item', null, array('placeholder' => 'Nieuw Item', 'class' => 'input_newname item_inp'))}}<br>
		<button class="button_add submit_input sudo-button">Voeg Toe!</button>
@stop
	