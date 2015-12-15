<?php
	
	session_start();

	if(isset($_POST["artikel_toevoegen"]))
	{
		try
		{

			$db = new PDO('mysql:host=localhost;dbname=fileupload', 'root', 'admin');
			$query = "INSERT INTO artikels(titel, artikel, kernwoorden, datum) 
					  VALUES (:titel, :artikel, :kernwoorden, :datum)";

			$statement = $db->prepare($query);

			//alle waardes van de post linken
			$statement->bindValue(':titel', $_POST['titel']); 
			$statement->bindValue(':artikel', $_POST['artikel']);
			$statement->bindValue(':kernwoorden', $_POST['kernwoorden']);
			$statement->bindValue(':datum', $_POST["datum"]);

			$isinserted = $statement->execute(); // wordt nu sowieso uitgevoerd

			if($isinserted) //als het toegevoegd werd
			{
				$_SESSION["notification"]["type"] = "succes";
				$_SESSION["notification"]["message"] = "Het artikel werd succesvol toegevoegd.";
				header("location: artikel-overzicht.php");

			}
			else // $isinserted geeft false terug wanneer deze leeg is
			{
				$_SESSION["notification"]["type"] = "error";
				$_SESSION["notification"]["message"] = "Het artikel kon niet worden toegevoegd." . $statement->errorInfo()[2];
				header('location: artikel-toevoegen-form.php');
			}
			
		}

		catch(Exception $e)
		{
			$_SESSION["notification"]["type"] = "error";
			$_SESSION["notification"]["message"] = "Er is iets mis met de database: " . $e->getMessage(); 
			header('location: artikel-toevoegen-form.php');
		}
	}
	else
	{
		header("location: artikel-toevoegen-form.php");
	}

?>