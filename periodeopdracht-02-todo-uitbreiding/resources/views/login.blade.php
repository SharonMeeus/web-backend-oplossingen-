@extends('layout.main');


@section('content')
  
  @if(session('error'))
    <p class="text-danger bg-danger">{{session('error')}}</p>
  @endif
  
	<h1>Meld je aan</h1>

	@foreach ($errors->all() as $error)
		<p class="text-danger">{{ $error }}</p>
	@endforeach

	{{Form::open()}}
  		<div class="form-group">
    		<label for="emailadres">Email adres</label>
    		<input type="email" name="emailadres" class="form-control" id="emailadres" placeholder="Email">
  		</div>
  		<div class="form-group">
    		<label for="password">Paswoord</label>
    		<input type="password" name="paswoord" class="form-control" id="password" placeholder="Wachtwoord">
  		</div>
  		<button type="submit" class="btn btn-default">Inloggen</button>
	{{Form::close()}}
	
@stop