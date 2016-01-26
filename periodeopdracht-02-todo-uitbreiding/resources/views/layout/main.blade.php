<!doctype html>
<html>
<head>
	<title>Our Todo Application</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="{{url('/home')}}"> Home <span class="sr-only"></span></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      	@if(Auth::guest())
  		<li><a href="{{url('/login')}}">Login</a></li>
  		<li><a href="{{url('/registreer')}}">Registreer</a></li>
  		@else
  		<li><a href="{{url('/dashboard')}}">Dashboard</a></li>
  		<li><a href="{{url('/todos')}}">Todos</a></li>
      <li><a href="{{url('/logout')}}">Logout ({{Auth::user()->emailadres}})</a></li>
  		@endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container-fluid">
  	<div class="row">
  	  	<div class="col-md-4"></div>
	  	<div class="col-md-4">@yield('content')</div>
	  	<div class="col-md-4"></div>
	</div>
</div>
</body>
</html>