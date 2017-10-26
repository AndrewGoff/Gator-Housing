 <?php 

 	session_start();

	require_once APP . 'model/user.php';
	require_once APP . 'model/student.php';

	class Favorites extends Controller
	{
		// private $user;
		// private $sql;
		const DENIED = '{ "response": "Denied" }';
		const APPROVED = '{ "response": "Approved" }';

		public function add($id){
			self::check_session();

			if ($_SESSION['email'] === "" ) {
				echo self::DENIED;
				return;
			}

			$user = new User();
			$db_user = $user->get_user($_SESSION["email"]);

			//echo json_encode($db_user);

			if($db_user === []) {
				echo self::DENIED;
				return;
			}

			$student = new Student();
			$db_student = $student->get_student($db_user[0]["id"]);
			echo ($db_student === []) ? self::DENIED : self::APPROVED;
			
		}

		private function check_session(){
			if(!isset($_SESSION['email'])){
				$_SESSION['email'] = '';
			}
		}			

	}
?>