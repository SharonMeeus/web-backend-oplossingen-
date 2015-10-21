<?php
	session_start();

	$email = "";
	$nickname = "";

	if (isset($_SESSION['data']['registration']['email']))
	{
		$email = $_SESSION['data']['registration']['email'];
	}
	else
	{ $email = '';}
	if (isset($_SESSION['data']['registration']['nickname'])) 
	{
		$nickname = $_SESSION['data']['registration']['nickname'];
	}
	else
	{ $nickname = '';}
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
		<input type="text" name="email" value="<?= $email ?>" id="email" <?= (isset($_GET['focus']) && $_GET['focus']=='email')? 'autofocus' : '' ?>>
		<br/>
		<label for="nickname">nickname:</label>
		<input type="text" name="nickname"  value="<?= $nickname ?>" id="nickname" <?= (isset($_GET['focus']) && $_GET['focus']=='nickname')? 'autofocus' : '' ?>>
		<input type="submit" value="Volgende" id="submitbutton" name="submit_Registration">
	</form>
	
</body>
</html>