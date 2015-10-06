<?php 
	$geld = 100000;
	$jaren = 10;
	$rente = 0.08;

	function berekenInterest($geld, $jaren, $rente)
	{
		static $teller = 1;
		static $info = array();

		if($teller <= $jaren) {
			$rentegeld = floor($geld * $rente);
			$totaal = $geld + $rentegeld;
			$info[$teller] = "Je totaal kapitaal na " . $teller . " jaar bedraagt €" . $totaal;

			$teller++;
			return berekenInterest($totaal, $jaren, $rente) ;
		} else {
			return $info;
		}
	}

	$eindtotaal = berekenInterest($geld, $jaren, $rente);

	//Opdracht 2

	function berekenInterest2($array)
	{
		if($array["teller"] <= $array["jaren"]) {

			$rentegeld = floor($array["geld"] * $array["rente"]);
			$array["geld"] += $rentegeld;
			$array["info"][$array["teller"]] = "Je totaal kapitaal na " . $array["teller"] . " jaar bedraagt €" . $array["geld"];

			$array["teller"]++;

			return berekenInterest2($array);
		} else {
			return $array;
		}
	}

	$eindtotaal2 = berekenInterest2(array("geld" => $geld, "jaren" => $jaren, "rente" => $rente, "teller" => 1, "info" => array() ));
?>
<!doctype html>
<html>
<head>
	<title>Opdracht Functions Recursive</title>
</head>
<body>
	<h1>Opdracht recursive: deel 1</h1>
	<ul>
		<?php foreach($eindtotaal as $value): ?>
			<li><?= $value ?></li>
		<?php endforeach ?>
	</ul>

	<h1>Opdracht recursive: deel 2</h1>
	<ul>
		<?php foreach($eindtotaal2['info'] as $value): ?>
			<li><?= $value ?></li>
		<?php endforeach ?>
	</ul>	
</body>
</html>