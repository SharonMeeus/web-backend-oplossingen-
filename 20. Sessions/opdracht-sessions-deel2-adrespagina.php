<?php
	session_start();

	if (isset($_POST['submit_Registration'])) 
	{
		$_SESSION['registration']['email'] = $_POST['email'];
		$_SESSION['registration']['nickname'] = $_POST['nickname'];
		if (($_POST['email'] = "") || ($_POST['nickname'] == ""))
		{
			header('Location: opdracht-sessions-deel1-registratiepagina.php'); 
		}
	} else {

		/* $_SESSION['registration']['email']="";
		$_SESSION['registration']['nickname']=""; */
	}
	$street = (isset($_SESSION['address']['street']))? $_SESSION['address']['street'] : '';
	$number = (isset($_SESSION['address']['number']))? $_SESSION['address']['number'] : '';
	$city = (isset($_SESSION['address']['city']))? $_SESSION['address']['city'] : ''; 
	$zipcode = (isset($_SESSION['address']['zipcode']))? $_SESSION['address']['zipcode'] : '';
?>


<!DOCTYPE html>
<html>
<head>
	<title>Oplossing opdracht sessions deel 2: adrespagina</title>
</head>
<body>
	<h1>Registratiegegevens</h1>
	
	<ul>
		<?php foreach ($_SESSION['registration'] as $key => $value): ?> 
			<li><?= $key.': '.$value; ?></li>
		<?php endforeach ?>
	</ul>

	<h1>Deel 2: adres</h1>
	<form action="opdracht-sessions-deel3-overzichtpagina.php" method="post">
		<label for="street">Straat:</label>
		<input type="text" name="street" id="street" value="<?= $street ?>">
		<br />
		<label for="number">Nummer:</label>
		<input type="number" name="number" id="number" value="<?= $number ?>">
		<br />
		<label for="city">Gemeente:</label>
		<input type="text" name="city" id="city" value="<?= $city ?>">
		<br />
		<label for="zipcode">Postcode:</label>
		<input type="text" name="zipcode" id="zipcode" value="<?= $zipcode ?>">
		<br />
		<input type="submit" name="submit_Address" value="Volgende" id="submitbutton">
		<br />
		<a href="destroy.php">Vernietig sessie</a>
	</form>

</body>
</html>