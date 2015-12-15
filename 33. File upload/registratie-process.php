<?php

	session_start();

	if(isset($_POST["create_pass"]))
	{
		$newpass = generatePassword();	//paswoord aanmaken via de functie
		$_SESSION["data"]["emailadres"] = $_POST["email"]; //email en paswoord in session steken
		$_SESSION["data"]["paswoord"] = $newpass;
		//Nu terug gaan naar de form met gevulde sessies
		header("location: registratie.php");
	}

	if(isset($_POST["registreer"]))
	{
		$_SESSION["data"]["emailadres"] = $_POST["email"]; // Ook hier onthouden

		$email = $_POST["email"];
		$paswoord = $_POST["paswoord"];

		$result = filter_var( $email, FILTER_VALIDATE_EMAIL ); // geeft true/false terug

		if(!$result) // kijken of email klopt
		{
			$_SESSION["notification"]["type"] = "error";
			$_SESSION["notification"]["message"] = "Dit is geen geldig emailadres";
		}

		elseif(empty($paswoord) || strlen($paswoord) < 5) // kijken of paswoord niet leeg is of minder dan 5 tekens bevat
		{
			$_SESSION["notification"]["type"] = "error";
			$_SESSION["notification"]["message"] = "Gelieve een wachtwoord met minstens 5 tekens in te geven";
		}



		else // beide zijn in orde
		{
			try
			{
				$db = new PDO('mysql:host=localhost;dbname=fileupload', 'root', 'admin');

				$checkstatement = $db->prepare('SELECT * FROM users WHERE email = :email'); //Kijken of we een rij vinden met dit id
				$checkstatement->bindParam(":email", $email);
				$checkstatement->execute();
				$row = $checkstatement->fetch(PDO::FETCH_ASSOC); //kijken of er een array terug werd gegeven

				if($row) // Als email al in de database staat
				{
				    $_SESSION["notification"]["type"] = "error";
					$_SESSION["notification"]["message"] = "Dit emailadres is al geregistreerd.";
				}
				else // anders niet registreren
				{
					$salt = uniqid(mt_rand(), true);
					$saltpass = $salt . $paswoord;
					$hashedpass = hash('sha256', $saltpass);

					$query = "INSERT INTO users(email, salt, hashed_password, last_login_time) 
					  VALUES ('$email', '$salt', '$hashedpass', NOW())"; //variabelen meegeven kan blijkbaar ook, is korter (met dank aan Robin).

					$statement = $db->prepare($query);
					$isinserted = $statement->execute();

					if(!$isinserted)
					{
						$_SESSION["notification"]["type"] = "error";
						$_SESSION["notification"]["message"] = "Er ging iets mis bij het toevoegen..."; //. $statement->errorInfo()[2]
						header('location: registratie.php');
					}

					else
					{
						$_SESSION["notification"]["type"] = "succes";
						$_SESSION["notification"]["message"] = "Gelukt! Je bent nu geregistreerd.";

						$value = $email . ", " . hash('sha256', $email . $salt);
						setcookie("login", $value, time()+86400 * 30);
						header('location: login-form.php');
					}
				}
			}
			catch(Exception $e)
			{
				$_SESSION["notification"]["type"] = "error";
				$_SESSION["notification"]["message"] = "Er is iets mis met de database: " . $e->getMessage(); 
				header('location: registratie.php');
			}
		}
		header('location: registratie.php');
	}

	

	function generatePassword()
	{
		$characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ#!-_*=+:/"; // alle characters dat het wachtwoord kan bevatten
	    $characterslength = strlen($characters);
	    $password = '';
	    for ($i = 0; $i < 8; $i++) {
	        $password .= $characters[rand(0, $characterslength-1)]; // een random character uit $characters halen en deze toevoegen (.=) aan $password
	    }
	    return $password;
	}

?>