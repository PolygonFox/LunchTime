@extends('layouts.base')

@section('title')
	Beheer - Groepen
@stop

@section('content')
	<div class="user_man">
		<h2>Groepen</h2>
		<a class="refresh" onClick="window.location.reload()"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Verversen</a><br><br>
		<a href="{{URL::to('beheer')}}">Terug naar beheer</a>
		@if(!isset($disableMessages))
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
    @endif
    <table>
    	
    		@foreach($organisations as $organisation)
    		<tr>
    			<td>{{$organisation->name}}</td>
    			<td><a href='{{URL::to('/')}}' style='color: #000'><i class='fa fa-trash fa-2x'/></a></td>
    		</tr>	
    		@endforeach
    	
    </table>
	</div>
@stop