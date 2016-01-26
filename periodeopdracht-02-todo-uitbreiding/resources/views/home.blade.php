@extends('layout.main');


@section('content')

	<h1>Welkom op onze To Do Pagina!</h1>

	@if(Auth::guest())
	<p>Gelieve je in te loggen of te registreren om een todo lijst aan te maken of te wijzigen</p>
	@else
	<p>Click op het tablad <b>Todos</b> om je todo-items te bekijken of te wijzigen</p>
	@endif
	
@stop