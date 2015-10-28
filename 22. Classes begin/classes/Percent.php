<?php 

	class Percent {

		public $absolute, $relative, $hundred, $nominal;

		public function __construct($new, $unit) {
			$this->absolute = $new / $unit;
			$this->relative = $this->absolute - 1;
			$this->hundred = $this->absolute * 100;

			if($this->absolute > 1) {
				$this->nominal = "positive";
			}
			elseif ($this->absolute == 1) {
				$this->nominal = "status-quo";
			}
			elseif ($this->absolute < 1) {
				$this->nominal = "negative";
			}

		}

		public function formatNumber($number){
			$number = number_format($number, 2); // genereert $number met 2 cijfers na de komma
			return $number;
		}




	}

?>