<?php 
	$rijen = 10;
	$kolommen = 10;

	//Opdracht 3
	$maaltafels = array();

	for($a = 0; $a <= 10; $a++) {
		$producten = array();
		for($b = 0; $b <= $kolommen; $b++) {
			$producten[] = $a*$b;
		}

		$maaltafels[$a] = $producten;
	}
?>
<!doctype html>
<html>
<head>
	<title>Opdracht Looping Statements For</title>
</head>
<body>

	<style>
            .oneven
            {
                background-color    :   lightgreen;
            }
    </style>
	<h1>Opdracht for: deel 1</h1>

	<table>
	 	<?php for($a = 0; $a < $rijen; $a++): ?>
	 		<tr>
	 			<?php for($b = 0; $b < $kolommen; $b++): ?>
	 				<td>kolom</td>
	 			<?php endfor ?>
	 		</tr>
	 	<?php endfor ?>
	</table>

	<h1>Opdracht for: deel 2</h1>

	<table>
 		<?php for($a = 0; $a <= $rijen; $a++): ?>
 			<tr>
 				<?php for($b = 0; $b <= $kolommen; $b++ ): ?>
 					<?php if(($a * $b) % 2 != 0): ?>	
 						<td class="oneven"><?php echo $a * $b ?></td>
 					<?php else: ?>
						<td><?php echo $a * $b ?></td>
					<?php endif ?>
 				<?php endfor ?>
 			</tr>
 		<?php endfor ?>
	</table>

	<h1 class="extra">Opdracht for: deel3 - uitbreiding</h1>
	<?php print_r($maaltafels) ?>

	<h1 class="extra">Opdracht for: deel4 - uitbreiding</h1>
	<table>
		<thead>
			<th>Tafel</th>
			<?php for ( $a = 0; $a <= $rijen; $a++): ?>
					
					<th><?= $a ?></th>
					
			<?php endfor ?>
		</thead>
		<tbody>
	 		<?php for($a = 0; $a <= $rijen; $a++): ?>
	 			<tr>
	 				<?php for($b = 0; $b <= $kolommen; $b++ ): ?>
	 					<?php if(($a * $b) % 2 != 0): ?>	
	 						<td class="oneven"><?php echo $a * $b ?></td>
	 					<?php else: ?>
							<td><?php echo $a * $b ?></td>
						<?php endif ?>
	 				<?php endfor ?>
	 			</tr>
	 		<?php endfor ?>
 		</tbody>
	</table>

</body>
</html>