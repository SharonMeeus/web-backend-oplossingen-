@extends('layout.main')

@section('content')

	<h1>Voeg een todo-item toe</h1>

	@foreach ($errors->all() as $error)
		<p class="text-danger">{{ $error }}</p>
	@endforeach
	
	<p class="text-left">
		<small><a href="{{URL::route('todos')}}">Terug naar mijn todos</a></small>
	</p>

	{{Form::open()}}
		<div class="form-group">
			<label for="name">Wat moet er gedaan worden?</label>
			<input class="form-control" type="text" id="name" name="name" placeholder="Je todo" />
		</div>
		<button type="submit" class="btn btn-default">Toevoegen!</button>
		
	{{Form::close()}}
@stop