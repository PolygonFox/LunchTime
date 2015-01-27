@extends('layouts.base')

@section('title')
	Beheer - Groepen
@stop
@section("head") 
    <script type="text/javascript" src="{{URL::asset('js/Confirm.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/Errors.js')}}"></script>
@stop
@section('content')
	<div class="user_man">
		<h2>Groepen</h2>
		<a class="refresh" onClick="window.location.reload()"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Verversen</a><br><br>
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

    @if(isset($organisations[0]))
    <table>
    	
    		@foreach($organisations as $organisation)
    		<tr>
    			<td>{{$organisation->name}}</td>
    			<td><button class="submit_input" style="background-color: #FF5252;color: #fff" onclick="confirmBox.TouchDelete('deze groep', '{{URL::to($organisation->id."/delete")}}', function(){window.location.replace('{{URL::to('/beheer/groepen')}}')})">Verwijderen</button></td>
    		</tr>	
    		@endforeach
    	
    </table>
    @else
        <p>Er zijn geen groepen op dit moment.</p>
    @endif
	</div>
@stop