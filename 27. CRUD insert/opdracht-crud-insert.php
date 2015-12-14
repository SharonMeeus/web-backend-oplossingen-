<?php

	$message = false; // zoals errorMessage bij errorhandling
	$brouwerijnr = 0;
	$x = true;
	try
	{
		$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', 'admin'); // Connectie maken met DB bieren en username rot en password admin

		if(isset($_POST['submit']))
		{
		
			$query = 'INSERT INTO brouwers(brnaam, adres, postcode, gemeente, omzet) 
					  VALUES (:brnaam, :adres, :postcode, :gemeente, :omzet)';

			$statement = $db->prepare($query);

			//alle waardes van de get linken
			$statement->bindValue(':brnaam', $_POST['brnaam']); 
			$statement->bindValue(':adres', $_POST['adres']);
			$statement->bindValue(':postcode', $_POST['postcode']);
			$statement->bindValue(':gemeente', $_POST['gemeente']);
			$statement->bindValue(':omzet', $_POST['omzet']);

			$isinserted = $statement->execute(); // wordt nu sowieso uitgevoerd

			$brouwerijnr = $db->lastInsertId(); // de id verkrijgen van de brouwerij die je net hebt ingevoerd. Moet dus NA execute komen

			if($isinserted)
			{
				$message["type"] = "gelukt";
				$message["text"] = "Brouwerij succesvol toegevoegd. Het unieke nummer van deze brouwerij is " . $brouwerijnr;
			}
			else
			{
				$message["type"] = "error";
				$message["text"] = "Er ging iets mis met het toevoegen. Probeer opnieuw";
			}
		}
	}
	catch(PDOException $e)
	{
		$message['type'] = "error";
		$message['text'] = "Er is iets mis met de database: " . $e->getMessage(); ;
	}
?>

<html>
<head>
	<title>CRUD insert</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<h1>Voeg een brouwer toe</h1>
	<p class="fout"><?= ($message) ? $message["text"] : "" ?></p>
	<form action="opdracht-crud-insert.php" method="post">
		<label>Brouwernaam</label> <br/>
		<input type="text" name="brnaam" /><br/>
		<label>adres</label><br/>
		<input type="text" name="adres"><br/>
		<label>postcode</label><br/>
		<input type="text" name="postcode"/><br/>
		<label>gemeente</label><br/>
		<input type="text" name="gemeente"/><br/>
		<label>omzet</label><br/>
		<input type="text" name="omzet"/><br/>
		<button name="submit" type="submit">Verzenden</button>
	</form>
</body>
</html>