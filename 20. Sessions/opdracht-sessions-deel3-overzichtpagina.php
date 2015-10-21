<?php 

	session_start();
	
	if(isset($_POST["submit_Address"])) 
	{
		$_SESSION['address']['street'] = $_POST['street'];
		$_SESSION['address']['number'] = $_POST['number'];
		$_SESSION['address']['city'] = $_POST['city'];
		$_SESSION['address']['zipcode'] = $_POST['zipcode'];

		if(($_POST["street"] == "") || ($_POST['number'] == "") || ($_POST["city"] == "") || ($_POST['zipcode'] == ""))
		{
			header("Location: opdracht-sessions-deel2-adrespagina.php");
		}

	} else {

		/*$_SESSION['address']['street'] = "";
		$_SESSION['address']['number'] = "";
		$_SESSION['address']['city'] = "";
		$_SESSION['address']['zipcode'] = "";*/
	}
?>

<html>
<head>
	<title>Oplossing Sessions deel 3: Overzichtpagina</title>
</head>
<body>
	<h1>Overzichtspagina</h1>
	<ul>
		<?php foreach ($_SESSION["registration"] as $key => $value) : ?>
			<li><?= $key . ": " . $value; ?> <a href="opdracht-sessions-deel1-registratiepagina.php">wijzig</a></li>
		<?php endforeach ?>
		<?php foreach ($_SESSION["address"] as $key => $value) : ?>
			<li><?= $key . ": " . $value ?> <a href="opdracht-sessions-deel2-adrespagina.php">wijzig</a></li>
		<?php endforeach ?>
	</ul>
</body>
</html>