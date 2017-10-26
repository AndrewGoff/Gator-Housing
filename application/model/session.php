<?php
	
	class Session {
		
		public function __construct () {
			// starts or restarts the current session
			if(session_status() !== PHP_SESSION_ACTIVE)
				session_start();
		}

		public function set_email($email = NULL) {
			
			if(!isset($_SESSION["email"]))
				$_SESSION["email"] = "";
			
			if($email !== NULL)
				$_SESSION["email"] = $email;
		}

		public function get_email(){
			$this->set_email();
			return $_SESSION["email"];
		}

		public function set_id($id = NULL) {
			
			if(!isset($_SESSION["id"]))
				$_SESSION["id"] = "";
			
			if($id !== NULL)
				$_SESSION["id"] = $id;
		}

		public function get_id(){
			$this->set_id();
			return $_SESSION["id"];
		}

		public function end_session(){
			$_SESSION["email"] = "";
			$_SESSION["id"] = "";

			session_destroy();
		}

	}

?>