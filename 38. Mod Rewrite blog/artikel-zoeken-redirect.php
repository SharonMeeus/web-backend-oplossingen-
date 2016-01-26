<?php 
	
	session_start();

	$pathname = $_SERVER['REQUEST_URI'];
	$pos = strpos($pathname, "artikels/"); // positie van woord artikels/ zoeken
	$endpoint = $pos + strlen("artikels/");
	$base = substr($pathname,0,$endpoint);	
	
	if(isset($_GET["zoekterm"]) && trim($_GET["zoekterm"]) != "" )
	{
		$searchquery = $_GET["zoekterm"];
		$linkcontent = $base . "zoeken/content/" . $searchquery . "/";
		header("Location: " . preg_replace('/([^:])(\/{2,})/', '$1/', $linkcontent));
	}

	elseif(isset($_GET["zoekjaar"]) && trim($_GET["zoekjaar"]) != "")
	{
		if(is_numeric($_GET["zoekjaar"]) && (int)$_GET["zoekjaar"] >= 2000  && (int)$_GET["zoekjaar"] < 2017)
		{
			$searchquery = $_GET["zoekjaar"];
			$linkdatum = $base . "zoeken/datum/" . $searchquery . "/";
			header("Location: " . preg_replace('/([^:])(\/{2,})/', '$1/', $linkdatum));

		} else {

			$_SESSION["notification"]["type"] = "error";
			$_SESSION["notification"]["message"] = "Gelieve een jaar in te geven" . $pathname; 
			header("Location: " . preg_replace('/([^:])(\/{2,})/', '$1/', $base));
		}
	}

	else
	{
		$_SESSION["notification"]["type"] = "error";
		$_SESSION["notification"]["message"] = "Gelieve een zoekterm in te geven"; 
		header("Location: " . preg_replace('/([^:])(\/{2,})/', '$1/', $base));
	}

?>