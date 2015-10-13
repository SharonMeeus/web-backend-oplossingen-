<?php
	$artikels = array(
						array(	"titel" => "'Glazen trein' moet ongebruikte treinverbinding weer op kaart zetten",
							  	"datum" => "07/10/2015",
							  	"inhoud" => "HAMONT - Mocht België het stukje spoor tussen Hamont en het Nederlandse Weert weer in gebruik nemen, dan kunnen de Limburgers daar zowel naar Amsterdam als naar Parijs sporen. Om dat te bepleiten, rijdt er zondag een hoogst ongewone trein tussen Weert en Antwerpen.
Voor één keer spoort er zondag 11 oktober vanuit Weert (Nederland) nog eens een trein België in, richting Antwerpen. Geen gewone trein, maar eentje met een glazen wagon en twee andere tot in de puntjes gerestaureerde rijtuigen van Le Compagnie Internationale des Wagons-Lits.
Antje van de Statie De trein is voor 32.000 euro afgehuurd door Dorien Hendrix, de zaakvoerster van Brasserie-Hotel Antje van de Statie in Weert. Doel: promotie maken voor het toerisme in de ruime regio rond Weert én de heringebruikname van de spoorlijn Weert-Hamont op de agenda zetten.
“De familie Hendrix, die hun brasserie-hotel helemaal vernieuwde, wil het gebied aan de Belgische kant van de grens ontsluiten”, zegt woordvoerder Bart Maes.
“Met de ‘Antje Express’ lopen ze vooruit op de eventuele heringebruikname het historische traject Weert-Hamont-Antwerpen. Dat zou immers over en weer heel wat toerisme in beweging zetten. Nu valt het treinverkeer in Hamont stil, op amper een uur van Weert. Maar aan de Nederlandse kant van de grens in de spoorlijn tiptop in orde, want er rijdt dagelijks nog een goederentrein op naar de zinkfabriek in Weert. Als de link hersteld wordt, dan kunnen reizigers vanuit Weert via Antwerpen tot in Parijs sporen en Limburgers ook via Eindhoven tot in Amsterdam.
Delen",
								"afbeelding" => "img/Glazen%20Trein.jpg",
								"afbeeldingbeschrijving" => "Het panoramarijtuig van de historische trein oogt spectaculair. Een ritje Weert-Antwerpen deze zondag kost 195 euro, sterrenmenu inbegrepen"

		),

						array("titel" => "Saxofonist Phil Woods overleden",
							  	"datum" => "30/09/2015",
							  	"inhoud" => "De Amerikaanse saxofonist Phil Woods is dinsdag op 83-jarige leeftijd overleden aan de gevolgen van een longziekte. Dat heeft zijn agent bevestigd. Woods kende een heel rijke carrière van meer dan 60 jaar die gekenmerkt werd voor zijn bewondering voor Charlie Parker. Begin september gaf de erg zieke muzikant zijn laatste concert in Pittsburgh, geflankeerd door een zuurstoffles.
Philip Wells Woods, vaak met een zwarte pet, kreeg een klassieke vorming, onder meer in de vermaarde Juilliard School in New York, waar hij in 1956 werd opgemerkt door Quincy Jones. De nauwgezetheid en precisie van zijn spel, en een buitengewoon ritmisch meesterschap, brachten hem in contact met de meest prestigieuze gezelschappen. Zo speelde hij onder meer met Dizzy Gillespie in de schoot van de Birdland All-Stars.
Woods werd erg beïnvloed door de be-bop, de beweging opgericht door de generatie van Parker en Gillespie. Die band werd nog versterkt door zijn huwelijk met Chan, de weduwe van Parker.
Phil Woods schreef meer dan 200 nummers en arrangementen en won vier Grammy’s. Hij maakte ook uitjes in de pop. De toon van Woods, puur én krachtig, klinkt in ballades als ‘Still crazy after all these years’ van Paul Simon of ‘Just the way you are’ van Billy Joel.",
								"afbeelding" => "img/Phil%20Woods.jpg",
								"afbeeldingbeschrijving" => "Afbeelding van saxofonist Phil Woods"),
	
						array("titel" => "Caffènation gezicht van nieuwe jeanscampagne",
							  	"datum" => "06/10/2015",
							  	"inhoud" => "ANTWERPEN - 'Made to be authentic', zo heet de nieuwe, nationale Lee Cooper-campagne. Koffiebar Caffènation en zijn barista's staan in een reeks foto's model voor die authenticiteit.
Geen internationale modellen en studioshoots voor de nieuwe wintercampagne van denimmerk Lee Cooper. In plaats daarvan volgt het de barista's van Caffènation een dag aan het werk. Met als resultaat een reeks beelden van de jonge bende – hoofdzakelijk in denim uiteraard – in en rond de koffiebar aan de Mechelsesteenweg. Onderweg naar het werk op de koersvelo, kopjes dragend op het terras, aan het werk in de branderij, pauzerend en hangend op straat.
Van oorsprong werkkledij
Met de nieuwe wintercampagne wil het jeansmerk dan ook focussen op ambachtelijkheid en authenticiteit. “Die twee lagen voor het grijpen in Caffènation”, aldus Lee Cooper. “Lee Cooper is begonnen als een merk van werkkledij. De laatste paar jaar gaan we terug naar die roots: door ambachtsleden, voor ambachtsleden. En ook daarom was Caffènation de perfecte match, want naast koffiebar heeft Caffènation ook zijn eigen branderij.”
“Dicht bij onze leefwereld”
“Veel modemerken spelen tegenwoordig in op authenticiteit, maar gebruiken ondertussen modellen en locaties die je in de realiteit niet terugvindt”, vertelt Rob Berghmans van Caffènation. “Bij ons is die echtheid er wel, de campagne staat heel dicht bij onze leefwereld, anders hadden we er ook niet aan willen meewerken.”
De reclamebeelden van Caffènation zullen niet in het straatbeeld verschijnen maar vooral online gebruikt worden.",
								"afbeelding" => "img/caffènation.jpg",
								"afbeeldingbeschrijving" => "Afbeelding van Caffènation")

);

// Gekeken naar oplossing

$id;
$individueelArtikel = false;
$nietBestaandArtikel = false;

if(isset($_GET["id"])) { // Als er een id is. → ?id=...

	$id = ($_GET["id"]);

	if(array_key_exists($id, $artikels)) {

		$artikels = array($artikels[$id]);
		$individueelArtikel = true;
	} else {
		$nietBestaandArtikel = true;
	}

}


?>
<!doctype html>	
<html>
<head>
	<title>Opdracht Get</title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
	<?php if(!$nietBestaandArtikel): ?>
	<div id="content">
		<?php foreach ($artikels as $key => $value) : ?> 
			<div class="artikel">
				<h1><?php echo $value["titel"]; ?></h1>
				<img src="<?php echo $value['afbeelding']; ?>" alt="<?php echo $value['afbeeldingbeschrijving']; ?>" />
				<p id="datum"><?php echo $value["datum"]; ?></p>
				<p><?php echo (!$individueelArtikel) ? substr($value["inhoud"], 0, 50) : $value["inhoud"]; ?></p>
				<?php if(!$individueelArtikel) : ?> 
					<a href="http://web-backend.local/cursus/opdrachten/opdracht-get/opdracht-get.php?id=<?= $key ?>">Lees meer</a>
				<?php endif ?>
			</div>
		<?php endforeach ?>
	</div>
	<?php else: ?>
		<p>Dit artikel bestaat niet...</p>
	<?php endif ?>
</body>
</html>