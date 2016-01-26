<?php
	
	class Mail {

		public $admin, $db;

		public function __construct($admin, $db) 
		{
			$this->admin = $admin;
			$this->db = $db;
		}

		public function getAdmin()
		{
			return $this->admin;
		}

		public function getDBName()
		{
			return $this->db;
		}

	}
?>