<?php
	
	session_start();

	$message = "";
	$email = "";

	if(isset($_SESSION["notification"]))
	{
		$message = $_SESSION["notification"]["message"];
		unset($_SESSION["notification"]);
	}

	if(isset($_SESSION["data"])) // kijken of deze session er is
	{
		$email = $_SESSION["data"]["emailadres"];
	}

	if(isset($_COOKIE["login"]))
	{
		header('location: dashboard.php');
	}

?>

<html>
<head>
	<title>Login</title>
</head>
<body>
	<h1>Inloggen</h1>

	<p><?= $message ?></p>
	<form action="login-process.php" method="post">
		<label>e-mail</label><br/>
		<input type="text" name="email" value="<?= $email ?>"><br/>
		<label>paswoord</label><br/>
		<input type="password" name="paswoord">
		<button type="submit" name="inloggen">Inloggen</button>
	</form>
	<p>Nog geen account? Maak er eentje aan op de <a href="registratie.php">registratiepagina</a></p>
</body>
</html>