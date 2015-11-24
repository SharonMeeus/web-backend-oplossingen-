<?php 
// wijzigen afmaken
// $no_do en $no_done functionaliteit??
// verwijderen (via unset, zie php manual)
// styling


// De status van elk item moet bewaard worden, dus beter werken met sessions
	
	session_start();
	//unset($_SESSION['todos']);

	$a = false;
	$b = array();

	$error = false;

	$no_do = true;
	$no_done = true;



	// Eerst checken of er gesubmit is en als er iets is ingevuld in input_todo → dit toevoegen aan session
	if(isset($_POST["submit_todo"]))
	{
		if(isset($_POST["input_todo"]) && $_POST["input_todo"] != "" )
		{
			// We gaan elk item een "do" waarde geven om te kunnen wisselen tussen do en done.
			$array_w_status = array($_POST["input_todo"] => "do");
			// Dit gaan we dan in een session moeten steken om de status te onthouden.
			// Een multidimensionale array om zo ELK item en status te onthouden. Anders kan er maar één array in.
			$_SESSION['todos'][] = $array_w_status;
			$no_do = false;
		}

		else 
		{
			$error = true; // Als er niets is ingevuld → error weergeven
		}
	}

	//Als een item van todo gewijzigd wordt naar done
	if(isset($_POST["todo_wijzigen"]))
	{
		// Het item in het session-object zoeken aan de hand van de value van de button en de session key
		foreach ($_SESSION["todos"] as $key => $array) 
		{
			// Hier dus de session doorzoeken tot de key matcht met de value
			if($_POST["todo_wijzigen"] == $key)
			{
				// do naar done wijzigen en omgekeerd
			}
		}
	}


?>

<html>
	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Todo App</title>	
	</head>
	<body>
		<div id="content">
			<p><?php var_dump($_SESSION["todos"]); ?></p>
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
							<?php if($status == "do") : ?> <!-- Enkel de items met de status "do" willen we in deze lijst tonen. -->
								<li>
									<form action="Todo_app.php" method="post">
										<button title="status wijzigen" name="todo_wijzigen" value="<?= $key ?>" class="todo"> <!-- value moet de key zijn om te weten welk item in de session veranderd moet worden -->
											<?= $value ?>
										</button>
										<button title="verwijderen" name="todo_verwijderen" value="0">
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
							<?php if($status == "done") : ?> <!-- Enkel de items met de status "done" willen we in deze lijst tonen. -->
								<li>
									<form action="Todo_app.php" method="post">
										<button title="status wijzigen" name="done_wijzigen" value="<?= $key ?>" class="todo"> <!-- value moet de key zijn om te weten welk item in de session veranderd moet worden -->
											<?= $value ?>
										</button>
										<button title="verwijderen" name="done_verwijderen" value="0">
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