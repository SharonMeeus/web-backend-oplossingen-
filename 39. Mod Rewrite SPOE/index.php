<?php
	
	// De klasse(n) automatisch inladen
	function autoloader($className)
	{
		include_once 'classes/'.$className.'.php';
	}

	spl_autoload_register('autoloader');

	//Automatisch de klasse aanmaken adhv de controller
	$str = $_GET["controller"];
	$class = ucfirst($str); // Een klasse begint met een hoofdletter, dus ucfirst
	$object = new $class(); // Hier de klasse aanmaken (in dit geval de klasse Bieren -> hardcoded in htaccess)

	// de method opvragen
	$method = $_GET["method"];
?>
<!doctype html>
<html lang="en">
<head>
	<title>Bieren rewrite</title>
	<meta charset="UTF-8">
</head>
<body>
	<!-- De basenaam laten zien van DIT bestand(= index.php) in heading -->
	<h1><?= basename(__FILE__) ?></h1>
	<pre>
		<?= var_dump($_GET) ?>
	</pre>	
	<!-- $method gebruiken om gelijknamige functies op te roepen. Dit doen we adhv de klasse die we gecreëerd hebben -->
	<h1><?= $object->$method() ?></h1>
</body>
</html>