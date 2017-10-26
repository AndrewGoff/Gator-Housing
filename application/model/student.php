<?php

	require_once APP . 'libs/database.php';
	require_once APP . 'libs/sqlquery.php';

	class Student {

		private $database;
		private $sql;

		public function __construct() {
			$this->database = new Database();
			$this->sql = new Sql(DB_NAME, 'Students', array('userID'));
		}

		public function get_student($id){
			$this->database->query($this->sql->findByKey("userID", $id));
			return $this->database->fetchAll();
		}

		public function add_student($id){
			$this->database->query($this->sql->insert(array('0' => $id)));
		}
	}
?>