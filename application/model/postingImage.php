<?php

	require_once APP . 'libs/database.php';
	require_once APP . 'libs/sqlquery.php';

	class PostingImage{

		private $database;
		private $sql;

				public function __construct() {
			$this->database = new Database();
			$this->sql = new Sql(DB_NAME, 'PostingImage', array('postingID','image','isThumbnail'));
		}

		public function add($files, $params) {

			for($i = 0; $i < sizeof($files['images']['tmp_name']); $i++) {
				$image_path = $_FILES['images']['tmp_name'][$i];

				$data = [];

				$data['0'] = $params['postingID'];
				$data['1'] = addslashes(file_get_contents($image_path));
				$data['2'] = ($i === 0) ? 1 : 0;

				$this->database->query($this->sql->insert($data));
				$this->database->fetch();
			}
		}

		public function get_thumbnail($id) {
			$this->database->query($this->sql->findByKey('postingID', $id));
			$postings = $this->database->fetchAll();
			$posting_image = '';

			foreach($postings as $i => $posting) {
				if ($posting['isThumbnail'] === '1') {
					$posting_image = base64_encode($posting['image']);
				}
			}

			return $posting_image;
		}

		public function get($id) {
			$this->database->query($this->sql->findByKey('id', $id));
			$posting = $this->database->fetch();
			return base64_encode($posting['image']);
		}

		public function get_ids_from_posting_id($posting_id) {
			$this->database->query($this->sql->findByKey('postingID', $posting_id));
			$postings = $this->database->fetchAll();
			$posting_image_ids = [];

			foreach($postings as $i => $posting) {
					$posting_image_ids[$i] = array(
							'id' => $posting['id'],
							'isThumbnail' => $posting['isThumbnail'] === '1',
							'index' => $i
						);
			}

			return $posting_image_ids;
		}
	}

?>