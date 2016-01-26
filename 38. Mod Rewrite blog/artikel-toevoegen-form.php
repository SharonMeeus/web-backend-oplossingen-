<?php
	
	session_start();

	$message = "";
	$pathname = $_SERVER['REQUEST_URI'];
	$backlink = chop($pathname, "/toevoegen/");
	$confirmlink = $pathname . "confirm/";

	if(isset($_SESSION["notification"]))
	{
		$message = $_SESSION["notification"]["message"];
		$_SESSION["notification"]["message"] = "";
	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8"> 
	<title>Artikel toevoegen</title>
</head>
<body>
	<p><a href="<?= preg_replace('/([^:])(\/{2,})/', '$1/', $backlink) ?>">Terug naar overzicht</a></p>
	<h1>Artikel Toevoegen</h1>
	<p><?= $message ?></p>
	<form action="<?= preg_replace('/([^:])(\/{2,})/', '$1/', $confirmlink) ?>" method="post">
		<label>Titel</label><br/>
		<input type="text" name="titel"/><br/>
		<label>Artikel</label><br/>
		<textarea name="artikel"></textarea><br/>
		<label>Kernwoorden</label><br/>
		<input type="text" name="kernwoorden"/><br/>
		<label>Datum</label><br/>
		<input type="date" name="datum"/><br/>
		<button type="submit" name="artikel_toevoegen">Artikel toevoegen</button>
	</form>
</body>
</html>