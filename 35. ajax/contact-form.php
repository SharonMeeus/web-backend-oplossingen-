	<?php
	
	session_start();
	$message = "";
	$email = "";
	$boodschap = "";

	if(isset($_SESSION["data"])) // zorgen dat bij fout de email en boodschap terug in de form staan
	{
		$email = $_SESSION["data"]["email"];
		$boodschap = $_SESSION["data"]["boodschap"];
	}

	if(isset($_SESSION["notification"])) // error/succes
	{
		$message = $_SESSION["notification"]["message"];
	}

	
?>

<html>
<head>
	<title>Contacteer ons</title>
	<style type="text/css">
		textarea
		{
			width: 300px;
			height: 100px;
		}
	</style>
</head>
<body>
	<h1>Contacteer ons</h1>
	<p><?= $message ?></p>
	<form action="contact.php" id="contactform" method="post">
		<label>Email-adres</label><br/>
		<input type="text" name="email" value="<?= $email ?>" /><br/>
		<label>Boodschap</label><br/>
		<textarea name="boodschap"><?= $boodschap ?></textarea><br/>
		<input type="checkbox" name="kopie" value="ja"/> Stuur een kopie naar mezelf<br/>
		<button type="submit" name="verzenden">Verzenden</button>
	</form>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function()
		{
			//console.log("test jquery");
			$("#contactform").submit(function()
			{
				// de data uit de form halen
				formdata = $("#contactform").serialize();
				//console.log(formdata);
				//ajax aanmaken (extra info zie front-end)
				$.ajax({

					type: 'POST',
					url: 'contact-api.php',
					data: formdata,
					success: function(data) {
						//console.log(data);
						// de data eerst nog leesbaar maken, dus deze moet omgezet worden naar een leesbare JSON.
						parsedData = JSON.parse(data);
						console.log(parsedData);
						if(parsedData["type"] == "success")
						{
							$("#contactform").fadeOut("slow", function()
							{
								$("body").append($('<p>' + "Bedankt! Uw bericht werd goed verzonden!" + '<p>').fadeIn("slow"));
							});
						} 
						else if(parsedData["type"] == "error")
						{
							$("#contactform").hide().prepend('<p>' + "Oeps, er ging iets mis. Probeer opnieuw!").fadeIn("slow");
						}
					}
					

				});
				// return (als laatste) false omdat we niet willen dat het formulier automatisch verstuurd wordt. (Afhandelen via AJAX dus)
				return false;
			});
		});
	</script>
</body>
</html>