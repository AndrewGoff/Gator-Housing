<?php

require_once APP . 'model/message.php';
require_once APP . 'model/posting.php';
require_once APP . 'model/user.php';
require_once APP . 'model/session.php';

class Messages extends Controller {

	public function send_message_landlord($info){
		$session = new Session();
		$message = explode(",-,", $info);
		print_r($message);
		$postingID = $message[0];
		$subject = $message[1];
		$body = $message[2];

		$posting = new Posting();
		$landlordID = $posting->get_landlord($postingID);

		$senderEmail = $session->get_email();

		$user = new User();
		$temp = $user->get_user($senderEmail)[0];
		$senderID = $temp['id'];

		$tz = new DateTimeZone('America/Los_Angeles');
		$date = new DateTime(date('Y-m-d H:i:s'));
		$date->setTimezone($tz);
		$date = $date->format('Y-m-d H:i:s');

		$message = new Message();
		$message->add_message($postingID, $landlordID, $senderID, $subject, $body, $date);
		// print("PostingID: " . $postingID . " LandlordID: " . $landlordID . " SenderID: " . $senderID . " Subject: " . $subject . " Body: " . $body . " Date: " . $date);
	}

	public function send_message($info){
		$message = explode(",-,", $info);
		print_r($message);
		$postingID = $message[0];
		$userID = $message[1];
		$senderID = $message[2];
		$subject = $message[3];
		$body = $message[4];

		$tz = new DateTimeZone('America/Los_Angeles');
		$date = new DateTime(date('Y-m-d H:i:s'));
		$date->setTimezone($tz);
		$date = $date->format('Y-m-d H:i:s');

		$message = new Message();
		$message->add_message($postingID, $userID, $senderID, $subject, $body, $date);
		//print("PostingID: " . $postingID . " UserID: " . $userID. " SenderID: " . $senderID . " Subject: " . $subject . " Body: " . $body . " Date: " . $date);
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