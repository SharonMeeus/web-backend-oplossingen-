<?php 

	function __autoload($className) {
	  require_once('classes/' . $className . '.php');
	}

	$animal1 = new Animal("Kermit", "male", 100);
	$animal2 = new Animal("Dikkie", "male", 100);
	$animal2->changeHealth(-10);
	$animal3 = new Animal("Flipper", "female", 100);
	$animal3->changeHealth(-20);

	$leeuw1 = new Lion("Simba", "male", 100, "Congo lion");
	$leeuw2 = new Lion("Scar", "male", 100, "Kenia lion");

	$zebra1 = new Zebra("Zeke", "male", 100, "Quagga");
	$zebra2 = new Zebra("Zana", "female", 100, "Selous");
?>

<html>
<head>
	<title>Opdracht Classes Extends</title>
</head>
<body>
	<h1>Instanties van de Animal class</h1>
	<p><?= $animal1->getName(); ?> is van het geslacht <?= $animal1->getGender(); ?> en heeft momenteel <?= $animal1->getHealth(); ?> levenspunten
		(special move: <?= $animal1->doSpecialMove(); ?>)</p>
	<p><?= $animal2->getName(); ?> is van het geslacht <?= $animal2->getGender(); ?> en heeft momenteel <?= $animal2->getHealth(); ?> levenspunten
		(special move: <?= $animal2->doSpecialMove(); ?>)</p>
	<p><?= $animal3->getName(); ?> is van het geslacht <?= $animal3->getGender(); ?> en heeft momenteel <?= $animal3->getHealth(); ?> levenspunten
		(special move: <?= $animal3->doSpecialMove(); ?>)</p>

	<h1>Leeuwen</h1>
	<p>De speciale move van <?= $leeuw1->name ?> (soort: <?= $leeuw1->getSpecies(); ?>): <?= $leeuw1->doSpecialMove(); ?></p>
	<p>De speciale move van <?= $leeuw2->name ?> (soort: <?= $leeuw2->getSpecies(); ?>): <?= $leeuw2->doSpecialMove(); ?></p>

	<h1>Zebra's</h1>
	<p>De speciale move van <?= $zebra1->name ?> (soort: <?= $zebra1->getSpecies(); ?>): <?= $zebra1->doSpecialMove(); ?></p>
	<p>De speciale move van <?= $zebra2->name ?> (soort: <?= $zebra2->getSpecies(); ?>): <?= $zebra2->doSpecialMove(); ?></p>

</body>
</html>