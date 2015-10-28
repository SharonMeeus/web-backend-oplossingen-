<?php 
	
	class Lion extends Animal {
		
		protected $species;

		public function __construct( $name, $gender, $health, $species )
		{
			parent::__construct( $name, $gender, $health ); //de constructor van de parent aanroepen om name, gender en health mee te krijgen

			$this->species = $species;
		}

		public function getSpecies() { // Hier is deze functie nodig omdat $species protected is en dus in de applicatie niet zonder een return-functie kan worden opgeroepen
			return $this->species;
		}

		public function doSpecialMove() { // doSpecialMove wordt hier eigenlijk gewoon overgeschreven
			return "roar";
		}
	}
?>