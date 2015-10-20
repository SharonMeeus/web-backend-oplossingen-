<?php
	$text = file_get_contents("cookie.txt");
	/*$array_of_text = explode(",", $text);*/
	$error = "";

	$assoc_array = array();
	$my_array = explode(" ", $text);
	foreach($my_array as $line)
	{
	    $tmp = explode(",", $line);
	    $assoc_array[$tmp[0]] = $tmp[1];
	}

	$users = $assoc_array;

	

	if (isset($_GET["destroy"]))
	{
		if ($_GET["destroy"]==true) 
		{
			setcookie("correctLogin", "loggedout", time()-3600);
			header("Location: opdracht-cookies.php");
		}
	}
	if (isset($_POST['Login']))
	{
		if (isset($_POST['username']) && isset($_POST['password'])) 
		{
			$name = $_POST['username'];

			if (array_key_exists($name, $users) && $_POST['password']==$users[$name]) 
			{
				if ($_POST['remember'] === "checked") {

					setcookie('correctLogin', 'loggedin', time()+30*24*60*60); //expiration date van 30 dagen
					setcookie('username', $_POST['username'], time()+30*24*60*60);

				} else {

					setcookie('correctLogin', 'loggedin', 0); //Cookie vervalt na eindigen sessie
					setcookie('username', $_POST['username'], 0);

				}
				
				header('Location: opdracht-cookies.php');
			} else {

				$error = 'Gebruikersnaam en/of paswoord niet correct. Probeer opnieuw.';

			}
		}
	}

	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht-cookies-Deel1</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
	<body>
		<?php if (isset($_COOKIE['correctLogin']) && $_COOKIE['correctLogin']=='loggedin'): ?>
			<h1>Dashboard</h1>
			<p>Hallo, <?= ucfirst($_COOKIE['username']) ?> fijn dat je er weer bij bent!</p>
			<a href="opdracht-cookies.php?destroy=true">Uitloggen</a>
		<?php else: ?>
			<h1>Inloggen</h1>
			<?php if($error != ""): ?>
				<p>
					<?= $error; ?>
				</p>
			<?php endif; ?>
			<form action="opdracht-cookies.php" method="post">
				<label for="username">Gebruikersnaam:</label><br/>
				<input type="text" name="username" id="username"><br/>
				<label for="password">Paswoord:</label><br/>
				<input type="password" name="password" id="password"><br/>
				<input type="checkbox" name="remember" id="remember" value="checked">
				<label for="remember">mij onthouden</label><br/>
				<input type="submit" name="Login" value="Aanmelden">
			</form>
		<?php endif; ?>
	</body>
</html>