<?php 
	
	$password = "azerty";
	$username = "Jonathan";
	$message = "";

	if(isset($_POST["gebruikersnaam"]) && isset($_POST["paswoord"])) {
		if($username == $_POST["gebruikersnaam"] && $password == $_POST["paswoord"]) {
			$message = "Welkom.";
		} else {
			$message = "Er ging iets mis bij het inloggen, probeer opnieuw.";
		}
	}
?>
<html>
<head>
	<title>Opdracht Post</title>
</head>
<body>
	<h1>Inloggen</h1>
	<form action="" method="post">
		gebruikersnaam: <br>
		<input type="text" name="gebruikersnaam" id="gebruikersnaam"><br>
		<br>
		paswoord: <br>
		<input type="password" name="paswoord" id="paswoord"><br>
		<br>
		<input type="submit" value="Verzenden">
		<br>
		<br>
		<?= $message ?>
	</form>
</body>
</html>