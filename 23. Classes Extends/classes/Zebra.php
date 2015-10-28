<?php 
	
	class Zebra extends Animal {

		protected $species;

		public function __construct( $name, $gender, $health, $species )
		{
			parent::__construct( $name, $gender, $health );

			$this->species = $species;
		}

		public function getSpecies() { // Ook hier weer nodig om aan species te geraken van buitenaf.
			return $this->species;
		}
	}
?>