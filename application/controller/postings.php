<?php
	
require_once APP . 'model/posting.php';
require_once APP . 'model/postingImage.php';
require_once APP . 'model/location.php';

class Postings extends Controller {

	const MAX_NUM_RESULTS = 10;
	const INDEX_OF_IMAGES_BLOB = 8;

	var $current_query = "";
	var $total_num_pages = 0;
	var $total_results = 0;

	public function all() {
		//echo file_get_contents(APP . '/_data/postings.json');
		$posting = new Posting();
		$postings = $posting->get_all();

		$postings_json_obj = array('postings' => $postings);
		echo json_encode($postings_json_obj);
	}

	public function search_limit($query){
		$this->current_query = $query;
		$posting = new Posting();
		$this->total_results = $posting->like_result_count($query);
		$this->total_num_pages =  floor($this->total_results / self::MAX_NUM_RESULTS) + 1;

		echo json_encode($this->get_all_pages());
	}

	private function get_all_pages() {
		$return_ary = [];

		for($i = 1; $i <= $this->total_num_pages; $i++){
			$temp = "" . $i;
			$return_ary[$temp] = $this->page($i);
		}

		return $return_ary;
		
	}

	public function page($page_num){
		$posting = new Posting();
		
		$start = ($page_num - 1) * self::MAX_NUM_RESULTS;

		$postings = $posting->search_like_limit($this->current_query, $start, self::MAX_NUM_RESULTS);
		$postings_json_obj = array('postings' => $postings);
		$postings_json_obj["pagination"] = $this->create_pagination_array($page_num);
		$postings_json_obj["numResultsOnPage"] = count($postings_json_obj["postings"]);
		return $postings_json_obj;
	}

	private function create_pagination_array($page_num) {
		$return_ary = [];
		if ($page_num > 1){
			$return_ary["previousPageUrl"] = "" . ($page_num - 1);
		}

		if ($page_num < $this->total_num_pages){
			$return_ary["nextPageUrl"] = "" . ($page_num + 1);
		}

		$return_ary["numResults"] = $this->total_results;

		$pages = [];
		for($i = 1; $this->total_num_pages > 1 && $i <= $this->total_num_pages; $i++){
			$temp = array( 
				 "pageUrl" => "" . $i,
				 "pageNum" => "" . $i,
				 "active" => ($i == $page_num)
			);
			$pages[$i - 1] = $temp;
		}

		$return_ary["pages"] = $pages;

		return $return_ary;
	}

	// public function page($page_num) {
	// 	// echo file_get_contents(APP . '_data/postings-page-' . $page_num .'.json');
	// 	$posting = new Posting();
	// 	$postings = $posting->get_all();
	// 	echo $postings;
	// 	return $postings;
	// }

	public function search($query) {
		$posting = new Posting();
		$postings = $posting->search_like($query);
		
		// for($i = 0; $i < count($postings); $i++) {
		// 	$postings[$i]['images']= '/postings/thumbnail/' . $postings[$i]['id'];
		// 	$postings[$i][self::INDEX_OF_IMAGES_BLOB] = '';
		// }

		// $posting_json_obj = array('postings' => $postings);
		$postings_json_obj = array('postings' => $postings);
		echo json_encode($postings_json_obj);
	}
	public function searchMeta($query) {
		$posting = new Posting();
		$postings = $posting->search_meta($query);
		
		// for($i = 0; $i < count($postings); $i++) {
		// 	$postings[$i]['images']= '/postings/thumbnail/' . $postings[$i]['id'];
		// 	$postings[$i][self::INDEX_OF_IMAGES_BLOB] = '';
		// }

		// $posting_json_obj = array('postings' => $postings);
		$postings_json_obj = array('postings' => $postings);
		echo json_encode($postings_json_obj);
	}
	public function get_thumbnail($id) {
		// $this->database->query($this->sql->selectFromWhereOrder('*', 'postingID = ' . $id . 'AND thumbnail = 1', 'DESC'));
		// $thumbnail = $this->database->fetch();
		// return $thumbnail;
		echo '<img src="img/sample-apartment.jpeg"/>';
	}
	public function thumbnail($id) {

		$img = '<img src="img/sample-apartment.jpeg"/>';

		if (isset($id)) {
			$posting_image = new PostingImage();
			$img = '<img src="data:image/jpeg;base64,' . $posting_image->get_thumbnail($id) .'"/>';
		} 
		
		echo $img;
	}

	public function get_detail($id) {
		$posting = new Posting();
		$posting_image = new PostingImage();
		//makes SQL call to grab posting ID
		$postings = $posting->search_like("id = " . $id);
		$posting_image_ids = $posting_image->get_ids_from_posting_id($id);

		if (sizeof($posting_image_ids) < 1) {
			$posting_image_ids = array('0' => array( 'id' => '-1', 'isThumbnail' => 'true', 'index' => '0' ));
		}

		$postings[0]['imageIds'] = $posting_image_ids;

		$postings_json_obj = array('posting' => $postings[0]);
		echo json_encode($postings_json_obj);
		//echo file_get_contents(APP . '/_data/posting-detail.json');
	}

	public function add() {
		$posting = new Posting();
		$posting_id = $posting->add($_POST);

		$location = new Location();
		$location->add($posting_id, $_POST);

		echo "{\"postingID\": \"" . $posting_id . "\"}";
	}

	public function edit($posting_id) {
		$posting = new Posting();
		$posting->edit($posting_id, $_GET);

		$location = new Location();
		$location->edit($posting_id, $_GET);

		echo "{\"postingID\": \"" . $posting_id . "\"}";
	}

}