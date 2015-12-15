<?php
	
	session_start();

	if(isset($_COOKIE["login"]))
	{
		if (isset($_POST['gegevens_wijzigen'])) 
		{
			if ((($_FILES["profielfoto"]["type"] == "image/gif")
			|| ($_FILES["profielfoto"]["type"] == "image/jpeg")
			|| ($_FILES["profielfoto"]["type"] == "image/png"))
			&& ($_FILES["profielfoto"]["size"] < 2000000)) 
			{
				if ($_FILES["profielfoto"]["error"] > 0) 
				{
					// bij een fout/error
					$_SESSION["notification"]["type"] = "error";
					$_SESSION["notification"]["message"] = "Er is iets mis met het bestand.";
					header("location: gegevens-wijzigen-form.php");
				} 
				else 
				{
					// De root van het bestand moet achterhaald worden om de absolute pathnaam (de plaats op de schijf van de server) te achterhalen
					// Zo weet de server waar het bestand moet terecht komen.
					// We kunnen dit doen door de functie dirname() toe te passen op dit bestand (=__FILE__)
					define('ROOT', dirname(__FILE__));
					
					do // Naam toewijzen en dit blijven doen tot er geen file is met dezelfde naam
					{
						$_FILES["profielfoto"]["name"] = time() . "_" . $_FILES["profielfoto"]["name"];
					} 
					while(file_exists(ROOT . "/img/" . $_FILES["profielfoto"]["name"]));

					//Het bestand uploaden naar de map
					move_uploaded_file($_FILES["profielfoto"]["tmp_name"], (ROOT . "/img/" . $_FILES["profielfoto"]["name"]));
					
					try
					{
						$cookie = explode(", ", $_COOKIE["login"]);

						$db = new PDO('mysql:host=localhost;dbname=fileupload', 'root', 'admin');
						//eerst checken of dit email beschikbaar is
						$checkstatement = $db->prepare('SELECT * FROM users WHERE email = :email'); //Kijken of we een rij vinden met dit id
						$checkstatement->bindParam(":email", $_POST["email"]);
						$checkstatement->execute();
						$row = $checkstatement->fetch(PDO::FETCH_ASSOC); //kijken of er een array terug werd gegeven

						unlink("img/" . $row["profile_picture"]);

						if($row && $_POST["email"] != $cookie[0]) // Als email al in de database staat
						{
						    $_SESSION["notification"]["type"] = "error";
							$_SESSION["notification"]["message"] = "Dit emailadres is al geregistreerd.";
						}
						else // anders niet registreren
						{
							$query = "UPDATE users 
									  SET email = :email,
									  profile_picture = :profielfoto
									  WHERE email = :oldemail";

							$statement=$db->prepare($query);
							$statement->bindValue(":email", $_POST["email"]);
							$statement->bindValue(":profielfoto", $_FILES["profielfoto"]["name"]);
							$statement->bindValue(":oldemail", $cookie[0]);

							$statement->execute();

							if(!$statement->execute())
							{
								$_SESSION["notification"]["type"] = "error";
				    			$_SESSION["notification"]["message"] = "Je gegevens konden niet worden gewijzigd. Probeer opnieuw." . $statementupdate->errorInfo()[2];
				    			header("location: gegevens-wijzigen-form.php");
							}

							else
				    		{
				    			$_SESSION["notification"]["type"] = "succes";
				    			$_SESSION["notification"]["message"] = "Je gegevens werden gewijzigd";
				    			$_SESSION["data"]["profielfoto"] = $_FILES["profielfoto"]["name"];
				    			setcookie("login", "", time()-3600);
				    			setcookie("login", $_POST["email"] . ", " . $cookie[1]);
				    			header("location: gegevens-wijzigen-form.php");
				    		}
				    	}
					}
					catch(Exception $e)
					{
						$_SESSION["notification"]["type"] = "error";
			    		$_SESSION["notification"]["message"] = "Er is iets mis met de database. Probeer opnieuw.";
			    		header("location: gegevens-wijzigen-form.php");
					}
					
				}
			}
			elseif(!file_exists($_FILES['profielfoto']['tmp_name']) || !is_uploaded_file($_FILES['profielfoto']['tmp_name']))
			{
				$cookie = explode(", ", $_COOKIE["login"]);

				$db = new PDO('mysql:host=localhost;dbname=fileupload', 'root', 'admin');
				$checkstatement = $db->prepare('SELECT * FROM users WHERE email = :email'); //Kijken of we een rij vinden met dit id
				$checkstatement->bindParam(":email", $_POST["email"]);
				$checkstatement->execute();
				$row = $checkstatement->fetch(PDO::FETCH_ASSOC); //kijken of er een array terug werd gegeven

				if($row && $_POST["email"] != $cookie[0]) // Als email al in de database staat en niet hetzelfde is
				{
				    $_SESSION["notification"]["type"] = "error";
					$_SESSION["notification"]["message"] = "Dit emailadres is al geregistreerd.";
					header("location: gegevens-wijzigen-form.php");
				}
				else // anders niet registreren
				{
					$query = "UPDATE users 
							  SET email = :email
							  WHERE email = :oldemail";

					$statement=$db->prepare($query);
					$statement->bindValue(":email", $_POST["email"]);
					$statement->bindValue(":oldemail", $cookie[0]);

					$statement->execute();

					if(!$statement->execute())
					{
						$_SESSION["notification"]["type"] = "error";
		    			$_SESSION["notification"]["message"] = "Je gegevens konden niet worden gewijzigd. Probeer opnieuw." . $statement->errorInfo()[2];
		    			header("location: gegevens-wijzigen-form.php");
					}

					else
		    		{
		    			$_SESSION["notification"]["type"] = "succes";
		    			$_SESSION["notification"]["message"] = "Je gegevens werden gewijzigd";
		    			setcookie("login", "", time()-3600);
		    			setcookie("login", $_POST["email"] . ", " . $cookie[1]);
		    			header("location: gegevens-wijzigen-form.php");
		    		}
		    	}	
			}
			else
			{
				$_SESSION["notification"]["type"] = "error";
	    		$_SESSION["notification"]["message"] = "Je profielfoto moet een png, jpeg of gif zijn kleiner dan 2MB";
				header("location: gegevens-wijzigen-form.php");
			}
			

		}
	}
	else
	{
		header("location: login-form.php");
	}
?>