<?php
	
	session_start();

	$message = "";
	$pathname = $_SERVER['REQUEST_URI'];
	$base = str_replace("artikel-overzicht.php", "artikels/", $pathname);
	$linktoevoegen = $base . "/toevoegen/";
	$linkzoeken = $base . "/zoeken/";


	if(isset($_SESSION["notification"]))
	{
		$message = $_SESSION["notification"]["message"];
		$_SESSION["notification"]["message"] = "";
	}


	try
	{
		$db = new PDO('mysql:host=localhost;dbname=modrewrite', 'root', 'admin');

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
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Artikels</title>

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
	<form action=<?= preg_replace('/([^:])(\/{2,})/', '$1/', $linkzoeken) ?> method="get">
		<label>Zoeken in artikels:</label><br/>
		<input type="text" name="zoekterm">
		<button type="submit">Zoeken</button>
	</form>
	<form action=<?= preg_replace('/([^:])(\/{2,})/', '$1/', $linkzoeken) ?> method="get">
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
	<h1>Artikels overzicht</h1>
	<hr>
	<p><?= $message ?></p>
	<p><a href="<?= preg_replace('/([^:])(\/{2,})/', '$1/', $linktoevoegen); ?>">Artikel toevoegen</a></p>
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