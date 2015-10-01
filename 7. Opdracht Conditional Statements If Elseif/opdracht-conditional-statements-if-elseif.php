<?php
	$getal = 55;
	$uitkomst = "";
	

	if($getal > 1 && $getal <= 10 ) {
		$uitkomst = "Het getal ligt tussen 1 en 10";
	}
	elseif($getal > 10 && $getal <= 20) {
		$uitkomst = "Het getal ligt tussen 10 en 20";
	}
	elseif($getal > 20 && $getal <= 30) {
		$uitkomst = "Het getal ligt tussen 20 en 30";
	}
	elseif($getal > 30 && $getal <= 40) {
		$uitkomst = "Het getal ligt tussen 30 en 40";
	}
	elseif($getal > 40 && $getal <= 50) {
		$uitkomst = "Het getal ligt tussen 40 en 50";
	}
	elseif($getal > 50 && $getal <= 60) {
		$uitkomst = "Het getal ligt tussen 50 en 60";
	}
	elseif($getal > 60 && $getal <= 70) {
		$uitkomst = "Het getal ligt tussen 60 en 70";
	}
	elseif($getal > 70 && $getal <= 80) {
		$uitkomst = "Het getal ligt tussen 70 en 80";
	}
	elseif($getal > 80 && $getal <= 90) {
		$uitkomst = "Het getal ligt tussen 80 en 90";
	}
	elseif($getal > 90 && $getal <= 100) {
		$uitkomst = "Het getal ligt tussen 90 en 100";
	} else {
		$uitkomst = "Gelieve een getal in te geven tussen 1 en 100";
	}

	$tsmoktiu = strrev($uitkomst);
?>
<!doctype html>
<html>
<head>
	<title>Opdracht conditional statements if elseif</title>
</head>
<body>
	<p><?php echo $uitkomst ?></p>
	<p><?php echo $tsmoktiu ?></p>
</body>
</html>