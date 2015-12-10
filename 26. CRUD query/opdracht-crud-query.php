<?php
	
	$message = false; // zoals errorMessage bij errorhandling
	static $counter = 1; // static blijft ook zijn waarde behouden als je het optelt; 
	try
	{
		$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', 'admin'); // Connectie maken met DB bieren en username rot en password admin
		$queryString = 'SELECT * FROM bieren /* selecteer alles van bieren */
						INNER JOIN brouwers /* gelinkt aan brouwers (zie github document) */
						ON bieren.brouwernr = brouwers.brouwernr /* gemeenschappelijk id zoeken */
						WHERE bieren.naam LIKE "du%" /* naam van bier moet beginnen met du → enkel procent op einde */
						AND brouwers.brnaam LIKE "%a%"'; /* brouwernaam moet a bevatten → procent teken langs beide kanten */

		$statement = $db->prepare($queryString);

		// query uitvoeren
		$statement->execute();

		//de waarden in een variabele steken. Je hebt zowel de tabelnaam als de values nodig → associative array (tabelnaam => value);
		$fetchAssoc = array(); // hierin komt een assoc array van db bieren → (tabelnaam => values)

		while ( $row = $statement->fetch(PDO::FETCH_ASSOC) ) // de waarden uit onze db halen
		{
			$fetchAssoc[]	=	$row; // de waarden in de array steken.
		}

	}
	catch(PDOException $e)
	{
		$message['type'] = "error";
		$message['text'] = "Er is iets mis met de database: " . $e->getMessage(); ;
	}
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>CRUD query</title>
</head>
<body>
	<h1>Overzicht van de bieren</h1>
	<!-- <p><?php var_dump($fetchAssoc) ?></p>
	<p><?= var_dump($error)?></p> -->
	<p class="fout"><?= ($message) ? $message["text"] : "" ?></p>
	<table>
		<thead>
			<tr>
				<th>#</th>
				<?php foreach($fetchAssoc[0] as $key => $value) : ?> <!-- mag ook [1], [2],... zijn: Je neemt de eerste array en daarvan altijd de key (=kolomnaam) -->
					<th><?= $key ?></th>
				<?php endforeach ?>
			</tr>	
		</thead>
		<tbody>
			<?php foreach($fetchAssoc as $key => $array) : ?> <!-- $fetchAssoc bestaat uit 4 arrays dus $array is een array → weer foreach </var> -->
				<tr> <!-- elke array in een nieuwe tr -->
					<td><?= $counter ?></td>
					<?php foreach($array as $arraykey => $value) : ?> <!-- met $arraykey = 4 keer de kolomnamen, en $value = de waarden → moeten we hebben -->
						<td><?= $value ?></td>
					<?php endforeach ?>
					<?php $counter++; ?> <!-- waarde optellen kan omdat deze static is-->
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</body>
</html>