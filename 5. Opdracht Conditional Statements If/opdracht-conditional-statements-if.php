<?php
	
	$dag = "";

	$getal = 3;


	if( $getal === 1 ) {
		$dag = "maandag";
	}
	elseif($getal === 2 ) {
		$dag = "dinsdag";
	}
	elseif($getal === 3 ) {
		$dag = "woensdag";
	}
	elseif($getal === 4 ) {
		$dag = "donderdag";
	}
	elseif($getal === 5 ) {
		$dag = "vrijdag";
		
	}
	elseif($getal === 6 ) {
		$dag = "zaterdag";
	}
	elseif($getal === 7 ) {
		$dag = "zondag";
		
	} else {
		$dag = "Enkel een getal tussen 1 en 7 geeft een geldige dag!";

	} 

	$dag_in_uppercase = strtoupper($dag);
	$dag_in_uppercase_except_a = str_replace("A", "a", $dag_in_uppercase);
	$dag_last_pos_a = strrpos($dag, "a");
	$dag_in_uppercase_except_last_a = substr_replace($dag_in_uppercase, "a", $dag_last_pos_a, 1);


	

?>
<!doctype html>
<html>
<head>
	<title>Opdracht conditional statements if</title>
</head>
<body>

	<h1>Opdracht conditional statements: deel 1</h1>

	<p><?php echo $dag ?></p>

	<h1 class="extra">Opdracht conditional statements: deel 2</h1>

	<p><?php echo $dag_in_uppercase ?></p>
	<p><?php echo $dag_in_uppercase_except_a ?></p>
	<p><?php echo $dag_last_pos_a?><p>
	<p><?php echo $dag_in_uppercase_except_last_a ?><p>

</body>
</html>