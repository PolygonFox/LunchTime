@extends('layouts.base')
@section('title')
Boodschappenlijst
@stop
@section("head")
		<script type="text/javascript" src="{{URL::asset('js/Confirm.js')}}"></script>
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
<ul>
	@foreach($shoppinglist->item as $item)
	<li>
		{{$item->amount}}x {{$item->name}} {{$item->user->email}}
		<a href="{{URL::to("boodschappenlijst/{$shoppinglist->id}/item/{$item->id}")}}"><i class="fa fa-pencil"></i>
</a>
		<a href="{{URL::to("boodschappenlijst/{$shoppinglist->id}/item/{$item->id}/verwijderen")}}" onClick="WeetUHetZeker('{{$item->name}}');">Verwijderen</a>
	</li>
	@endforeach
	<li>
		{{Form::open()}}
		{{Form::text('amount', null, array('placeholder' => 'Hoeveel'))}}
		{{Form::text('New_item', null, array('placeholder' => 'Nieuw Item'))}}
		{{Form::submit('Toevoegen'); Form::close();}}
	</li>
</ul>
@stop