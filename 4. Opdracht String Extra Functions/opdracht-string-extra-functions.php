<?php

	$fruit = "kokosnoot";
	$lengtefruit = strlen($fruit);
	$positie_eerste_o_in_fruit = strpos($fruit, "o");

	$fruit2 = "ananas";
	$positie_laatste_a_in_fruit2 = strpos($fruit2, "a", 3);
	$fruit2_in_hoofdletters = strtoupper($fruit2);
	
	$lettertje = "e";
	$cijfertje = 3;
	$langsteWoord = "zandzeepsodemineralenwatersteenstralen";
	$vervang_e = str_replace($lettertje, $cijfertje, $langsteWoord);
?>
<!doctype html>
<html>
<head>
	<title>Opdracht string extra functions </title>
</head>
<body>

	<h1>Opdracht string extra functions: deel 1</h1>

	<p><?php echo "De lengte van kokosnoot = " . $lengtefruit ?></p>
	<p><?php echo "De positie van de eerste 'o' in kokosnoot is " . $positie_eerste_o_in_fruit ?></p>

	<h1>Opdracht string extra functions: deel 2</h1>

	<p><?php echo "De positie van de laatste 'a' in ananas is " . $positie_laatste_a_in_fruit2 ?></p>
	<p><?php echo "ananas in hoofdletters: " . $fruit2_in_hoofdletters ?></p>

	<h1>Opdracht string extra functions: deel 3</h1>

	<p><?php echo $vervang_e ?></p>



</body>
</html>