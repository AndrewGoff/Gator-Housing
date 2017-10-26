<?php

	require_once APP . 'libs/database.php';
	require_once APP . 'libs/sqlquery.php';

	class Sidebar {

		private $database;
		private $sql;

		public function __construct() {
			$this->database = new Database();
			$this->sql = new Sql(DB_NAME, 'Posting', array('id','landlordID','title','price','date', 'numViews', 'numTenants', 'description', 'zip','images','metadata', 'city'));
		}

		// public function get_thumbnail($id) {
		// 	$this->database->query($this->sql->selectFromWhereOrder('*', 'images = '$id 'AND thumbnail = 1', 'DESC'));
		// 	$thumbnail = $this->database->fetch();
		// 	return $thumbnail;
		// }

		public function get_favorites(){

		}
		
		/*	SELECT *
				FROM DB_NAME.Posting
				ORDER BY numViews DESC
		*/	
		// public function get_most_viewed_posts(){
		// 	$this->database->query($this->sql->selectFromOrder('*', 'numViews DESC'));
		// 	return $this->database->fetchAll();
		// }

		public function get_most_viewed_posts(){
			$this->database->query($this->sql->select('*'));
			return $this->database->fetchall();
			//print_r($result);
		}

		/*	finds cookie, decodes and returns JSON object	*/
		// public function get_recently_viewed_posts(/* array of ids */$recently_viewed_array){
		// 	$cookie = $_COOKIE["cookie_name_here"];
		// 	return json_encode(base64_decode($cookie));

		// }

		/*	SELECT * 
				FROM DB_NAME.Posting
				WHERE datePosted < NOW()
				ORDER BY datePosted DESC
		*/
		public function get_newest_posts(){
			$this->database->query($this->sql->selectFromWhereOrder('*', 'datePosted < NOW()','datePosted DESC'));
			return $this->database->fetchAll();
		}

		public function get_nearby_posts($location){
			/* TODO: Use Google Maps Distance Matrix API to find zipcodes near $location
					 Search Database for those zipcodes
					 return top 10 posts
			*/

		}

	}
?>