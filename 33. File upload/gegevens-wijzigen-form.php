<?php
	
	session_start();

	$email = "";
	$message = "";
	$tumbnail = "";

	if(isset($_SESSION["data"]))
	{
		$tumbnail = $_SESSION["data"]["profielfoto"];
	}

	if(isset($_COOKIE["login"]))
	{
		$cookie = explode(", ", $_COOKIE["login"]); // de mail en de gehashte code splitsen en in een $cookie array steken
		$email = $cookie[0];
	}
	else
	{
		$_SESSION["notification"]["type"] = "error";
		$_SESSION["notification"]["message"] = "U moet eerst inloggen";
		header('location: login-form.php');
	}

	if(isset($_SESSION["notification"]))
	{
		$message = $_SESSION["notification"]["message"];
		//$_SESSION["notification"]["message"] = "";
	}

	try
	{
		$db = new PDO('mysql:host=localhost;dbname=fileupload', 'root', 'admin');
		$query = "SELECT * FROM users WHERE email = '$email'";

		$statement=$db->prepare($query);
		$statement->execute();

		$fetchAssoc = array();

		while ( $row = $statement->fetch(PDO::FETCH_ASSOC) ) // de waarden uit onze db halen
		{
			$fetchAssoc[]	=	$row; // de waarden in de array steken.
		}

		
	}
	catch(Exception $e)
	{
		$_SESSION["notification"]["type"] = "error";
		$_SESSION["notification"]["message"] = "Er is iets mis met de database. Probeer opnieuw.";
		header("location: gegevens-wijzigen-form.php");
	}
?>

<html>
<head>
	<title>Gegevens wijzigen</title>
	<style>
	    .profielfoto
	    {
	        max-width:400px;
	        margin: 16px 0px;
	        display:block;
	    }
	    .tumb
		{
			max-height: 50px;
			vertical-align: middle;
			margin-right: 10px;
		}
	    ul
	    {
	    	list-style-type: none;
	    	padding: 0;
	    }
    </style>

</head>
<body>
	<p><img class="tumb" src="img/<?= ($tumbnail != "") ? $tumbnail : "elon-musk-koraynergiz.jpg"  ?>"> Ingelogd als <?= $email ?> | <a href="dashboard.php">Terug naar dashboard</a> | <a href="logout.php">uitloggen</a></p>
	<h1>Gegevens wijzigen</h1>
	<p><?= $message ?></p>
	<form action="gegevens-bewerken.php" method="post" enctype="multipart/form-data"> 
	    <?php foreach($fetchAssoc as $key => $array) : ?>        
	        <ul>
	            <li>
	                <label>Profielfoto
	                    <img class="profielfoto" src="img/<?= ($array['profile_picture'] == "") ? 'elon-musk-koraynergiz.jpg' : $array['profile_picture'] ?>" alt="Profielfoto">
	                </label>
	                <input type="file" id="profielfoto" name="profielfoto">
	            </li>
	            <br/>
	            <li>
	                <label for="email">e-mail</label> 
	                <input type="text" id="email" name="email" value="<?= $email ?>">
	            </li>
	        </ul>
	        <button type="submit" name="gegevens_wijzigen">Gegevens wijzigen</button>
	    <?php endforeach ?>
    </form>



</body>
</html>