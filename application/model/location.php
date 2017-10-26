<?php

	require_once APP . 'libs/database.php';
	require_once APP . 'libs/sqlquery.php';

	class Location{

		private $database;
		private $sql;

		public function __construct() {
			$this->database = new Database();
			$this->sql = new Sql(DB_NAME, 'Location', array('postingID','streetNum','streetName','city', 'zip'));
		}

		public function add($posting_id, $params) {
			$data = [];

			$data['0'] = $posting_id; //postingID
			$data['1'] = $params['streetNum']; //streetNum
			$data['2'] = $params['streetName']; //streetName
			$data['3'] = $params['city']; //city
			$data['4'] = $params['zip']; // numBed

			$this->database->query($this->sql->insert($data));
		}

		public function edit($posting_id, $params) {
			$data = [];

			$data['0'] = $posting_id; //postingID
			$data['1'] = $params['streetNum']; //streetNum
			$data['2'] = $params['streetName']; //streetName
			$data['3'] = $params['city']; //city
			$data['4'] = $params['zip']; // numBed

			$this->database->query($this->sql->update($data, 'postingID', $posting_id));
		}

		public function get($posting_id) {
			$this->database->query($this->sql->findByKey('postingID', $posting_id));
			return $this->database->fetch();
		}
	}

?>