<?php

	require_once APP . 'model/user.php';
	require_once APP . 'model/student.php';
	require_once APP . 'model/session.php';

	class Sessions extends Controller {

		// private $user;
		// private $sql;
		const DENIED = '{ "response": "Denied" }';
		const APPROVED = '{ "response": "Approved" }';

		public function check_credentials($user_string){
			$session = new Session();

			$user = new User(); 
			$user_data = explode(",", $user_string);

			// will change when $_POST exists
			$email = $user_data[0];
			$password = $user_data[1];

			$db_user = $user->get_user($email);
			//echo json_encode($db_user);

			if($db_user !== [] && password_verify($password, $db_user[0]["password"])) { 
				
			$session->set_email($email);	
			$session->set_id($db_user[0]["id"]);

			echo self::APPROVED;
				return;
			}
			
			echo self::DENIED; 
		}

		public function get_first_name($email){

			$user = new User();

			$db_user = $user->get_user($email);

			if($db_user !== []) {
				$name = array("name" => $db_user[0]["firstName"]);
				echo json_encode($name);
				return;
			}
			echo self::DENIED;
		}

		public function is_student(){
			$session = new Session();

			if ($session->get_email() === "" ) {
				echo self::DENIED;
				return;
			}

			$user = new User();
			$db_user = $user->get_user($session->get_email());

			//echo json_encode($db_user);

			if($db_user === []) {
				echo self::DENIED;
				return;
			}

			$student = new Student();
			$db_student = $student->get_student($db_user[0]["id"]);

			echo ($db_student === []) ? self::DENIED : self::APPROVED;
			
		}

		public function logout(){
			$session = new Session();

			$session->end_session();
		}

		// Check if email exists in database
		public function check_taken($email){
			$user = new User();
			$db_user = $user->get_user($email);

			echo ($db_user === []) ? self::APPROVED : self::DENIED;
		
		}

		// add user to database
		public function add_user($user_string){

			$user = new User();
			//TODO: change when $_POST is avail
			$user_data = explode(",", $user_string);
			// echo $user_string;

			$user->add_user($user_data[2], $user_data[3],
								$user_data[1], password_hash($user_data[0], PASSWORD_DEFAULT));

			if(explode('@', $user_data[1])[1] === "mail.sfsu.edu") {
				$id = $user->get_user($user_data[1])[0]["id"];
				$student = new Student();
				$student->add_student($id);
			}
			echo json_encode(array("email" => $user_data[1]));
		}

		// ?
		public function add_student($email){
			$user = new User();
			$users = $this->user->add_tenant($query);
		}		

	}
?>

