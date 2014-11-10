@extends('layouts.base')

@section('title')
Boodschappenlijst
@stop

@section('content')
<h1>Boodschappenlijst van {{ date('d M Y',strtotime($shoppinglist->created_at)) }}</h1>
<ul>
	@foreach($shoppinglist->item as $item)
	<li>
		{{$item->amount}}x {{$item->name}}
		<a href="{{URL::to("boodschappenlijst/{$shoppinglist->id}/item/{$item->id}")}}">Wijzigen</a>
		<a href="{{URL::to("boodschappenlijst/{$shoppinglist->id}/item/{$item->id}/verwijderen")}}">Verwijderen</a>
	</li>
	@endforeach
	<li>{{Form::open()}}{{Form::text('amount', null, array('placeholder' => 'Hoeveel'))}}{{Form::text('New_item', null, array('placeholder' => 'Nieuw Item'))}}{{Form::submit('Toevoegen'); Form::close();}}</li>
</ul>
@stop