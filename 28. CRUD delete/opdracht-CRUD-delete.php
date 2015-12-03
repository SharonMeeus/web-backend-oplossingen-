<?php

// Verwijderen lukt niet?? → Enkel wanneer er geen FK is
	
	session_start();

	$message = false; // zoals errorMessage bij errorhandling
	$confirm_delete = false; 

	try
	{
		$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', 'admin'); // Connectie maken met DB bieren en username rot en password admin
		
		/* Eerst kijken of er iets verwijderd is zodat we de DB kunnen updaten alvorens we de waarden tonen */

		if(isset($_POST["delete"]))
		{

			$confirm_delete = true;
			$_SESSION["brouwernr"] = $_POST["delete"];

		}

		if(isset($_POST["ja"]))
		{

			$delete = 'DELETE FROM brouwers WHERE brouwers.brouwernr = :brouwernr';

			$statement2 = $db->prepare($delete);

			$statement2->bindValue(':brouwernr', $_SESSION["brouwernr"]); // $_POST['delete'] in de waarde :brouwernr steken

			$statement2->execute();

			if (!$statement2->execute()) //statement2 -> execute() geeft true of false terug. Als deze false is, is er iets mis.
			{
        		$message["type"] = "error";
        		$message["text"] = "De datarij kon niet verwijderd worden. Probeer opnieuw.";/*($statement2->errorInfo()[2]); // errorInfo() geeft een array mee, de foutcode zit in het 3e element */
    		}		
    		else
    		{
    			$message["type"] = "gelukt";
    			$message["text"] = "De datarij werd goed verwijderd";
    		}	

    		unset($_SESSION["brouwernr"]);
    		$confirm_delete = false;
    	}

    	elseif(isset($_POST["nee"]))
    	{
    		$confirm_delete = false;
    		unset($_SESSION["brouwernr"]);
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
	<title>CRUD delete</title>
</head>
<body>
	<h1>Overzicht van de brouwers</h1>
	<!--<p><?php var_dump($fetchAssoc) ?></p> 
	<p><?= var_dump($_SESSION["brouwernr"])?></p> --> 
	<p class="fout"><?= ($message) ? $message["text"] : "" ?></p>

	<?php if($confirm_delete) : ?>
		<form action="opdracht-CRUD-delete.php" method="post">
			<label>Bent u zeker dat u deze datarij wil verwijderen?</label><br/>
			<button type="submit" name="ja">Ja!</button>
			<button type="submit" name="nee">Néééééé!</button>
		</form>
	<?php endif ?>

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
					<tr class="<?= (null != $_SESSION['brouwernr'] ? ($_SESSION['brouwernr'] == $array['brouwernr'] ? 'red' : '' ) : '' ) ?>"> <!-- elke array in een nieuwe tr -->
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