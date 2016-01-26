<?php
	
	session_start();

	$message = "";
	$searchquery = "";
	$noarticles = "";
	$pathname = $_SERVER['REQUEST_URI'];
	
	//checken wat van de link af mag
	$pos = strpos($pathname, "artikels/"); // positie van woord artikels/ zoeken
	$endpoint = $pos + strlen("artikels/");
	$linkoverzicht = substr($pathname,0,$endpoint);


	if(isset($_SESSION["notification"]))
	{
		$message = $_SESSION["notification"]["message"];
		$_SESSION["notification"]["message"] = "";
	}
	//Checken of er geen lege zoekterm is ingegeven (trim is om spaties weg te halen)
	if(isset($_GET["zoekterm"]) && trim($_GET["zoekterm"]) != "" )
	{
		try
		{
			$searchquery = $_GET["zoekterm"];

			$db = new PDO('mysql:host=localhost;dbname=modrewrite', 'root', 'admin');

			$query = "SELECT * FROM artikels WHERE Artikel LIKE '%" . $searchquery . "%'";

			$statement = $db->prepare($query);

			// query uitvoeren
			$statement->execute();

			$fetchAssoc = array(); // hierin komt een assoc array → (tabelnaam => values)

			while ( $row = $statement->fetch(PDO::FETCH_ASSOC) ) // de waarden uit onze db halen
			{
				$fetchAssoc[]	=	$row; // de waarden in de array steken.
			}

			if(count($fetchAssoc) < 1)
			{
				$noarticles = "Er werden geen artikels gevonden.";
			}
		}
		catch(Exception $e)
		{
			$_SESSION["notification"]["type"] = "error";
			$_SESSION["notification"]["message"] = "Er is iets mis met de database: " . $e->getMessage(); 
		}
	}

	elseif(isset($_GET["zoekjaar"]))
	{
		if(is_numeric($_GET["zoekjaar"]) && (int)$_GET["zoekjaar"] >= 2000  && (int)$_GET["zoekjaar"] < 2017)
		{
			try
			{
				$searchquery = $_GET["zoekjaar"];

				$db = new PDO('mysql:host=localhost;dbname=modrewrite', 'root', 'admin');

				$query = "SELECT * FROM artikels WHERE Datum LIKE '%" . $searchquery . "%'";

				$statement = $db->prepare($query);

				// query uitvoeren
				$statement->execute();

				$fetchAssoc = array(); // hierin komt een assoc array → (tabelnaam => values)

				while ( $row = $statement->fetch(PDO::FETCH_ASSOC) ) // de waarden uit onze db halen
				{
					$fetchAssoc[]	=	$row; // de waarden in de array steken.
				}

				if(count($fetchAssoc) < 1)
				{
					$noarticles = "Er werden geen artikels gevonden.";
				}

			}
			catch(Exception $e)
			{
				$_SESSION["notification"]["type"] = "error";
				$_SESSION["notification"]["message"] = "Er is iets mis met de database: " . $e->getMessage(); 
				header("Location: " . preg_replace('/([^:])(\/{2,})/', '$1/', $linkoverzicht));
			}
		}
		else
		{
			$_SESSION["notification"]["type"] = "error";
			$_SESSION["notification"]["message"] = "Gelieve een jaar tussen 2000 en 2016 in te geven.";
			header("Location: " . preg_replace('/([^:])(\/{2,})/', '$1/', $linkoverzicht));
		}
	}
	else
	{
		$_SESSION["notification"]["type"] = "error";
		$_SESSION["notification"]["message"] = "Gelieve een zoekterm in te geven.";
		header("Location: " . preg_replace('/([^:])(\/{2,})/', '$1/', $linkoverzicht));
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Artikel zoeken</title>

	<style type="text/css">
		body
		{
			position: absolute;
			left: 25%;
			right: 25%;
			top: 25px;
		}
		article ul
		{
			list-style: none;
			padding-left: 0;
		}
	</style>
</head>
<body>
	<p><a href="<?= preg_replace('/([^:])(\/{2,})/', '$1/', $linkoverzicht)?>">Terug naar overzicht</a></p>
	<?= $message ?>
	<form action=<?= preg_replace('/([^:])(\/{2,})/', '$1/', $linkoverzicht . "zoeken/") ?> method="get">
		<label>Zoeken in artikels:</label><br/>
		<input type="text" name="zoekterm">
		<button type="submit">Zoeken</button>
	</form>
	<form action=<?= preg_replace('/([^:])(\/{2,})/', '$1/', $linkoverzicht . "zoeken/") ?> method="get">
		<label>Zoeken op datum:</label><br/>
		<select name="zoekjaar">

			<?php // om de jaren in te stellen (vanaf 2000 - 2016)
				for($i=2000; $i<=2016; $i++)
				{
				    echo "<option name='jaar' value=".$i.">".$i."</option>";
				}
			?>  

		</select> 
		<button type="submit">Zoeken</button>
	</form>

	<h1>Artikels <?= isset($_GET["zoekterm"]) ? " die het/de woord(en) &#34;" . ucfirst($searchquery) . "&#34; bevatten" : "van het jaar " . $searchquery ?></h1>
	<?= $noarticles ?>
	<?php foreach($fetchAssoc as $key => $array) : ?>
			<article>
				<h1><?= $array["Titel"]?> &#124; <?= date("d/m/Y", strtotime($array["Datum"])) ?></h1>
				<hr>
				<ul>
					<li><?= $array["Artikel"] ?></li>
					<br/>
					<li>Keywords: <?= $array["Kernwoorden"] ?></li>
				</ul>
			</article>
	<?php endforeach ?>
</body>
</html>