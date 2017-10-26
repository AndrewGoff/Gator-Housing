<?php

	class Database {

		private static $type = DB_TYPE;
		private static $host = DB_HOST;
		private static $name = DB_NAME;
		private static $username = DB_USER;
		private static $password = DB_PASS;
		private static $charset = DB_CHARSET;

		private $pdo;
		private $query;

		public function __construct() {
			$this->pdo = new PDO(self::$type . ':host=' . self::$host . ';dbname=' . self::$name . ';charset=' . self::$charset, self::$username, self::$password);
		}

		public function query($query_str) {
			$this->query = $this->pdo->prepare($query_str);
			$this->query->execute();
		} 

		public function fetch() {
			return $this->query->fetch();
		}

		public function fetchAll() {
			return $this->query->fetchAll();
		}

		public function num_results_from_last_query() {
			return $this->query->rowCount();
		}

	}