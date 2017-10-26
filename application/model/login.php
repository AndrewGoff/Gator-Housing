<?php

	require_once APP . 'libs/database.php';
	require_once APP . 'libs/sqlquery.php';

	class Login{

		private $database;
		private $sql;

		public function __construct() {
			$this->database = new Database();
			$this->sql = new Sql(DB_NAME, 'Login', array('firstName','lastName','email','password'));
		}

		public function search_like($query) {
			//grabs all that match with the query
			$this->database->query($this->sql->selectFromWhere('*', $query));
			return $this->database->fetchAll();
		}

		public function search_meta($query) {
			//grabs all that match with the query
			$this->database->query($this->sql->selectFromLike('*', $query));
			return $this->database->fetchAll();
		}

		public function get_by_email($email) {
			$this->database->query($this->sql->findByKey('email', $email));
			return $this->database->fetchAll();
		}

		public function add($params) {
			$data = [];

			$data['0'] = '111'; //landlordID
			$data['1'] = $params['firstName']; //first name
			$data['2'] = $params['lastName']; //last name
			$data['3'] = $params['email']; //email
			$data['4'] = $params['passowrd']; //password

			$this->database->query($this->sql->insert($data));
			$this->database->query("SELECT id FROM " . DB_NAME . ".Posting WHERE landlordID=111 ORDER BY datePosted DESC;");
			return $this->database->fetchAll()[0]['id'];
		}
	}
?>
	}
?>
