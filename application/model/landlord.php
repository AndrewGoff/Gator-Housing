<?php

	require_once APP . 'libs/database.php';
	require_once APP . 'libs/sqlquery.php';

	class Landlord {

		private $database;
		private $sql;

		public function __construct() {
			$this->database = new Database();
			$this->sql = new Sql(DB_NAME, 'Landlords', array('id'));
		}

		public function get_landlord($id){
			$this->database->query($this->sql->findByKey("id", $id));
			return $this->database->fetchAll();
		}
	}
?>