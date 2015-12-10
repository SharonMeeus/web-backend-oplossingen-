<?php

	$message = false;

	try
	{
		$ordertable = "";
		$orderdirection = "";

		$queryString = "SELECT bieren.biernr, 
							   bieren.naam,
							   brouwers.brnaam,
							   soorten.soort,
							   bieren.alcohol
						FROM bieren
						INNER JOIN brouwers
						ON bieren.brouwernr = brouwers.brouwernr
						INNER JOIN soorten
						ON bieren.soortnr = soorten.soortnr";

		if(isset($_GET["order_by"]))
		{
			$arrayorder = explode("-", $_GET["order_by"]);
			$ordertable = $arrayorder[0];
			$orderdirection = $arrayorder[1];
			$queryString = $queryString . " " . "ORDER BY " . $ordertable . " " . $orderdirection;   
		}

		$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', 'admin');

		$statement = $db->prepare($queryString);

		// query uitvoeren
		$statement->execute();

		$fetchAssoc = array(); // hierin komt een assoc array van db bieren → (tabelnaam => values)

		while ( $row = $statement->fetch(PDO::FETCH_ASSOC) ) // de waarden uit onze db halen
		{
			$fetchAssoc[]	=	$row; // de waarden in de array steken.
		}

	}
	catch(Exception $e)
	{
		$message['type'] = "error";
		$message['text'] = "Er is iets mis met de database: " . $e->getMessage(); ;
	}
?>
<html>
<head>
	<title>CRUD - order by</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<h1>Overzicht van de bieren</h1>
	<p class="fout"><?= ($message) ? $message["text"] : "" ?></p>

	<form action="opdracht-crud-update.php" method="get">
		<table>
			<thead>
				<tr>
					<?php foreach($fetchAssoc[0] as $key => $value) : ?> <!-- mag ook [1], [2],... zijn: Je neemt de eerste array en daarvan altijd de key (=kolomnaam) -->
						<th class="order <?= ($key == $ordertable) ? $orderdirection . "ending" : "descending" ?>"><a href="opdracht-crud-query-orderby.php?order_by=<?= $key ?>-<?= ($orderdirection == "desc") ? "asc" : "desc" ?>"><?= $key ?></a></td>
					<?php endforeach ?>
				</tr>	
			</thead>
			<tbody>
				<?php foreach($fetchAssoc as $key => $array) : ?> 
					<tr> <!-- elke array in een nieuwe tr -->
						<?php foreach($array as $arraykey => $value) : ?>
							<td><?= $value ?></td>
						<?php endforeach ?>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</form>
</body>
</html>