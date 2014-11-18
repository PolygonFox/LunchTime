@extends('layouts.base')
@section('title')
Boodschappenlijst
@stop
@section("head")
		<script type="text/javascript" src="{{URL::asset('js/Confirm.js')}}"></script>
		@if(!$shoppinglist->locked)
			<script type="text/javascript" src="{{URL::asset('js/Shoppinglist.js')}}"></script>
		@else
			<script type="text/javascript" src="{{URL::asset('js/Check.js')}}"></script>
		@endif
		<script type="text/javascript" src="{{URL::asset('js/Errors.js')}}"></script>
@stop
@section('content')
<h1>Boodschappenlijst van {{ date('d M Y',strtotime($shoppinglist->created_at)) }}</h1>
<a href="{{URL::to("boodschappenlijst/lock/{$shoppinglist->id}")}}">
	@if($shoppinglist->locked == 0)
		Vergrendel
	@else
		Ontgrendel
	@endif
</a>
<table class='shoppinglist'>
	<tr><th>Hoeveelheid</td><th>Naam</td><th>Gebruiker</td>
		@if(!$shoppinglist->locked)
		<th>Wijzigen</td><th>Verwijderen</td></tr>
		@endif
	@foreach($shoppinglist->item as $i => $item)
	<tr data-id="{{$item->id}}"

		@if($item->checked && $shoppinglist->locked)
			class="active"
		@endif
		>
		<td>{{$item->amount}}</td>
		<td>{{$item->name}}</td>
		<td>
			@if(isset($item->user->email))
				{{$item->user->email}}
			@else
				-
			@endif
		</td>
		@if(!$shoppinglist->locked)
		<td><i class="button_edit sudo-button fa fa-2x fa-pencil"></i></td>
		<td><i class="button_delete fa fa-2x fa-trash sudo-button"></i></td>
		@endif
	</tr>
	@endforeach
</table>
	@if(!$shoppinglist->locked)
		{{Form::text('amount', null, array('placeholder' => 'Hoeveelheid', 'class' => 'input_amount'))}}
		{{Form::text('New_item', null, array('placeholder' => 'Nieuw Item', 'class' => 'input_newname'))}}
		<i class="button_add fa fa-2x fa-plus-circle sudo-button"></i>
	@endif
@stop