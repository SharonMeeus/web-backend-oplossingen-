<?php
	
	session_start();

	$showcontent = false;
	$error = "";

	if(isset($_SESSION["notification"]))
	{
		$error = $_SESSION["notification"]["message"];
	}

	if(isset($_GET["artikel"])) 
	{
		$id = $_GET["artikel"];

		$db = new PDO('mysql:host=localhost;dbname=fileupload', 'root', 'admin');

		$statement = $db->prepare("SELECT * FROM artikels WHERE id = '$id'");
		$statement->execute();
		$row = $statement->fetch(PDO::FETCH_ASSOC); //kijken of er een array terug werd gegeven

		if( ! $row) // er werd geknoeid met het id. Deze bestaat niet (false)
		{
		    $error = "Dit artikel werd niet gevonden";
		}
		else
		{
			$showcontent = true;
		}
	}
	else
	{
		header("location: artikel-overzicht.php");
	}
?>

<html>
<head>
	<title>Artikel wijzigen</title>
</head>
<body>
	<h1>Artikel wijzigen</h1>
	<p><?= $error ?></p>
	<?php if($showcontent) : ?>
		<form action="artikel-wijzigen.php" method="post">
			<input type="hidden" name="id" value="<?= $row["id"] ?>">
			<label>Titel</label><br/>
			<input type="text" name="titel" value="<?= $row["titel"] ?>"/><br/>
			<label>Artikel</label> <br/>
			<input type="textarea" name="artikel" value="<?= $row["artikel"] ?>"/><br/>
			<label>Kernwoorden</label><br/>
			<input type="text" name="kernwoorden" value="<?= $row["kernwoorden"] ?>"/><br/>
			<label>Datum</label><br/>
			<input type="date" name="datum" value="<?= $row["datum"] ?>"/><br/>
			<button type="submit" name="artikel_wijzigen">Artikel_wijzigen</button>
		</form>
	<?php endif ?>
</body>
</html>