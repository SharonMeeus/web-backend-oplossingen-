<?php
	
	$message = false; // zoals errorMessage bij errorhandling
	$showtable = false;
	static $counter = 1; // static blijft ook zijn waarde behouden als je het optelt; 

	try
	{
		$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', 'admin'); // Connectie maken met DB bieren en username rot en password admin
		$queryString = 'SELECT brouwers.brouwernr, brouwers.brnaam FROM brouwers'; 
		$statement = $db->prepare($queryString);

		// query uitvoeren
		$statement->execute();

		//de waarden in een variabele steken.
		$fetchAssoc = array(); // hierin komt een assoc array van db bieren → (tabelnaam => values)

		while ( $row = $statement->fetch(PDO::FETCH_ASSOC) ) // de waarden uit onze db halen
		{
			$fetchAssoc[]	=	$row; // de waarden in de array steken.
		}

		if(isset($_GET['brouwernr']))
		{
			$queryString2 = 'SELECT bieren.naam FROM bieren 
							 WHERE bieren.brouwernr = :brouwernr';

			$statement2 = $db->prepare($queryString2);

			$statement2->bindValue(':brouwernr', $_GET['brouwernr'] ); // $_GET['brouwernr'] in de waarde :brouwernr steken

			$statement2->execute();

			$fetchBieren = array();

			while($row = $statement2->fetch(PDO::FETCH_ASSOC))
			{
				$fetchBieren[] = $row;
			}

			$showtable = true;
		}

		// Een query uitvoeren
		

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
	<title>CRUD query - deel 2</title>
</head>
<body>
	<!--<p><?php var_dump($fetchBieren) ?></p>
	<p><?= var_dump($_GET['brouwernr'])?></p>
	<p><?= var_dump($message)?></p> -->
	<p class="fout"><?= ($message) ? $message["text"] : "" ?></p>
	<form action="opdracht-crud-query-deel2.php" method="get">
		<select name="brouwernr"> <!-- adhv de name de value van de option getten -->
			<?php foreach($fetchAssoc as $key => $array) : ?> <!-- je krijgt arrays terug met als key brnaam of brouwernr, we willen de waarden van brnaam in onze option en brouwernr als value om hierdoor te kunnen linken met de brouwernr van bieren -->
				<option value="<?= $array['brouwernr'] ?>" <?= (isset($_GET['brouwernr']) ? ($_GET['brouwernr'] == $array['brouwernr'] ? "selected" : "") : "" ) ?>> <!-- als de gesubmitte brouwernr overeenkomt met de huidige brouwernr vd array → deze selecteren zodat deze zichtbaar blijft -->
					<?= $array['brnaam'] ?>
				</option>
			<?php endforeach ?>
		</select>
		<input type="submit" value="Geef mij alle bieren van deze brouwerij" />
	</form>
	<?php if($showtable) : ?>
		<table>
			<thead>
			<tr>
				<td>Aantal</td>
				<?php foreach($fetchBieren[0] as $key => $array) : ?> <!-- kan ook weer [1], [2],...  -->
					<td><?= $key ?></td> <!-- In dit geval enkel naam -->
				<?php endforeach ?>
			</tr>	
		</thead>
		<tbody>
			<?php foreach($fetchBieren as $key => $array) : ?> 
				<tr>
					<td><?= $counter ?></td>
					<td><?= $array['naam']?></td> <!-- toch enkel de naam nodig -->
					<?php $counter++; ?> <!-- waarde optellen kan omdat deze static is-->
				</tr>
			<?php endforeach ?>
		</tbody>
		</table>
	<?php endif ?>
</body>
</html>