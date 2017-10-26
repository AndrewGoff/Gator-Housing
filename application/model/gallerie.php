<?php

	require_once APP . 'libs/database.php';
	require_once APP . 'libs/sqlquery.php';

	class Gallery{

		private $database;
		private $sql;

		public function __construct() {
			$this->database = new Database();
			$this->sql = new Sql(DB_NAME, 'Posting', array('id','landlordID','title','price','datePosted', 'numViews', 'numTenants', 'description', 'images' ));
		}

		public function get_thumbnail($id) {
			$this->database->query($this->sql->findByKey('id', $id));
			$posting = $this->database->fetch();
			return $posting['images'];
		}
	}




?>