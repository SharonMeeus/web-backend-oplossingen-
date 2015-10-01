<?php 
	
	$getal = 400;
	$schrikkeljaar = "";

	$jaren = 0; 
	$maanden = 0;
	$weken = 0;
	$dagen = 0;
	$uren = 0;
	$minuten = 0;
	$seconden = 56412389;

	if($getal % 4 == 0 && $getal % 100 != 0 || $getal % 400 == 0)
	{
		$schrikkeljaar = $getal . " is een schrikkeljaar";
	} else 
	{
		$schrikkeljaar = $getal . " is geen schrikkeljaar";
	}

	

	if($seconden / 60 > 0) {

		$minuten = round($seconden / 60, 0, PHP_ROUND_HALF_DOWN);
	}

	if($minuten / 60 > 0) {
		$uren = round($minuten / 60, 0, PHP_ROUND_HALF_DOWN);
	}

	if($uren / 24 > 0) {
		$dagen = round($uren / 24, 0, PHP_ROUND_HALF_DOWN);
	}

	if($dagen / 7 > 0) {
		$weken = round($dagen / 7, 0, PHP_ROUND_HALF_DOWN);
	}

	if($dagen / 31 > 0)
	{
		$maanden = round($dagen / 31, 0, PHP_ROUND_HALF_DOWN);
	}

	if($maanden / 12 > 0)
	{
		$jaren = round($maanden / 12, 0, PHP_ROUND_HALF_DOWN);
	}

	


?>
<!doctype html>
<html>
<head>
	<title>Opdracht conditional statements if else</title>
</head>
<body>
	<h1>Opdracht if else: deel 1</h1>

	<p><?php echo $schrikkeljaar ?></p>

	<h1 class="extra">Opdracht if else: deel 2</h1>

	<div class="facade-minimal" data-url="http://www.app.local/index.php">
                        
                        <h1>Jaren, maanden, weken, dagen, uren, minuten en seconden</h1>

                        <p>in <?php echo $seconden ?> seconden</p>

                        <ul>
                            <li>minuten: <?php echo $minuten ?></li>
                            <li>uren: <?php echo $uren ?></li>
                            <li>dagen: <?php echo $dagen ?></li>
                            <li>weken: <?php echo $weken ?></li>
                            <li>maanden (31): <?php echo $maanden ?></li>
                            <li>jaren (365): <?php echo $jaren ?></li>
                        </ul>
                    </div>

</body>
</html>