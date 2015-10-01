<?php
	
	$getal = 5;
	$dag = "";

	switch ($getal) {
		case 1:
			$dag = "maandag";
			break;
		case 2:
			$dag = "dinsdag";
			break;
		case 3:
			$dag = "woensdag";
			break;
		case 4: 
			$dag = "donderdag";
			break;
		case 5:
			$dag = "vrijdag";
			break;
		case 6:
			$dag = "zaterdag";
			break;
		case 7:
			$dag = "zondag";
			break;
		default:
			$dag = "onbekend";
			break;
	}
?>
<!doctype html>
<html>
<head>
	<title>Opdracht conditional statements switch</title>
</head>
<body>
	<p><?= $dag ?></p>
</body>
</html>