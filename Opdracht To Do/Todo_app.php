<?php 

// array veranderd in: array("value" => $_POST["input_todo"], "status" => true/false) Op deze manier kan je nog vele andere waarden toevoegen
// → do of don't in false of true omzetten
// doordat je de do/don't omzet naar een boolean kan je gewoon werken met $_SESSION["todos"][$key] != $_SESSION["todos"][$key] zonder if - elseif


// De status van elk item moet bewaard worden, dus beter werken met sessions
	
	session_start();

	$a = false;
	$b = array();
	$no_do = true;
	$no_done = true;
	$aant_do = 0;
	$aant_done = 0;
	//unset($_SESSION["todos"]);

	$error = false;

	// Eerst checken of er gesubmit is en als er iets is ingevuld in input_todo → dit toevoegen aan session
	if(isset($_POST["submit_todo"]))
	{
		if(isset($_POST["input_todo"]) && $_POST["input_todo"] != "" )
		{
			// We gaan een assoc array maken met als value wat je moet doen/gedaan hebt en als status true/false (todo/done). Zo kan je ook nog een datum of prioriteit meegeven
			$array_w_status = array("value" => $_POST["input_todo"], "status" => true);
			// Dit gaan we dan in een session moeten steken om de status te onthouden.
			// Een multidimensionale array om zo ELK item en status te onthouden. Anders kan er maar één array in.
			$_SESSION['todos'][] = $array_w_status;
		}

		else 
		{
			$error = true; // Als er niets is ingevuld → error weergeven
		}
	}

	//Als een item gewijzigd wordt
	if(isset($_POST["todo_wijzigen"]))
	{
		// Het item in het session-object zoeken aan de hand van de value van de button en de session key
		foreach ($_SESSION["todos"] as $key => $array) 
		{
				// Hier dus de session doorzoeken tot de key matcht met de value
				if($_POST["todo_wijzigen"] == $key)
				{	
					//Doordat we met een assoc array werken, kan je gwn de naam opzoeken en deze wijzigen (geen dubbele foreach)
					$_SESSION["todos"][$key]["status"] = !$_SESSION["todos"][$key]["status"];
				}
		}
	}

	// Verwijderen proberen via unset. Dus we moeten eerst de array vinden adhv de key.
	// Dus eerst kijken of er op de knop verwijderen is gedrukt
	if(isset($_POST["todo_verwijderen"]))
	{
		foreach ($_SESSION["todos"] as $key => $array) // Hier dan de keys van de arrays verkrijgen
		{
			if($_POST["todo_verwijderen"] == $key) // Als de value van de button matcht met de key, dan moet je deze verwijderen.
			{
				unset($_SESSION["todos"][$key]);
			}
		}	
	}

	// voor no_do en no_done moeten we eerst kunnen kijken of er nog een do of done in onze session zit → we moeten kijken naar de status
	// Dus je moet kijken of de waarde van het AANTAL do's of done groter is dan 0. Anders moet no_do en no_done op false
	if(isset($_SESSION["todos"]))
	{
		foreach ($_SESSION["todos"] as $key => $array) 
		{	
			($array["status"]) ? $aant_do++ : $aant_done++;
			
			$no_do = ($aant_do == 0) ? true : false ;
			$no_done = ($aant_done == 0) ? true: false ;	
		}	
	}




?>

<html>
	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Todo App</title>	
	    <link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div id="content">

			<!-- Als $_POST("input_todo") leeg is... -->
			<!-- elke keer checken wanneer er wordt gesubmit -->
			<?php if($error == true) : ?>
				<p class="error">Ahh, damn. Lege todos zijn niet toegestaan...</p>
			<?php endif ?>
			<h1>Todo app</h1>
			<!-- Hier een if voor als er geen to do's of done zijn → kijken of de arrays leeg zijn -->
			<?php if($no_do && $no_done) : ?>
				<p>Je hebt nog geen TODO's toegevoegd. Zo weinig werk of meesterplanner?</p>
			<?php else : ?>
			<!-- Else -->
				<h2>Nog te doen</h2>
				<!-- Als (if) er geen to do's meer zijn (dus enkel done) -->
				<?php if($no_do) : ?>
					<p>Schouderklopje, alles is gedaan!</p>
				<?php else : ?>
				<!-- Anders -->
				<ul>
					<!-- Hier ipv gewone array met session object werken -->
					<!-- Een lijstje met de to do's (via een foreach) inclusief buttons verwijder en status aanpassen -->
					<?php foreach($_SESSION["todos"] as $key => $array) : ?> <!-- waarbij de array gwn de array met het item en de status -->
						<?php foreach ($array as $value => $status) : ?> <!-- value is het item, en de status "do" of "done" -->
							<?php if($status === true) : ?> <!-- Enkel de items met de status "do" willen we in deze lijst tonen. -->
								<li>
									<form action="Todo_app.php" method="post">
										<button title="status wijzigen" name="todo_wijzigen" value="<?= $key ?>" class="status not-done"> <!-- value moet de key zijn om te weten welk item in de session veranderd moet worden -->
											<?= $array["value"] ?>
										</button>
										<button title="verwijderen" name="todo_verwijderen" value="<?= $key ?>">
										</button>
									</form>
								</li>
							<?php endif ?>
						<?php endforeach ?>
					<?php endforeach ?>
				</ul>
				<?php endif ?>

				<h2>Done and done!</h2>
				<!-- Als(if) er niks done is  -->
				<?php if($no_done) : ?>	
					<p>Werk aan de winkel...</p>
				<!-- Anders(else) -->
				<?php else : ?>
					<ul>
					<!-- Hier ipv gewone array met session object werken -->
					<!-- Een lijstje met de to do's (via een foreach) inclusief buttons verwijder en status aanpassen -->
					<?php foreach($_SESSION["todos"] as $key => $array) : ?> <!-- waarbij de array gwn de array met het item en de status -->
						<?php foreach ($array as $value => $status) : ?> <!-- value is het item, en de status "do" of "done" -->
							<?php if($status === false) : ?> <!-- Enkel de items met de status "done" willen we in deze lijst tonen. -->
								<li>
									<form action="Todo_app.php" method="post">
										<button title="status wijzigen" name="todo_wijzigen" value="<?= $key ?>" class="status done"> <!-- value moet de key zijn om te weten welk item in de session veranderd moet worden -->
											<?= $array["value"] ?>
										</button>
										<button title="verwijderen" name="todo_verwijderen" value="<?= $key ?>">
										</button>
									</form>
								</li>
							<?php endif ?>
						<?php endforeach ?>
					<?php endforeach ?>
				</ul>
				<?php endif ?>
			<?php endif ?>
			<!-- end if -->

			<h1>Todo toevoegen</h1>
			<form action="Todo_app.php" method="post"> 
				<label>Beschrijving:</label> <!-- NIET meer vergeten labels toe te voegen aan forms! -->
				<input type="text" name="input_todo"/>
				<br/>
				<input type="submit" name="submit_todo" value="Toevoegen"/>
			</form>
		</div>
	</body>
</html>