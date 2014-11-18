@extends('layouts.main')

@section('title')
Wachtwoord Resetten
@stop

@section('vulling')
<div class="changepasscontent">
<h1>Wachtwoord Resetten</h1>
<p>Om je wachtwoord te resetten moet je uw emailadres invullen en op verstuur drukken.</p>
{{Form::open()}}
{{Form::email('email')}}
{{Form::submit('Verstuur')}}
{{Form::close()}}
</div>

@stop