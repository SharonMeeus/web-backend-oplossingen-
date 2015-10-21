<?php
	session_start();

	if (isset($_POST['submit_Registration'])) 
	{
		$_SESSION['data']['registration']['email'] = $_POST['email'];
		$_SESSION['data']['registration']['nickname'] = $_POST['nickname'];
		if (($_POST['email'] == "") || ($_POST['nickname'] == ""))
		{
			header('Location: opdracht-sessions-deel1-registratiepagina.php'); 
		}
	}
	else
	{
		$_SESSION['gegevens']['registratie']['email']="";
		$_SESSION['gegevens']['registratie']['nickname']="";
	}
	$street = (isset($_SESSION['data']['address']['street']))? $_SESSION['data']['address']['street'] : '';
	$number = (isset($_SESSION['data']['address']['number']))? $_SESSION['data']['address']['number'] : '';
	$city = (isset($_SESSION['data']['address']['city']))? $_SESSION['data']['address']['city'] : ''; 
	$zipcode = (isset($_SESSION['data']['address']['zipcode']))? $_SESSION['data']['address']['zipcode'] : '';
?>


<!DOCTYPE html>
<html>
<head>
	<title>Oplossing opdracht sessions deel 2: adrespagina</title>
</head>
<body>
	<h1>Registratiegegevens</h1>
	
	<ul>
		<?php foreach ($_SESSION['data']['registration'] as $key => $value): ?> 
			<li><?= $key.': '.$value; ?></li>
		<?php endforeach ?>
	</ul>

	<h1>Deel 2: adres</h1>
	<form action="oplossing_opdracht-session-overzichtpagina.php" method="post">
		<label for="street">Straat:</label>
		<input type="text" name="street" id="street" value="<?= $street ?>" <?= (isset($_GET['focus']) && $_GET['focus']=='street')? 'autofocus' : '' ?>>
		<br />
		<label for="number">Nummer:</label>
		<input type="number" name="number" id="number" value="<?= $number ?>" <?= (isset($_GET['focus']) && $_GET['focus']=='number')? 'autofocus' : ''?>>
		<br />
		<label for="city">Gemeente:</label>
		<input type="text" name="city" id="city" value="<?= $city ?>" <?= (isset($_GET['focus']) && $_GET['focus']=='city')? 'autofocus' : ''?>>
		<br />
		<label for="zipcode">Postcode:</label>
		<input type="text" name="zipcode" id="zipcode" value="<?= $zipcode ?>" <?= (isset($_GET['focus']) && $_GET['focus']=='zipcode')? 'autofocus' : '' ?>>
		<br />
		<input type="submit" name="submitAddress" value="Volgende" id="submitbutton">
	</form>

</body>
</html>