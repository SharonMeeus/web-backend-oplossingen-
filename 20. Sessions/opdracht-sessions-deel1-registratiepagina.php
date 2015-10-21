<?php
	session_start();

	$email = "";
	$nickname = "";

	if (isset($_SESSION['registration']['email']))
	{
		$email = $_SESSION['registration']['email'];
	}
	else
	{ $email = '';}
	if (isset($_SESSION['registration']['nickname'])) 
	{
		$nickname = $_SESSION['registration']['nickname'];
	}
	else
	{ $nickname = '';}

	var_dump($_SESSION)
?>

<!DOCTYPE html>
<html>
<head>
	<title>Oplossing Opdracht session deel 1: registratiepagina</title>
</head>
<body>
	<h1>Deel 1: registratiegegevens</h1>
	<form action="opdracht-sessions-deel2-adrespagina.php" method="post">
		<label for="email">e-mail:</label>
		<input type="text" name="email" value="<?= $email ?>" id="email">
		<br/>
		<label for="nickname">nickname:</label>
		<input type="text" name="nickname"  value="<?= $nickname ?>" id="nickname">
		<input type="submit" value="Volgende" id="submitbutton" name="submit_Registration">
	</form>
	
</body>
</html>