@extends('layout.main');


@section('content')

	<h1>Meld je aan</h1>

	@foreach ($errors->all() as $error)
		<p class="error">{{ $error }}</p>
	@endforeach

	{{Form::open()}}
  		<div class="form-group">
    		<label for="emailadres">Email adres</label>
    		<input type="email" name="emailadres" class="form-control" id="emailadres" placeholder="Email">
  		</div>
  		<div class="form-group">
    		<label for="password">Paswoord</label>
    		<input type="password" name="password" class="form-control" id="password" placeholder="Wachtwoord">
  		</div>
  		<button type="submit" class="btn btn-default">Inloggen</button>
	{{Form::close()}}
	
@stop