<?php 
	
	session_start();

	$showcontent = false;
	$message = "";
	$email = "";
	$tumbnail = "";

	if(isset($_SESSION["notification"]))
	{
		$message = $_SESSION["notification"]["message"];
	}

	if(!isset($_COOKIE["login"])) // Als deze user nog niet heeft ingelogd of heeft uitgelogd, anders is er een cookie
	{
		$_SESSION["notification"]["type"] = "error";
		$_SESSION["notification"]["message"] = "U moet eerst inloggen";
		header('location: login-form.php');
	}
	else
	{
		$cookie = explode(", ", $_COOKIE["login"]); // de mail en de gehashte code splitsen en in een $cookie array steken
		$usermail = $cookie[0];
		$saltmail = $cookie[1];

		try 
		{
			$db = new PDO('mysql:host=localhost;dbname=fileupload', 'root', 'admin');	
			$statement = $db->query("SELECT * FROM users WHERE users.email = '$usermail'"); // De salt van de gebruiker uit de database halen
			$statement->execute();

			$fetchAssoc = array(); // hierin komt een assoc array → (tabelnaam => values)

			while ( $row = $statement->fetch(PDO::FETCH_ASSOC) ) // de waarden uit onze db halen
			{
				$fetchAssoc[]	=	$row; // de waarden in de array steken.
			}

			foreach ($fetchAssoc as $key => $array) {

				$tumbnail = $array["profile_picture"];
				$_SESSION["data"]["profielfoto"] = $array["profile_picture"];
				$salt = $array["salt"];
				if(hash('sha256', $usermail . $salt) == $saltmail) // checken of de cookie klopt aan de hand van deze salt
				{
					$_SESSION["data"]["emailadres"] = $usermail;
					$email = $usermail;
					$showcontent = true;
				}
				else // anders is ermee geknoeid
				{
					unset($_COOKIE["login"]);
					header('location: login-form.php');
				}
				
			}

			
		} 
		catch (Exception $e)
		{
			$_SESSION["notification"]["type"] = "error";
			$_SESSION["notification"]["message"] = "Er is iets mis met de database. Probeer eventueel later opnieuw.";	
			header('location: login-form.php');
		}
	}
?>

<html>
<head>
	<title>Dashboard</title>
	<style type="text/css">
		.tumb
		{
			max-height: 50px;
			vertical-align: middle;
			margin-right: 10px;
		}
	</style>
</head>
<body>
	<?php if($showcontent) : ?>
		<p><img class="tumb" src="img/<?= ($tumbnail != "") ? $tumbnail : "elon-musk-koraynergiz.jpg" ?>"> Ingelogd als <?= $email ?> | <a href="logout.php">uitloggen</a></p>
		<h1>Dashboard</h1>
		<p><?= $message ?></p>
		<ul>
			<li><a href="artikel-overzicht.php">Artikels</a></li>
			<li><a href="gegevens-wijzigen-form.php">Gegevens wijzigen</a></li>
		</ul>
	<?php endif ?>
</body>
</html>