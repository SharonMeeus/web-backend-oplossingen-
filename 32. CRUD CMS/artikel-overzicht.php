<?php
	
	session_start();

	$email = "";
	$message = "";

	if(isset($_SESSION["data"]))
	{
		$email = $_SESSION["data"]["emailadres"];
	}

	if(isset($_SESSION["notification"]))
	{
		$message = $_SESSION["notification"]["message"];
		$_SESSION["notification"]["message"] = "";
	}

	if(!isset($_COOKIE["login"])) // Als deze user nog niet heeft ingelogd of heeft uitgelogd, anders is er een cookie
	{
		$_SESSION["notification"]["type"] = "error";
		$_SESSION["notification"]["message"] = "U moet eerst inloggen";
		header('location: login-form.php');
	}
	else
	{
		try
		{
			$db = new PDO('mysql:host=localhost;dbname=CMS', 'root', 'admin');

			$query = "SELECT * FROM artikels";

			$statement = $db->prepare($query);

			// query uitvoeren
			$statement->execute();

			$fetchAssoc = array(); // hierin komt een assoc array → (tabelnaam => values)

			while ( $row = $statement->fetch(PDO::FETCH_ASSOC) ) // de waarden uit onze db halen
			{
				$fetchAssoc[]	=	$row; // de waarden in de array steken.
			}
		}
		catch(Exception $e)
		{
			$_SESSION["notification"]["type"] = "error";
			$_SESSION["notification"]["message"] = "Er is iets mis met de database: " . $e->getMessage(); 
		}

	}

	
?>

<html>
<head>
	<title>Artikels</title>
	<style type="text/css">
		div.inactive
		{
			background-color: #eeeeee;
		}
	</style>
</head>
<body>
	<!-- <p><?= var_dump($fetchAssoc) ?></p> -->
	<p><a href="dashboard.php">Terug naar dashboard</a> | Ingelogd als <?= $email ?> | <a href="logout.php">uitloggen</a></p>
	<h1>Overzicht van de artikels</h1>
	<p><?= $message ?></p>
	<p><a href="artikel-toevoegen-form.php">Voeg een artikel toe</a></p>
	<?php foreach($fetchAssoc as $key => $array) : ?>
		<?php if($array["is_archived"] != 1) : ?>
			<div class="<?= ($array['is_active'] == 1) ? '' : 'inactive'?>">
				<h1><?= $array["titel"]?></h1>
				<ul>
					<li>Artikel: <?= $array["artikel"] ?></li>
					<li>Kernwoorden: <?= $array["kernwoorden"] ?></li>
					<li>Datum: <?= date("d/m/Y", strtotime($array["datum"])) ?></li>
					<p><a href="artikel-wijzigen-form.php?artikel=<?= $array["id"] ?>">artikel wijzigen</a> | 
						<a href="artikel-activeren.php?artikel=<?= $array["id"] ?>"><?= ($array["is_active"] == 1) ? "artikel deactiveren" : "artikel activeren"?></a> | 
						<a href="artikel-verwijderen.php?artikel=<?= $array["id"] ?>">artikel verwijderen</a>
					</p>
				</ul>
			</div>
		<?php endif ?>
	<?php endforeach ?>
	<!-- Artikels -->
</body>
</html>