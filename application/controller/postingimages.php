<?php
	
require_once APP . 'model/postingImage.php';

class PostingImages extends Controller {
	public function add() {
		$posting_image = new PostingImage();
		$posting_image->add($_FILES, $_POST);
	}

	public function get() {
		$id = $_GET['id'];

		if ($id < 0) {
			echo '<img src="img/sample-apartment.jpeg"/>';
		} else {
			$posting_image = new PostingImage();
			$image_data = $posting_image->get($id);
			echo '<img src="data:image/jpeg;base64,' . $image_data . '"/>';
		}

	}

}