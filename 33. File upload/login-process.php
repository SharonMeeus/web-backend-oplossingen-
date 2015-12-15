<?php
	
	session_start();

	if(isset($_POST["inloggen"]))
	{
		$_SESSION["data"]["emailadres"] = $_POST["email"];
		$email = $_POST["email"];
		$paswoord = $_POST["paswoord"];
	}
	
	try
	{
		$db = new PDO('mysql:host=localhost;dbname=fileupload', 'root', 'admin');

		$checkstatement = $db->prepare('SELECT * FROM users WHERE email = :email'); //Kijken of we een rij vinden met dit id
		$checkstatement->bindParam(":email", $email);
		$checkstatement->execute();
		$row = $checkstatement->fetch(PDO::FETCH_ASSOC); //kijken of er een array terug werd gegeven

		if(!$row) // Als email niet in de database staat
		{
		    $_SESSION["notification"]["type"] = "error";
			$_SESSION["notification"]["message"] = "Dit emailadres werd niet gevonden. Gelieve je te registreren.";
			header("location: login-form.php");
		}
		else
		{
			//Er is sowieso maar een rij dat je terug kan krijgen. Row bevat een associative array met als key de kolomnamen.
			$salt = $row["salt"];
			$hashed_password = $row["hashed_password"];

			if(hash('sha256', $salt . $paswoord) == $hashed_password) // kijken of het ingevoerde wachtwoord klopt.
			{
				$value = $email . ", " . hash('sha256', $email . $salt); // als dit klopt moeten we een cookie aanmaken
				setcookie("login", $value, time()+86400 * 30);
				header("location: dashboard.php"); // en doorverwijzen naar dashboard
			}
			else
			{
				// Anders verwijzen we terug naar de login pagina met een foutmelding
				$_SESSION["notification"]["type"] = "error";
				$_SESSION["notification"]["message"] = "U gaf een fout paswoord, gelieve opnieuw te proberen.";
				header("location: login-form.php");
			}
		}
	}
	catch (Exception $e)
	{
		$_SESSION["notification"]["type"] = "error";
		$_SESSION["notification"]["message"] = "Er is iets mis met de database. Probeer eventueel later opnieuw.";	
	}
?>