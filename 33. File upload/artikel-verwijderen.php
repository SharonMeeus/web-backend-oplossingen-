<?php

	if(isset($_GET["artikel"]))
	{
		try
		{
			$id = $_GET["artikel"];

			$db = new PDO('mysql:host=localhost;dbname=fileupload', 'root', 'admin');

			$query = "UPDATE artikels SET is_archived = 1 WHERE id = '$id'";
			// Bij een fout id gaat deze gewoon terug naar de overzicht pagina en verandert er niets

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