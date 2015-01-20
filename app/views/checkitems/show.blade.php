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
	<h1>Items ter controle</h1>
	<p class="descr">Items die altijd gecontroleerd in de vooraad moeten voor het boodschappen doen.</p>
	@if(isset($nolist))
	<p class="error">Er staat nog geen boodschappenlijst in het systeem, er zijn functions uitgeschakeld.</p>
	@endif
	<a class="refresh" onClick="window.location.reload()"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Verversen</a><br><br>
			<h3>Item toevoegen</h3>
		{{Form::text('amount', null, array('placeholder' => 'Hoeveelheid', 'class' => 'input_amount item_inp'))}}<br>
		{{Form::text('New_item', null, array('placeholder' => 'Nieuw item', 'class' => 'input_newname item_inp'))}}<br>
		<button class="button_add submit_input sudo-button">Toevoegen</button>
			<div class='messages_bar'>
		@if(isset($message))
			@if(is_array($message))
				@foreach($message as $msg)
					<div>{{$msg}}</div>
				@endforeach
			@else
				<div>{{$message}}</div>
			@endif
		@endif
	</div>
	<table class='table-responsive shoppinglist'>
	<tr><th>Hoeveelheid</td><th>Naam</td></td><th>Voeg toe aan lijst</td></tr>
	@foreach($checklist as $i => $item)
	<tr data-id="{{$item->id}}"
	@if($item->active)
	class="active"
	@endif >
		<td>{{$item->amount}}</td>
		<td>{{$item->name}}</td>	
		<td><i class="button_addtolist fa fa-2x fa-plus-square sudo-button" title="Toevoegen aan nieuwe lijst"></i></td>
		<td><i class="button_delete fa fa-2x fa-trash sudo-button" title="Verwijderen"></i></td>
	</tr>
	@endforeach
</table>
@stop
	