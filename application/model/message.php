<?php

	require_once APP . 'libs/database.php';
	require_once APP . 'libs/sqlquery.php';

	class Message {

		private $database;
		private $sql;

		public function __construct() {
			$this->database = new Database();
			$this->sql = new Sql(DB_NAME, 'Message', array('id','postingID','userID','senderID','subject','body', 'timestamp'));
			$this->usersql = new Sql(DB_NAME, 'Users', array('id','password','email', 'firstName', 'lastName'));
			$this->postsql = new Sql(DB_NAME, 'Posting', array('id','landlordID','title','price', 'numViews', 'numTenants', 'description', 'zip','metadata', 'city', 'numBed', 'numBath'));
		}

		// public function all($user_id) {
		// 	//TODO
		// 	return array(
		// 			'sender' => 'iain', 
		// 			'subject' => 'TEST', 
		// 			'body' => 'testing messages',
		// 			'date' => 'November 23, 2016'
		// 		);
		// }

		public function all($posting_id, $user_id) {
			$that = $this;
			$this->database->query($this->sql->get_message('*', $posting_id, $user_id));
			$temp = $this->database->fetchAll();
			$appended_user_info = array(); //getting message sender's info
			foreach ($temp as $message){
				$that->database->query($that->usersql->view_user_info($message['senderID']));
				$message['user_info'] = $that->database->fetchAll();
				array_push($appended_user_info, $message);
			}
			return $appended_user_info;
		}

		public function get_by_id($user_id) {
			$that = $this;
			$this->database->query($this->sql->get_message_student('*', $user_id));
			$temp = $this->database->fetchAll();
			$appended_user_info = array(); //getting message sender's info
			foreach ($temp as $message){
				$that->database->query($that->usersql->view_user_info($message['senderID']));
				$message['user_info'] = $that->database->fetchAll();
				array_push($appended_user_info, $message);
			}
			return $appended_user_info;
		}

		public function add_message($posting_id, $user_id, $sender_id, $subject, $body, $timestamp){
			$data = array(
				'0' => NULL,
				'1' => $posting_id,
			    '2' => $user_id,
			    '3' => $sender_id,
			    '4' => $subject,
			    '5' => $body,
			    '6' => $timestamp
			);

			$this->database->query($this->sql->insert_message($data));
			return $this->database->fetchAll();
		}

	}

?>