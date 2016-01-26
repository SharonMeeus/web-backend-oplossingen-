<?php
	
	session_start();

	$outputstring = "";

	if(isset($_POST["check"]))
	{
		if(isset($_POST["RegEx"]) && isset($_POST["string"]))
		{
			$_SESSION["RegEx"] = $_POST["RegEx"];
			$_SESSION["string"] = $_POST["string"];

			$RegEx = $_SESSION["RegEx"];
			$replaceString = "<span class ='red'>#</span>";
			$exampleString = $_SESSION["string"];

			$outputstring = "Resultaat: " . preg_replace("/".$RegEx."/", $replaceString, $exampleString);

			// DEEL 2
			// alle letters tussen a-d en u-z
			//$outputstring = preg_replace("/[a-dA-Du-zU-Z]/", $replaceString, $exampleString);

			//match zowel colour als color
			//$outputstring = preg_replace("/colour|color/", $replaceString, $exampleString);

			//match enkel getallen die 1 als duizendtal hebben
			//$outputstring = preg_replace("/1[0-9][0-9][0-9]/", $replaceString, $exampleString);

			//match zodat enkel een reeks "en" overblijft
			//$outputstring = preg_replace("/[^e*n]/", $replaceString, $exampleString);
		}
	}
?>

<html>
<head>
	<title>Regular Expressions</title>
	<style type="text/css">
		.red
		{
			color: red;
		}

		textarea
		{
			width: 200px;
			height: 100px;
		}
	</style>
</head>
<body>
	<h1>RegEx tester</h1>

	<form id="regexform" method="post" action="Regular Expressions.php">
		<label>Regular Expression</label> <br/>
		<input type="text" name="RegEx" value="<?= (isset($_SESSION['RegEx']) ? $_SESSION['RegEx'] : '') ?>"> <br/>
		<label>String</label> <br/>
		<textarea name="string" value="<?= (isset($_SESSION['string']) ? $_SESSION['string'] : '') ?>"></textarea> <br/>
		<button name="check" type="submit">Check RegEx</button>
		<p><?= $outputstring?></p>
	</form>
</body>
</html>