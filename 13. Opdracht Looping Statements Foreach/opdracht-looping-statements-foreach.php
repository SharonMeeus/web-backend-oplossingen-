<?php 
	$text = file_get_contents("text-file.txt");
	$textChar = str_split($text);
	rsort($textChar);

	$textCharSortedReversed = array_reverse($textChar);

	$amount = array();
	$amount2 = array();

	foreach ($textCharSortedReversed as $value) {
		if(isset($amount[$value])){
			$amount[$value]++;
		} else {
			$amount[$value] = 1;
		}
	}

	//Opdracht 2
	foreach ($textCharSortedReversed as $value) {
		if(ctype_alpha($value)) {
			if(isset($amount2[strtoupper($value)])){
				$amount2[strtoupper($value)]++;
			} else {
				$amount2[strtoupper($value)] = 1;
			}
		}
	}

	ksort($amount2);

?>
<!doctype html>
<html>
<head>
	<title>Opdracht Looping Statements Foreach</title>
</head>
<body>
	<h1>Opdracht foreach: deel 1</h1>
	<pre><?php var_dump ( $amount ) ?></pre>

	<h1 class="extra">Opdracht foreach: deel 2</h1>
	<ul>
		<?php foreach ($amount2 as $key => $value): ?>
			<li><?= $key . " x " . $value ?></li>	
		<?php endforeach ?>
	</ul>
</body>
</html>