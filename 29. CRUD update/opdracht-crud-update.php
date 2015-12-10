<?php

// Verwijderen lukt enkel wanneer er geen FK is
	
	session_start();

	$message = false; // zoals errorMessage bij errorhandling
	$confirm_delete = false; 
	$show_update = false;
	$class = "";

	try
	{
		$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', 'admin'); // Connectie maken met DB bieren en username root en password admin
		
		/* Eerst kijken of er iets verwijderd is zodat we de DB kunnen updaten alvorens we de waarden tonen */

		if(isset($_POST["delete"]))
		{
			$class = "red"; // voor een rode achtergrond bij de aangeduide rij
			$confirm_delete = true; // zorgen dat het confirmatie-bericht getoond wordt
			$_SESSION["brouwernr"] = $_POST["delete"]; // brouwernr onthouden

		}

		if(isset($_POST["edit"]))
		{
			$checkstatement = $db->prepare('SELECT * FROM brouwers WHERE brouwernr = :brouwernr'); //Kijken of we een rij vinden met dit id
			$checkstatement->bindParam(":brouwernr", $_POST["edit"]);
			$checkstatement->execute();
			$row = $checkstatement->fetch(PDO::FETCH_ASSOC); //kijken of er een array terug werd gegeven

			if( ! $row) // er werd geknoeid met het id. Deze bestaat niet (false)
			{
			    $message["text"] = "Deze brouwerij werd niet gevonden";
			}
			else
			{
				$class = "green";
				$show_update = true;
				$_SESSION["brouwernr"] = $_POST["edit"];
			}
		}

		if(isset($_POST["wijzigen"]))
		{	
			$update = 'UPDATE brouwers 
					   SET brnaam = :brnaam,
					   adres = :adres,
					   postcode = :postcode,
					   gemeente = :gemeente,
					   omzet = :omzet 
					   WHERE brouwernr = :brouwernr';

			$statementupdate = $db->prepare($update);
			$statementupdate->bindValue(':brnaam', $_POST["brnaam"]);
			$statementupdate->bindValue(':adres', $_POST["adres"]);
			$statementupdate->bindValue(':postcode', $_POST["postcode"]);
			$statementupdate->bindValue(':gemeente', $_POST["gemeente"]);
			$statementupdate->bindValue(':omzet', $_POST["omzet"]);
			$statementupdate->bindValue(':brouwernr', $_POST["hiddenbrouwernr"]); //hidden field 

			$statementupdate->execute();

			if(!$statementupdate->execute())
			{
				$message["type"] = "error";
    			$message["text"] = "Deze brouwer kon niet worden gewijzigd. Probeer opnieuw.";
			}

			else
    		{
    			$message["type"] = "gelukt";
    			$message["text"] = "Deze brouwer werd gewijzigd";
    		}
		    	
		}

		if(isset($_POST["ja"]))
		{

			$delete = 'DELETE FROM brouwers WHERE brouwers.brouwernr = :brouwernr';

			$statement2 = $db->prepare($delete);

			$statement2->bindValue(':brouwernr', $_SESSION["brouwernr"]); // $_SESSION["brouwernr"] in de waarde :brouwernr steken

			$statement2->execute();

			if (!$statement2->execute()) //statement2 -> execute() geeft true of false terug. Als deze false is, is er iets mis.
			{
        		$message["type"] = "error";
        		$message["text"] = "De datarij kon niet worden verwijderd. Probeer opnieuw.";/*($statement2->errorInfo()[2]); // errorInfo() geeft een array mee, de foutcode zit in het 3e element */
    		}		
    		else
    		{
    			$message["type"] = "gelukt";
    			$message["text"] = "De datarij werd goed verwijderd";
    		}	

    		unset($_SESSION["brouwernr"]); // brouwernr vergeten
    		$confirm_delete = false; // confirmatie-bericht niet meer tonen
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
	<title>CRUD update en delete</title>
</head>
<body>
	<?php if($show_update) : ?> <!-- Kijken of er op een edit button geklikt is  -->
		<?php foreach($fetchAssoc as $key => $array) : ?>
				<?php if($array["brouwernr"] == $_POST["edit"]) : ?> 
					<h1>Brouwerij <?= $array["brnaam"] ?> (#<?= $_POST["edit"]?>)</h1>

					<form action="opdracht-crud-update.php" method="post">
						<label>Brouwernaam</label> <br/>
						<input type="text" name="brnaam" value="<?= $array["brnaam"] ?>" /><br/>
						<label>adres</label> <br/>
						<input type="text" name="adres" value="<?= $array["adres"] ?>" /> <br/>
						<label>postcode</label> <br/>
						<input type="text" name="postcode" value="<?= $array["postcode"] ?>" /> <br/>
						<label>gemeente</label> <br/>
						<input type="text" name="gemeente" value="<?= $array["gemeente"] ?>" /> <br/>
						<label>omzet</label> <br/>
						<input type="text" name="omzet" value="<?= $array["omzet"] ?>" /> <br/>
						<input type="hidden" name="hiddenbrouwernr" value="<?= $array["brouwernr"] ?>">
						<button type="submit" name="wijzigen">Verzenden</button> <br/>
					</form>
				<?php endif ?>
		<?php endforeach ?>
	<?php endif ?>
	<h1>Overzicht van de brouwers</h1>
	<p class="fout"><?= ($message) ? $message["text"] : "" ?></p>

	<?php if($confirm_delete) : ?>
		<form action="opdracht-crud-update.php" method="post">
			<label>Bent u zeker dat u deze datarij wil verwijderen?</label><br/>
			<button type="submit" name="ja">Ja!</button>
			<button type="submit" name="nee">Néééééé!</button>
		</form>
	<?php endif ?>

	<form action="opdracht-crud-update.php" method="post">
		<table>
			<thead>
				<tr>
					<?php foreach($fetchAssoc[0] as $key => $value) : ?> <!-- mag ook [1], [2],... zijn: Je neemt de eerste array en daarvan altijd de key (=kolomnaam) -->
						<th><?= $key ?></th>
					<?php endforeach ?>
					<th>verwijderen/wijzigen</th> <!-- head voor de knoppen -->
				</tr>	
			</thead>
			<tbody>
				<?php foreach($fetchAssoc as $key => $array) : ?> 
					<tr class="<?= (null != $_SESSION['brouwernr'] ? ($_SESSION['brouwernr'] == $array['brouwernr'] ? $class : '' ) : '' ) ?>"> <!-- elke array in een nieuwe tr -->
						<?php foreach($array as $arraykey => $value) : ?>
							<td><?= $value ?></td>
						<?php endforeach ?>
						<td>
							<button name="delete" value="<?= $array['brouwernr'] ?>" type="submit" class="input-icon-button delete"></button>
							<button name="edit" value="<?= $array['brouwernr'] ?>" type="submit" class="input-icon-button edit"></button>
						</td> <!-- De delete knop en de edit knop toevoegen -->
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</form>
</body>
</html>