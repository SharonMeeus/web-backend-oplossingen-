<?php

	if(isset($_GET["artikel"])) //kijken of er in de url artikel is meegegeven
	{
		try
		{
			$id = $_GET["artikel"];

			$db = new PDO('mysql:host=localhost;dbname=fileupload', 'root', 'admin');

			$query = "UPDATE artikels SET is_active = 1 - is_active WHERE id = '$id'"; //Het artikel togglen (1 - (db)1 = 0, 1 - (db)0 = 1)
			// Bij een fout id gaat deze gewoon terug naar de pagina en verandert er niets
			$statement = $db->prepare($query);
			$statement->execute();

			header("location: artikel-overzicht.php");
		}
		catch(Exception $e)
		{
			$_SESSION["notification"]["type"] = "error";
			$_SESSION["notification"]["message"] = "Er is iets mis met de database: " . $e->getMessage(); 
			header("location: artikel-overzicht.php");
		}
	}
	else
	{
		header("location: artikel-overzicht.php");
	}
?>