<?php

session_start();
	
require_once APP . 'model/posting.php';
require_once APP . 'model/message.php';
require_once APP . 'model/location.php';
require_once APP . 'model/user.php';
require_once APP . 'model/session.php';

class Students extends Controller {

	public function all() {
		$user = new User();
		$session = new Session();
		$email = $session->get_email();
		$userinfo = ($user->get_user($email))[0];
		$id = $userinfo[0];
		$username = $userinfo[3];

		$message = new Message();
		$messages = $message->get_by_id($id);

		$posting = new Posting();
		$postingIDArray = array();
		for($i = 0; $i < count($messages); $i++){
			array_push($postingIDArray, ($messages[$i])[1]);
		}

		$postingIDArray = array_unique($postingIDArray);
		$postings = self::append_messages($postingIDArray, $id);

		$postings_json_obj = array('postings' => $postings, 'username' => $username);
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

	private static function append_messages($postings, $id) {
		$message = new Message();
		$post = new Posting();
		$newArray = array();
		foreach($postings as $key => $postId){
				$posting = ($post->get_by_id($postId))[0];
				$posting['messages'] = $message->all($posting['id'], $id);
				array_push($newArray, $posting);
		}
		return $newArray;
	}
}