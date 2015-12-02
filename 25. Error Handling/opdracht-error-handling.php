<?php
	
	session_start();

	$isValid = false;

	try // een try voor de isset geplaatst
	{
		if(isset($_POST["submit_kortingscode"])) //checken of er op Verzenden is geklikt
		{
			if(isset($_POST["kortingscode"])) //checken of de kortingscode al dan niet aanwezig is. Als dit zo is:
			{
				if(strlen($_POST["kortingscode"]) === 8) // Hier kijken of de lengte van de kortingscode 8 is
				{
					$isValid = true; //Als dit zo is tonen we in de html 'Korting tegekend'
				} 
				else
				{
					throw new Exception("VALIDATION-CODE-LENGTH"); // en anders een andere error
				}
			}
			else // Als dit niet zo is → de error naar file loggen
			{
				throw new Exception("SUBMIT-ERROR"); // hier de error
			}
		}
	}
	catch(Exception $e) 
	{
		$messagecode = $e->getMessage(); // De exception die we hebben doorgestuurd gaan we in de variabele messagecode steken
		$message;
		$createMessage = false;

		switch ($messagecode) 
		{
			case 'SUBMIT-ERROR': //checken of messagecode gelijk is aan SUBMIT-ERROR
				$message['type'] = "error";
				$message['text'] = "Er werd met het formulier geknoeid";
				break;
			case 'VALIDATION-CODE-LENGTH': 
				$message['type'] = "error";
				$message['text'] = "De kortingscode heeft niet de juiste lengte";
				$createMessage = true;
			default: //anders niks doen
				break;
		}

		if($createMessage) 
		{
			createMessage($message);
		}

		logToFile($message); // functie aanmaken om de message naar een file te loggen.
	}

	function logToFile($message)
	{
		$date = "[" . date( "H:i:s d/m/Y " )."]"; // bv. 22:16:32 05/06/2007
		$ip = $_SERVER['SERVER_ADDR']; // ip adres verkrijgen
		$stringerror = $date . " - " . $ip . " - " . "type:" . "[" . $message["type"] . "]" . $message["text"] . "\n\r"; //alles samenvoegen in een string

		file_put_contents( 'log.txt', $stringerror, FILE_APPEND ); // $stringerror toevoegen aan het einde van log.txt
	}

	function createMessage($message)
	{
		$_SESSION['message']['type'] = $message['type']; // de waarden van de array in deze session steken
		$_SESSION['message']['message'] = $message['text'];
	}

	function showMessage()
	{

		if(isset($_SESSION['message']['message'])) // kijken of deze is aangemaakt
		{
			$message = $_SESSION['message']['message']; // de waarde van deze in een variabele steken
			unset($_SESSION['message']['message']); // dan deze unsetten zodat er elke keer opnieuw kan gecheckt worden, anders blijft deze altijd een waarde hebben en is dit dus altijd true
			return $message;
		}
		else
		{
		    return false; // anders false returnen.
		}

	}

	$errorMessage = showMessage(); // Deze onderaan zetten zodat eerst showMessage() wordt uitgevoerd.


?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Error Handling</title>
</head>
<body>
	<h1>Geef uw kortingscode op</h1>
	<p><?= ($errorMessage) ? $errorMessage	 : "" ?></p>
	<?php if($isValid) : ?>
		<p>Korting toegekend!</p>
	<?php else : ?>
		<form action="opdracht-error-handling.php" method="post">
			<label>Kortingscode</label><br/>
			<input type="text" name="kortingscode"><br/>
			<input type="submit" name="submit_kortingscode" value="Verzenden">
		</form>
	<?php endif ?>
</body>
</html>