<?php
	
	session_start();

	$pathname = $_SERVER['REQUEST_URI'];
	$linksucces = str_replace("toevoegen/confirm/", "", $pathname);
	$linkerror = str_replace("/confirm/", "", $pathname)


	if(isset($_POST["artikel_toevoegen"]))
	{
		try
		{

			$db = new PDO('mysql:host=localhost;dbname=modrewrite', 'root', 'admin');
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
				header("location: " . preg_replace('/([^:])(\/{2,})/', '$1/', $linksucces));

			}
			else // $isinserted geeft false terug wanneer deze leeg is
			{
				$_SESSION["notification"]["type"] = "error";
				$_SESSION["notification"]["message"] = "Het artikel kon niet worden toegevoegd." . $statement->errorInfo()[2];
				header('location: ' . preg_replace('/([^:])(\/{2,})/', '$1/', $linkerror));
			}
			
		}

		catch(Exception $e)
		{
			$_SESSION["notification"]["type"] = "error";
			$_SESSION["notification"]["message"] = "Er is iets mis met de database: " . $e->getMessage(); 
			header('location: ' . preg_replace('/([^:])(\/{2,})/', '$1/', $linkerror));
		}
	}
	else
	{
		header("location: " . preg_replace('/([^:])(\/{2,})/', '$1/', $linkerror));
	}

?>