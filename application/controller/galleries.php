<?php

require_once APP . 'model/posting.php';

class Galleries extends Controller {

	const INDEX_OF_IMAGES_BLOB = 8;

	public function search($query) {
		$posting = new Gallery();
		$postings = $posting->search($query);
		
		for($i = 0; $i < count($postings); $i++) {
			$postings[$i]['images']= '/postings/thumbnail/' . $postings[$i]['id'];
			$postings[$i][self::INDEX_OF_IMAGES_BLOB] = '';
		}

		$posting_json_obj = array('postings' => $postings);
		echo json_encode($posting_json_obj);
	}



	public function thumbnail($id) {
		if (isset($id)) {
			$posting = new Gallery();
			$images = $posting->get_all_thumbnails($id);
			foreach($images as $image){
				echo '<img src="data:image/jpeg;base64,'.base64_encode($image).'"/>';
			}	
		}
	}


}
