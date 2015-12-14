<?php 
	
	session_start();

	$showcontent = false;
	$message = "";

	if(isset($_SESSION["notification"]))
	{
		$message = $_SESSION["notification"]["message"];
	}

	if(!isset($_COOKIE["login"]))
	{
		$_SESSION["notification"]["type"] = "error";
		$_SESSION["notification"]["message"] = "U moet eerst inloggen";
		header('location: login-form.php');
	}
	else
	{
		$cookie = explode(", ", $_COOKIE["login"]);
		$usermail = $cookie[0];
		$saltmail = $cookie[1];

		try 
		{
			$db = new PDO('mysql:host=localhost;dbname=users', 'root', 'admin');	
			$statement = $db->query("SELECT users.salt FROM users WHERE users.email = '$usermail'");
			$salt = $statement->fetchColumn();

			if(hash('sha256', $usermail . $salt) == $saltmail)
			{
				$showcontent = true;
			}
			else
			{
				unset($_COOKIE["login"]);
				header('location: login.php');
			}
		} 
		catch (Exception $e)
		{
			$_SESSION["notification"]["type"] = "error";
			$_SESSION["notification"]["message"] = "Er is iets mis met de database. Probeer eventueel later opnieuw.";	
			header('location: login.php');
		}
	}
?>

<html>
<head>
	<title>Dashboard</title>
</head>
<body>
	<?php if($showcontent) : ?>
		<h1>Dashboard</h1>
		<p><?= $message ?></p>
		<p><a href="logout.php">Uitloggen</a></p>
	<?php endif ?>
</body>
</html>