<?php

require_once APP . 'model/sidebar.php';


class Sidebars extends Controller {

	const INDEX_OF_IMAGES_BLOB = 8;

	public function all() {
		echo file_get_contents(APP. '_data/postings.json');
	}

	public function favorites() {
		echo file_get_contents(APP. '_data/favorite-postings.json');
	}

	public function most_recent() {
		echo file_get_contents(APP. '_data/most-recent-postings.json');
	}

	// public function search($query) {
	// 	$posting = new Posting();
	// 	$postings = $posting->search($query);

	// 	for($i = 0; $i < count($postings); $i++) {
	// 		echo $postings[$i]['id'];
	// 		// $image = new PostingImage();
	// 		// $image = $image->get_thumbnail($postings[$i]['id']);
	// 		//$postings[$i]['images']= '/postings/thumbnail/' . $postings[$i]['id'];
	// 		//$postings[$i][self::INDEX_OF_IMAGES_BLOB] = '';
	// 	}

	// 	$posting_json_obj = array('postings' => $postings);
	// 	echo json_encode($posting_json_obj);
	// }


	//not sure if this is right
	public function most_viewed(){
		$temp = new Sidebar();
		$sidebar = $temp->get_most_viewed_posts();

		// for($i = 0; $i < count($sidebar); $i++) {
		// 	//$sidebar[$i]['images']= '/postings/thumbnail/' . $sidebar[$i]['id'];
		// 	// $posting = new Posting();
		// 	// $image = $posting->get_thumbnail($postings[$i]['id']);
		// 	// echo $images;
		// 	//$sidebar[$i][self::INDEX_OF_IMAGES_BLOB] = '';
		// 	echo "something";
		// }

		$sidebar_json_obj = array('postings' => $sidebar);
		echo json_encode($sidebar_json_obj);
	}

	// public function most_recent(){
	// 	$sidebar = new Sidebar();
	// 	$sidebar = $sidebar->get_recently_viewed_posts();

	// 	for($i = 0; $i < count($sidebar); $i++) {
	// 		$sidebar[$i]['images']= '/postings/thumbnail/' . $sidebar[$i]['id'];
	// 		$sidebar[$i][self::INDEX_OF_IMAGES_BLOB] = '';
	// 	}

	// 	$sidebar_json_obj = array('postings' => $sidebar);
	// 	echo json_encode($sidebar_json_obj);
	// }

	// public function display_newest_posts(){
	// 	$sidebar = new Sidebar();
	// 	$sidebar = $sidebar->get_newest_posts();

	// 	for($i = 0; $i < count($sidebar); $i++) {
	// 		$sidebar[$i]['images']= '/postings/thumbnail/' . $sidebar[$i]['id'];
	// 		$sidebar[$i][self::INDEX_OF_IMAGES_BLOB] = '';
	// 	}

	// 	$sidebar_json_obj = array('postings' => $sidebar);
	// 	echo json_encode($sidebar_json_obj);
	// }

	// public function display_nearby(){
	// 	$sidebar = new Sidebar();
	// 	$sidebar = $sidebar->get_nearby_posts();

	// 	for($i = 0; $i < count($sidebar); $i++) {
	// 		$sidebar[$i]['images']= '/postings/thumbnail/' . $sidebar[$i]['id'];
	// 		$sidebar[$i][self::INDEX_OF_IMAGES_BLOB] = '';
	// 	}

	// 	$sidebar_json_obj = array('postings' => $sidebar);
	// 	echo json_encode($sidebar_json_obj);
	// }
	//figure out 

	public function thumbnail($id) {
		// if (isset($id)) {
		// 	$posting = new Posting();
		// 	$img = '<img src="data:image/jpeg;base64,'.base64_encode( $posting->get_thumbnail($id) ).'"/>';
		// 	echo $img;
		// }
	}

}