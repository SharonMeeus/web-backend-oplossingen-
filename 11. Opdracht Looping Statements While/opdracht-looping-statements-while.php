<?php 
	$x = 0;
	$getallen = array();

	while($x < 100) {
		$getallen[] = $x;
		$x++;
	}

	$getallen2 = array();
	$y = 0;
	while($y < 100) {
		if($y > 40 && $y % 3 == 0 && $y < 80)
		{
			$getallen2[] = $y;
		}
		$y++;
	}

	$a = 0;
	$boodschappenlijstje = array("brood", "melk", "appels", "eieren");
	
 ?>
<!doctype html>
<html>
<head>
	<title>Opdracht Looping Statements While</title>
</head>
<body>
	<h1>Opdracht while: deel 1</h1>
	<h3>Getallen van 1 tot 100:</h3>
	<p><?php echo implode(", ", $getallen) ?></p>
	<h3>Getallen groter dan 40 en kleiner dan 80 die deelbaar zijn door 3:</h3>
	<p><?php echo implode(", ", $getallen2) ?></p>

	 <h1>Opdracht while: deel 2</h1>
	 <ul>
		<?php while($a < count($boodschappenlijstje)): ?>
			<li><?= $boodschappenlijstje[$a] ?></li>
			<?php $a++; ?>
		<?php endwhile?>	
	</ul>
</body>
</html>