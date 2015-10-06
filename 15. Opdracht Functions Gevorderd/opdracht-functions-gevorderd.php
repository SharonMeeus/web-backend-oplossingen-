<?php
	$md5HashKey = "d1fa402db91a7a93c4f414b8278ce073";

	$character1 = "2";
	$character2 = "8";
	$character3 = "a";

	function frequency_of_character1($string, $character)
	{
		$number = substr_count($string, $character);
		$percentage = ($number/strlen($string)) * 100;

		return $percentage;
	}

	function frequency_of_character2($character)
	{
		$string = $GLOBALS['md5HashKey'];
		$number = substr_count($string, $character);
		$percentage = ($number/strlen($string)) * 100;

		return $percentage;
	}

	function frequency_of_character3($character)
	{
		global $md5HashKey;
		$string = $md5HashKey;
		$number = substr_count($string, $character);
		$percentage = ($number/strlen($string)) * 100;

		return $percentage;
	}

	$function1 = frequency_of_character1($md5HashKey, $character1);
	$function2 = frequency_of_character2($character2);
	$function3 = frequency_of_character3($character3);

	//Opdracht 2

	$pighealth = 5;
	$maximumThrows = 8;
	$game = array();

	function calculateHit()
	{
		global $pighealth;
		$rndnumber = rand(1, 10);
		$hit = ($rndnumber <= 4) ? true : false;
		$message = array();

		if($hit) {
			$pighealth--;
			if($pighealth > 1){
				$message["x"] = "Raak! Er zijn nog maar " . $pighealth . " varkens over."; 
			} 
			elseif($pighealth == 1) {
				$message["x"] = "Raak! Er is nog maar " . $pighealth . " varken over."; 
			} else {
				$message["x"] = "Raak! Er zijn geen varkens meer over.";
			}
		} else {
			if($pighealth > 1) {
				$message["x"] = "Mis! Er zijn nog " . $pighealth . " varkens over.";
			} else {
				$message["x"] = "Mis! Er is nog " . $pighealth . " varken over.";
			}
		}

		return $message;
	}

	function launchAngryBird()
	{
		global $pighealth;
		global $maximumThrows;
		global $game;

		if($maximumThrows != 0 && $pighealth > 0) {
			$hit = calculateHit();
			$game[] = $hit["x"];
			$maximumThrows--;
			launchAngryBird();
		} else {
			if($pighealth > 0) {
				$game[] = "Verloren!";
			} else {
				$game[] = "Gewonnen!";
			}
		}

	}

	launchAngryBird();


 ?>
<!doctype html>
<html>
<head>
	<title>Opdracht Functions Gevorderd</title>
</head>
<body>
	<h1>Opdracht functies gevorderd: deel 1</h1>
	<p>Functie 1: De needle <?= $character1 ?> komt <?= $function1 ?>&#37 voor in de hash key <?= $md5HashKey ?></p>
	<p>Functie 2: De needle <?= $character2 ?> komt <?= $function2 ?>&#37 voor in de hash key <?= $md5HashKey ?></p>
	<p>Functie 3: De needle <?= $character3 ?> komt <?= $function3 ?>&#37 voor in de hash key <?= $md5HashKey ?></p>

	<h1 class="extra">Opdracht functies gevorderd: deel 2 (Angry Birds)</h1>
	<ul>
		<?php foreach ($game as $value) : ?>
		<li><?= $value ?></li>
		<?php endforeach ?>
	</ul>

</body>
</html>