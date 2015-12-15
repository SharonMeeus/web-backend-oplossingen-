<?php
	
	session_start();

	if(isset($_POST["artikel_wijzigen"]))
	{

		try
		{

			$db = new PDO('mysql:host=localhost;dbname=fileupload', 'root', 'admin');
			$update = 'UPDATE artikels 
						   SET titel = :titel,
						   artikel = :artikel,
						   kernwoorden = :kernwoorden,
						   datum = :datum
						   WHERE id = :id';

			$statementupdate = $db->prepare($update);
			$statementupdate->bindValue(':titel', $_POST["titel"]);
			$statementupdate->bindValue(':artikel', $_POST["artikel"]);
			$statementupdate->bindValue(':kernwoorden', $_POST["kernwoorden"]);
			$statementupdate->bindValue(':datum', $_POST["datum"]);
			$statementupdate->bindValue(':id', $_POST["id"]); //hidden field 

			$statementupdate->execute();

			if(!$statementupdate->execute())
			{
				$_SESSION["notification"]["type"] = "error";
    			$_SESSION["notification"]["message"] = "Dit artikel kon niet worden gewijzigd. Probeer opnieuw." . $statementupdate->errorInfo()[2];
    			header("location: artikel-wijzigen-form.php");
			}

			else
    		{
    			$message["type"] = "gelukt";
    			$message["text"] = "Dit artikel werd gewijzigd";
    			header("location: artikel-overzicht.php");
	    		}
	    }
	    catch(Exception $e)
	    {
	    	$_SESSION["notification"]["type"] = "error";
    		$_SESSION["notification"]["message"] = "Er is iets mis met de database. Probeer opnieuw.";
    		header("location: artikel_wijzigen-form.php");
	    }
	}
	else
	{
		header("location: artikel_wijzigen-form.php");
	}
?>