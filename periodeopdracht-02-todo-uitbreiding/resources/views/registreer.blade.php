@extends('layout.main');


@section('content')

  <h1>Registreer</h1>

	@foreach ($errors->all() as $error)
		<p class="text-danger">{{ $error }}</p>
	@endforeach

	{{Form::open()}}
  		<div class="form-group">
    		<label for="email adres">Emailadres</label>
    		<input type="email" name="emailadres" class="form-control" id="emailadres" placeholder="Email">
  		</div>
  		<div class="form-group">
    		<label for="paswoord">Paswoord</label>
    		<input type="password" name="paswoord" class="form-control" id="password" placeholder="Wachtwoord">
  		</div>
  		<button type="submit" class="btn btn-default">Registreer</button>
	{{Form::close()}}
	
@stop