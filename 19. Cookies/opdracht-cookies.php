<?php
	$text = file_get_contents("cookie.txt");
	$array_of_text = explode(",", $text);
	$error = "";
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
			if ($_POST['username']==$array_of_text[0] && $_POST['password']==$array_of_text[1]) 
			{
				setcookie("correctLogin",'loggedin', time()+360);
				header('Location: opdracht-cookies.php');
			}
			else
			{
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
			<p>U bent ingelogd.</p>
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
				<input type="submit" name="Login" value="Aanmelden">
			</form>
		<?php endif; ?>
	</body>
</html>