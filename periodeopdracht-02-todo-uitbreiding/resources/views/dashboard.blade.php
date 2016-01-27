@extends('layout.main');


@section('content')
	
	@if(session('error'))
		<p class="text-danger bg-danger">{{session('error')}}</p>
	@endif
	<h1>Dashboard</h1>
	<p>Check <a href="{{URL::route('todos')}}">hier</a> je todos</p>
	
@stop