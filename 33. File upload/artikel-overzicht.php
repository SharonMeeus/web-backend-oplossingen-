<?php
	
	session_start();

	$email = "";
	$message = "";
	$tumbnail = "";

	if(isset($_SESSION["data"]))
	{
		$email = $_SESSION["data"]["emailadres"];
		$tumbnail = $_SESSION["data"]["profielfoto"];
	}

	if(isset($_SESSION["notification"]))
	{
		$message = $_SESSION["notification"]["message"];
		$_SESSION["notification"]["message"] = "";
	}

	try
	{
		$db = new PDO('mysql:host=localhost;dbname=fileupload', 'root', 'admin');

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
?>

<html>
<head>
	<title>Artikels</title>
	<style type="text/css">
		div.inactive
		{
			background-color: #eeeeee;
		}
		.tumb
		{
			max-height: 50px;
			vertical-align: middle;
			margin-right: 10px;
		}
	</style>
</head>
<body>
	<!-- <p><?= var_dump($fetchAssoc) ?></p> -->
	<p><img class="tumb" src="img/<?= ($tumbnail != "") ? $tumbnail : "elon-musk-koraynergiz.jpg"  ?>"> Ingelogd als <?= $email ?> | <a href="dashboard.php">Terug naar dashboard</a> | <a href="logout.php">uitloggen</a></p>
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