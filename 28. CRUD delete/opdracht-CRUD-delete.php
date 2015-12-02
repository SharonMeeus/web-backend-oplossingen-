<?php

// Verwijderen lukt niet??
	
	$message = false; // zoals errorMessage bij errorhandling

	try
	{
		$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', 'admin'); // Connectie maken met DB bieren en username rot en password admin
		
		/* Eerst kijken of er iets verwijderd is zodat we de DB kunnen updaten alvorens we de waarden tonen */
		if(isset($_POST["delete"]))
		{
			$delete = 'DELETE FROM brouwers
					   WHERE brouwernr = :brouwernr';

			$statement2 = $db->prepare($delete);

			$statement2->bindValue(':brouwernr', $_POST['delete'] ); // $_POST['delete'] in de waarde :brouwernr steken

			$statement2->execute();

			if (!$statement2->execute()) //statement2 -> execute() geeft true of false terug. Als deze false is, is er iets mis.
			{
        		$message["type"] = "error";
        		$message["text"] = "Fout bij delete: " . ($statement2->errorInfo()[2]); // errorInfo() geeft een array mee, de foutcode zit in het 3e element
    		}		
    		else
    		{
    			$message["type"] = "gelukt";
    			$message["text"] = "Verwijderen gelukt";
    		}	

		}

		$queryString = 'SELECT * FROM brouwers';


		$statement = $db->prepare($queryString);

		// query uitvoeren
		$statement->execute();

		$fetchAssoc = array(); // hierin komt een assoc array van db bieren → (tabelnaam => values)

		while ( $row = $statement->fetch(PDO::FETCH_ASSOC) ) // de waarden uit onze db halen
		{
			$fetchAssoc[]	=	$row; // de waarden in de array steken.
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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>CRUD query</title>
</head>
<body>
	<h1>Overzicht van de brouwers</h1>
	<!--<p><?php var_dump($fetchAssoc) ?></p>
	<p><?= var_dump($_POST["delete"])?></p> -->
	<p class="fout"><?= ($message) ? $message["text"] : "" ?></p>
	<form action="opdracht-CRUD-delete.php" method="post">
		<table>
			<thead>
				<tr>
					<?php foreach($fetchAssoc[0] as $key => $value) : ?> <!-- mag ook [1], [2],... zijn: Je neemt de eerste array en daarvan altijd de key (=kolomnaam) -->
						<td><?= $key ?></td>
					<?php endforeach ?>
					<td>verwijderen</td> <!-- head voor de knoppen -->
				</tr>	
			</thead>
			<tbody>
				<?php foreach($fetchAssoc as $key => $array) : ?> 
					<tr> <!-- elke array in een nieuwe tr -->
						<?php foreach($array as $arraykey => $value) : ?>
							<td><?= $value ?></td>
						<?php endforeach ?>
						<td><button name="delete" value="<?= $array['brouwernr'] ?>" type="submit" class="input-icon-button delete"></button></td> <!-- De delete knop ook toevoegen -->
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</form>
</body>
</html>