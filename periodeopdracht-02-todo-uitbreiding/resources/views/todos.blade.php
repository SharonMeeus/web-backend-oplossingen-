@extends('layout.main');


@section('content')

<h1>Jouw todo-items </h1>
	
	@if($todos->isEmpty())
	<p>Je hebt nog geen todo-items <small>(<a href="{{URL::route('new')}}">Maak een nieuwe todo aan</a>)</small></p>
	@else
	<small>(<a href="{{URL::route('new')}}">Maak een nieuwe todo aan</a>)</small>

	<ul class="list-group">
		<h2>Todo</h2>
		@foreach($todos as $todo)
			@if(!$todo->done)
	        	<li class="list-group-item">  
		        	{{Form::open()}}     
			            <input onClick="this.form.submit()" type="checkbox" {{ $todo->done ? 'checked' : ''}} />
			            {{ e($todo->nametodo) }} <small>(<a href="{{URL::route('delete', $todo->id)}}")>x</a>)</small>
			            <input type="hidden" name="id" value="{{ $todo->id }}" /> 
		            {{Form::close()}}
	        	</li>
        	@endif
        @endforeach
        <h2>Done</h2>
        @foreach($todos as $todo)
        	@if($todo->done)
        	<li class="list-group-item">  
	        	{{Form::open()}}     
		            <input onClick="this.form.submit()" type="checkbox" {{ $todo->done ? 'checked' : ''}} />
		            {{ e($todo->nametodo) }} <small>(<a href="{{URL::route('delete', $todo->id)}}")>x</a>)</small>
		            <input type="hidden" name="id" value="{{ $todo->id }}" /> 
	            {{Form::close()}}
        	</li>
        	@endif
        @endforeach
		
	</ul>
	@endif

@stop