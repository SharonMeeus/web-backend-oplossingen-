<?php 
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
			<li><?= $key . ": " . $value; ?></li><a href="">wijzig</a>
		<?php endforeach ?>
	</ul>
</body>
</html>