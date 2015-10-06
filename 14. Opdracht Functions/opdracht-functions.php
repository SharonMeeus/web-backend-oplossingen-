<?php 
	
	function berekenSom($getal1, $getal2)
	{
		$som = $getal1 + $getal2;
		return $som;
	}

	function vermenigvuldig($getal1, $getal2)
	{
		$product = $getal1 * $getal2;
		return $product;
	}

	function isEven($getal)
	{
		$even = false;

		if($getal % 2 == 0) {
			$even = true;
		} 

		return $even;
	}

	function stringlengte_uppercase($string)
	{
		$length = strlen($string);
		$uppercase = strtoupper($string);
		$array = array($length, $uppercase);

		return $array;
	}

	$somGetallen = berekenSom(5, 8);
	$productGetallen = vermenigvuldig(5, 8);
	$getalIsEven = isEven(7) ? 'true' : 'false';
	$rndstring = implode(", ", stringlengte_uppercase("hallo"));

	// Opdracht 2

	$jazzmuzikanten = array("Ella Fitzgerald" => "Zangeres", "Billie Holiday" => "Zangeres", "Charlie Parker" => "Saxofonist", "Miles Davis" => "Trompetist",
	 "Sarah Vaughan" => "Zangeres", "Chet Baker" => "Trompetist en zanger");

	function drukArrayAf($array)
	{
		$content = array();
		foreach ($array as $key => $value) {
			$content[] = "jazzmuzikanten " . "[" . $key . "]" . " heeft waarde " . $value . "\n";
		}

		return $content;
	}

	$arrayPrint = drukArrayAf($jazzmuzikanten);

	$htmltest = "<html><head><title></title></head><body><h1>Test html</h1></body>";

	function validateHtmlTag($html) 
	{
		$begin = "<html>";
		$einde = "</html>";

		$validbool = false;

		if(strpos($html, $begin) === 0) { // 3 gelijkheidstekens, want pos 0 returned false!!
			if( strpos($html, $einde) == (strlen($html) - strlen($einde)) ) {
				$validbool = true;
			}
		}

		return $validbool;
	}

	$validation =  validateHtmlTag($htmltest) ?  htmlentities($htmltest) . " is html valid." : htmlentities($htmltest) . " is niet html valid"; 
?>
<!doctype html>
<html>
<head>
	<title>Opdracht function</title>
</head>
<body>
	<h1>Opdracht functies: deel 1</h1>
	<p><?= $somGetallen; ?></p>
	<p><?= $productGetallen; ?></p>
	<p><?= $getalIsEven; ?></p>
	<p><?= $rndstring; ?> </p>

	<h1 class="extra">Opdracht functies: deel 2</h1>
	<ul>
		<?php foreach ($arrayPrint as $value): ?> 
			<li><?= $value ?></li>	
		<?php endforeach ?>
	</ul>

	<p><?= $validation ?></p>
</body>
</html>