<?php
	
	session_start();

	$paswoord = "";
	$email = "";
	$message = "";

	if(isset($_SESSION["data"])) // kijken of deze session er is
	{
		$paswoord = $_SESSION["data"]["paswoord"]; // alles toewijzen
		$email = $_SESSION["data"]["emailadres"];
		$_SESSION["data"]["paswoord"] = ""; // nadat het wachtwoord is toegewezen, terug op "" zetten zodat bij een refresh het veld weer leeg is
	}

	if(isset($_SESSION["notification"]))
	{
		$message = $_SESSION["notification"]["message"]; // error message
	}

	if(isset($_COOKIE["login"]))
	{
		header('location: dashboard.php'); // als deze user al heeft ingelogd (en niet heeft uitgelogd) mag deze direct naar het dashboard
	}

?>
<html>
<head>
	<title>Security login</title>
</head>
<body>
	<h1>Registreren</h1>
	<p><?= $message ?></p>
	<form action="registratie-process.php" method="post">
		<label>e-mail</label><br/>
		<input type="text" name="email" value="<?= $email ?>"><br/>
		<label>paswoord</label><br/>
		<input type="<?= ($paswoord != "") ? "text" : "password" ?>" name="paswoord" value="<?= $paswoord ?>"><button type="submit" name="create_pass">Genereer een paswoord</button><br/>
		<button type="submit" name="registreer">Registreer</button>

	</form>
</body>
</html>