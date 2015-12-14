<?php
	
	session_start();

	$email = "";
	$message = "";

	if(isset($_SESSION["data"]))
	{
		$email = $_SESSION["data"]["emailadres"];
	}
	if(isset($_SESSION["notification"]))
	{
		$message = $_SESSION["notification"]["message"];
		$_SESSION["notification"]["message"] = "";
	}
?>

<html>
<head>
	<title>Artikel toevoegen</title>
</head>
<body>
	<p><a href="dashboard.php">Terug naar dashboard</a> | Ingelogd als <?= $email ?> | <a href="logout.php">uitloggen</a></p>
	<p><a href="artikel-overzicht.php">Terug naar overzicht</a></p>
	<h1>Artikel Toevoegen</h1>
	<p><?= $message ?></p>
	<form action="artikel-toevoegen-process.php" method="post">
		<label>Titel</label><br/>
		<input type="text" name="titel"/><br/>
		<label>Artikel</label><br/>
		<input type="textarea" name="artikel"/><br/>
		<label>Kernwoorden</label><br/>
		<input type="text" name="kernwoorden"/><br/>
		<label>Datum</label><br/>
		<input type="date" name="datum"/><br/>
		<button type="submit" name="artikel_toevoegen">Artikel toevoegen</button>
	</form>
</body>
</html>