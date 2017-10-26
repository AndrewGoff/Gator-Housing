<?php
	
require_once APP . 'model/posting.php';
require_once APP . 'model/message.php';
require_once APP . 'model/location.php';
require_once APP . 'model/session.php';
require_once APP . 'model/user.php';

class Landlords extends Controller {

	public function all() {
		$session = new Session();
		$user = new User();

		$username = (($user->get_user($session->get_email()))[0])[3]; // eventually obtained by session data
		$landlord_id = $session->get_id();
		$posting = new Posting();
		$postings = self::append_messages($posting->get_by_landlord($landlord_id));
		$postings_json_obj = array('postings' => $postings, 'username' => $username);
		echo json_encode($postings_json_obj);
	}

	// public function search($query) {
	// 	$posting = new Posting();
	// 	$postings = $posting->search($query);

	// 	for($i = 0; $i < count($postings); $i++) {
	// 		$postings[$i]['images']= '/postings/thumbnail/' . $postings[$i]['id'];
	// 		$postings[$i][self::INDEX_OF_IMAGES_BLOB] = '';
	// 	}

	// 	$posting_json_obj = array('postings' => $postings);
	// 	echo json_encode($posting_json_obj);
	// } Kept incase we allow landlords to seach through their postings

	public function posting($id) {
		$posting = new Posting();
		$location = new Location();
		//makes SQL call to grab posting ID
		$postings = $posting->search_like("id = " . $id);
		$location_of_posting = $location->get($id);
		$postings[0]['streetName'] = $location_of_posting['streetName'];
		$postings[0]['city'] = $location_of_posting['city'];
		$postings[0]['zip'] = $location_of_posting['zip'];

		$postings_json_obj = array('posting' => $postings[0]);
		echo json_encode($postings_json_obj);
	}

	public function thumbnail($id) {
		//KEEP for when we use blobs

		// if (isset($id)) {
		// 	$posting = new Posting();
		// 	$img = '<img src="data:image/jpeg;base64,'.base64_encode( $posting->get_thumbnail($id) ).'"/>';
		// 	echo $img;

		// }

		$img = '<img src="img/sample-apartment.jpeg"/>';
		echo $img;
	}

	private static function append_messages($postings) {
		$message = new Message();
		$newArray = array();
		foreach ($postings as $posting) {
			$posting['messages'] = $message->all($posting['id'], $posting['landlordID']);
			array_push($newArray, $posting);
		}
		return $newArray;
	}
}