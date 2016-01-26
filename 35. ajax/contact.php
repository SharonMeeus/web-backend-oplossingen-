<?php
	
	session_start();

	//klasse laden
	function __autoload($className) {
	  require_once('classes/' . $className . '.php');
	}

	$mail1 = new Mail("sharon.meeus@gmail.com", "ajax");

	if(isset($_POST["verzenden"]))
	{
		if(isset($_POST["email"]) && isset($_POST["boodschap"])) // kijken of beide velden iets bevatten
		{
			$admin = "sharon.meeus@gmail.com";
			$mail = $_POST["email"];
			$boodschap = $_POST["boodschap"];

			if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) //checken of email geldig is, als dit niet zo is → error terugsturen
			{
				$_SESSION["notification"]["type"] = "error";
				$_SESSION["notification"]["message"] = "Gelieve een geldig emailadres in te geven";
				header("location: contact-form.php");
			}
			else
			{

				try // anders toevoegen aan database
				{
					$db = new PDO("mysql:host=localhost;dbname=mail", "root", "admin");
					$query = "INSERT INTO contact_messages (email, message, time_sent) 
							  VALUES ('$mail', '$boodschap', NOW())";
					$statement = $db->prepare($query);
					$isinserted = $statement->execute();

					if(!$isinserted)
					{
						$_SESSION["notification"]["type"] = "error";
						$_SESSION["notification"]["message"] = "Er ging iets mis bij het toevoegen..."; //. $statement->errorInfo()[2]
						header('location: contact-form.php');
					}

					else // als toevoegen gelukt is:
					{
						$header = "From: " . $mail;
						$boodschap = str_replace("\n", "\n\r", $boodschap); // zorgen dat er line breaks in mail zijn

						if(isset($_POST["kopie"]) && $_POST["kopie"] == "ja") // kijken of kopie is aangevinkt
						{
							mail( $mail, "Kopie Php contact mail", $boodschap, $header); 
						}

						$send = mail( $admin, "Php contact mail", $boodschap, $header); // mail naar admin sturen (mezelf)

						if(!$send) // als dat niet gelukt is → error message en session met data terug sturen
						{
							$error = error_get_last();
							$_SESSION["notification"]["type"] = "error";
							$_SESSION["notification"]["message"] = "Het bericht werd niet verstuurd.";
							$_SESSION["data"]["email"] = $mail;
							$_SESSION["data"]["boodschap"] = $boodschap;
							header('location: contact-form.php');
						}
						else // wel gelukt → session unsetten voor lege velden
						{
							$_SESSION["notification"]["type"] = "succes";
							$_SESSION["notification"]["message"] = "Het bericht werd verstuurd.";

							unset($_SESSION["data"]);
							header('location: contact-form.php');
						}
					}
				}
				catch(Exception $e) // bij error database
				{
					$_SESSION["notification"]["type"] = "error";
					$_SESSION["notification"]["message"] = "Er is iets mis met onze database. Gelieve opnieuw te proberen." . $e->getMessage();
					$_SESSION["data"]["email"] = $_POST["email"];
					$_SESSION["data"]["boodschap"] = $_POST["boodschap"];
					header("location: contact-form.php");
				}
			}
		}
		else // als er een veld werd opengelaten
		{
			$_SESSION["notification"]["type"] = "error";
			$_SESSION["notification"]["message"] = "Gelieve geen enkel veld (email en boodschap) open te laten";
			header("location: contact-form.php");
		}
	}
?>