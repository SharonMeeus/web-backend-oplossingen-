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
	<form action="contact.php" method="post">
		<label>Email-adres</label><br/>
		<input type="text" name="email" value="<?= $email ?>" /><br/>
		<label>Boodschap</label><br/>
		<textarea name="boodschap"><?= $boodschap ?></textarea><br/>
		<input type="checkbox" name="kopie" value="ja"/> Stuur een kopie naar mezelf<br/>
		<button type="submit" name="verzenden">Verzenden</button>
	</form>
</body>
</html>