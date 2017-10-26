<?php

	require_once APP . 'libs/database.php';
	require_once APP . 'libs/sqlquery.php';

	class User {

		private $database;
		private $sql;

		public function __construct() {
			$this->database = new Database();
			$this->usersql = new Sql(DB_NAME, 'Users', 
				array('id','password','email', 'firstName', 'lastName'));
		}

		public function add_user($first_name, $last_name, $email, $password_hash){
			$data = array(
				'0' => NULL,
				'1' =>  $password_hash,
			    '2' =>  $email,
			    '3' => $first_name,
			    '4' => $last_name
			);

			$this->database->query($this->usersql->insert($data));
			return $this->database->fetchAll();
		}

		public function get_user($email){
			$this->database->query($this->usersql->findByKey('email', $email));
			return $this->database->fetchAll();
		}

	}
?>