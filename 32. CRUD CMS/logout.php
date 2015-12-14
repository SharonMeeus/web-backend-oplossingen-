<?php
	
	session_start();

	unset($_COOKIE["login"]); //cookie verwijderen, zodat deze niet meer automatisch ingelogd wordt = uitgelogd
	setcookie("login", "", time()-3600);
	$_SESSION["notification"]["type"] = "succes";
	$_SESSION["notification"]["message"] = "U bent uitgelogd. Tot de volgende keer!";

	header("location: login-form.php");
?>