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
	<h1>Standaarditems</h1>
	<p class="descr">Items die altijd gekocht moeten worden.</p>
	<a class="refresh" onClick="window.location.reload()"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Verversen</a><br><br>
	<table class='u-full-width shoppinglist'>
	<thead>
		<tr>
			<th>Hoeveelheid</th>
			<th>Naam</th>
			<th></th>
		<tr>
	</thead>
	<tbody>
	@foreach($staticlist as $i => $item)
	<tr data-id="{{$item->id}}">
		<td>{{$item->amount}}</td>
		<td>{{$item->name}}</td>
		<td><i class="button_delete fa fa-2x fa-trash sudo-button"></i></td>
	</tr>
	@endforeach
</tbody>
</table>
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
		<h3>Item toevoegen</h3>
		{{Form::text('amount', null, array('placeholder' => 'Hoeveelheid', 'class' => 'input_amount item_inp'))}}<br>
		{{Form::text('New_item', null, array('placeholder' => 'Nieuw item', 'class' => 'input_newname item_inp'))}}<br>
		<button class="button_add submit_input sudo-button">Toevoegen</button>
@stop
	