<?php

	require_once APP . 'libs/database.php';
	require_once APP . 'libs/sqlquery.php';

	class Posting {

		private $database;
		private $sql;

		public function __construct() {
			$this->database = new Database();
			$this->sql = new Sql(DB_NAME, 'Posting', array('id','landlordID','title','price', 'numViews', 'numTenants', 'description', 'zip','metadata', 'city', 'numBed', 'numBath'));
		}

		public function search_like($query) {
			//grabs all postings that match with the query
			$this->database->query($this->sql->selectFromWhere('*', $query));
			return $this->database->fetchAll();
		}

		public function like_result_count($query) {
			$this->database->query($this->sql->selectFromLike('*', $query));
			return $this->database->num_results_from_last_query();
		}

		public function search_like_limit($query, $start, $num_results) {
			$this->database->query($this->sql->selectFromLikeLimit('*', $query, $start, $num_results));

			return $this->database->fetchAll();
		}

		public function search_meta($query) {
			//grabs all postings that match with the query
			$this->database->query($this->sql->selectFromLike('*', $query));
			return $this->database->fetchAll();
		}
		
		public function get_all() {
			//grabs all total postings in the server
			$this->database->query($this->sql->selectAll());
			return $this->database->fetchall();
		}

		public function get_thumbnail($id) {
			$this->database->query($this->sql->findByKey('id', $id));
			$posting = $this->database->fetch();
			return $posting['images'];
		}

		public function get_landlord($id) {
			$this->database->query($this->sql->findByKey('id', $id));
			$posting = $this->database->fetch();
			return $posting['landlordID'];
		}
		
		public function getMostPopular() {
			//grabs all postings that match with the query
			$this->database->query($this->sql->selectFromWhere('*', $query));
			return $this->database->fetchAll();
		}

		public function getRecentlyAdded() {
			//grabs all postings that match with the query
			$this->database->query($this->sql->selectFromWhere('*', $query));
			return $this->database->fetchAll();
		}

		public function get_by_landlord($landlord_id) {
			$this->database->query($this->sql->findByKey('landlordID', $landlord_id));
			return $this->database->fetchAll();
		}

		public function get_by_id($id) {
			$this->database->query($this->sql->findByKey('id', $id));
			return $this->database->fetchAll();
		}

		public function add($params) {
			$data = [];


			$data['0'] = NULL;
			$data['1'] = '111'; //landlordID
			$data['2'] = $params['title']; //title
			$data['3'] = $params['price']; //price
			$data['4'] = 0; //numViews
			$data['5'] = $params['numTenants']; //numTenants
			$data['6'] = $params['description']; //description
			$data['7'] = $params['zip']; // numBed
			$data['8'] = '';// $params['metadata']; TODO
			$data['9'] = $params['city']; //description
			$data['10'] = $params['numBed']; // numBed
			$data['11'] = $params['numBath']; // numBath

			$this->database->query($this->sql->insert($data));

			// get new posting id
			// TODO: get landlordID from Sessions 
			$this->database->query("SELECT id FROM " . DB_NAME . ".Posting WHERE landlordID=111 ORDER BY date DESC;");

			$postings = $this->database->fetchAll();

			if (is_array($postings) && sizeof($postings) > 0) {
				return $postings[0]['id'];
			}
			return '';
		}

		public function edit($posting_id, $params) {
			$data = [];

			$data['landlordID'] = '111'; //landlordID
			$data['title'] = $params['title']; //title
			$data['price'] = $params['price']; //price
			$data['numViews'] = 0; //numViews
			$data['numTenants'] = $params['numTenants']; //numTenants
			$data['description'] = $params['description']; //description
			$data['zip'] = $params['zip']; // numBed
			$data['metadata'] = '';//$params['metadata']; // numBath
			$data['city'] = $params['city']; //description
			$data['numBed'] = $params['numBed']; // numBed
			$data['numBath'] = $params['numBath']; // numBath

			$this->database->query($this->sql->update($data, 'id', $posting_id));
		}
	}
?>