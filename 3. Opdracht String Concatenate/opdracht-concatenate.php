<?php
	$naam = "Meeus";
	$voornaam = "Sharon";
	$volledigeNaam = $voornaam . " " . $naam;
	$lengteVolledigeNaam = strlen($volledigeNaam);
?>
<!doctype html>
<html>
<head>
	<title>Oplossing opdracht string concatenate</title>
</head>
<body>

	<p><?php echo $volledigeNaam ?></p>
	<p><?php echo $lengteVolledigeNaam ?></p>	

</body>
</html>