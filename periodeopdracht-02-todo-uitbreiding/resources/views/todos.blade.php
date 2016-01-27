@extends('layout.main');


@section('content')

<h1>Jouw todo-items </h1>
	
	@if($todos->isEmpty())
	<p>Je hebt nog geen todo-items <small>(<a href="{{URL::route('new')}}">Maak een nieuwe todo aan</a>)</small></p>
	@else
		<small><a href="{{URL::route('new')}}">Maak een nieuwe todo aan</a></small>

		<ul class="list-group">
			<h2>Todo</h2>
			@if($dos > 0)
				@foreach($todos as $todo)
					@if(!$todo->done)
			        	<li class="list-group-item">  
				        	{{Form::open()}}     
					            <label class="undone" onclick="this.form.submit()"><span class="glyphicon glyphicon-check"></span> {{ e($todo->nametodo) }}</label>
				            	<small><a href="{{URL::route('delete', $todo->id)}}" class="glyphicon glyphicon-remove")></a></small>
				            	<input type="hidden" name="id" value="{{ $todo->id }}" /> 	
				            {{Form::close()}}
			        	</li>
		        	@endif
		        @endforeach
	        @else
	        	<p class="text-left">Allright, all done!</p>
	        @endif
	        <h2>Done</h2>
	        @if($dones > 0)
		        @foreach($todos as $todo)
		        	@if($todo->done)
		        	<li class="list-group-item">  
			        	{{Form::open()}}     
				            <label class="done" onclick="this.form.submit()"><span class="glyphicon glyphicon-check"></span> {{ e($todo->nametodo) }}</label>
				            <small><a href="{{URL::route('delete', $todo->id)}}" class="glyphicon glyphicon-remove")></a></small>
				            <input type="hidden" name="id" value="{{ $todo->id }}" /> 
			            {{Form::close()}}
		        	</li>
		        	@endif
		        @endforeach
		    @else
		    	<p class="text-left">Damn, werk aan de winkel...</p>
		    @endif
		</ul>
	@endif

@stop