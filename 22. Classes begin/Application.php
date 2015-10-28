<?php 

	function __autoload($className) {
	  require_once('classes/' . $className . '.php');
	}

	$number1 = 150;
	$number2 = 100;

	$percentInstance = new Percent($number1, $number2); // instantie aanmaken van de klasse percent

	$absolute = $percentInstance->formatNumber($percentInstance->absolute); // zorgen dat je een getal terugkrijgt met 2 getallen na de komma.
	$relative = $percentInstance->formatNumber($percentInstance->relative);
	$hundred = $percentInstance->hundred;
	$nominal = $percentInstance->nominal;
?>

<html>
<head>
	<title>Opdracht classes begin</title>
</head>
<body>
	<p>Hoeveel procent is <?= $number1 ?> van <?= $number2 ?>?</p>
	<table>
		<tr>
			<td>Absoluut</td>
			<td><?= $absolute ?></td>
		</tr>
		<tr>
			<td>Relatief</td>
			<td><?= $relative ?></td>
		</tr>
		<tr>
			<td>Geheel getal</td>
			<td><?= $hundred ?>%</td>
		</tr>
		<tr>
			<td>Nominaal</td>
			<td><?= $nominal ?></td>
		</tr>
	</table>
</body>
</html>