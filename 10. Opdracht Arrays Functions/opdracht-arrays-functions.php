<?php 
	$dieren = array("luipaard", "giraf", "leeuw", "olifant", "paard", "tijger", "pauw");
	$aant_dieren = count($dieren);
	$teZoekenDier = "aap";
	$Gevondendier = "";

	if(in_array($teZoekenDier, $dieren)) {
		$Gevondendier = "Het dier '" . $teZoekenDier . "' werd gevonden!";
	} else {
		$Gevondendier = "Het dier '" . $teZoekenDier . "' werd helaas niet gevonden...";
	}

	$dieren_gesorteerd = $dieren;
	sort($dieren_gesorteerd);

	$zoogdieren = array("dolfijn", "hond", "kat");
	$dierenLijst = array_merge($dieren, $zoogdieren);

	$cijfers = array(8, 7, 8, 7, 3, 2, 1, 2, 4);
	$cijfers_zonder_duplicaten = array_unique($cijfers);
	rsort($cijfers_zonder_duplicaten);
?>
<!doctype html>
<html>
<head>
	<title>Opdracht array functions</title>
</head>
<body>
	<h1>Opdracht array functies: deel 1</h1>
	<p>Aantal dieren: <?= $aant_dieren ?></p>
	<p><?= $Gevondendier ?></p>

	<h1>Opdracht array functies: deel 2</h1>
	<?php echo "Dieren gesorteerd: " . implode(", ", $dieren_gesorteerd);?> 
	</br>
	<?php echo "Dierenlijst: " . implode(", ", $dierenLijst); ?>

	<h1>Opdracht array functies: deel 3</h1>
	<?php echo "zonder duplicaten en gesorteerd van groot naar klein: " . implode(", ",$cijfers_zonder_duplicaten) ?>

</body>
</html>