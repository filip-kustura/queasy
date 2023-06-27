<?php 

require_once __DIR__ . '/../model/loginservice.class.php';

class LoginController {
	public function index() {
		$ls = new LoginService();

		$title = 'Login';
		//$userList = $ls->getAllUsers();

		require_once __DIR__ . '/../view/login_index.php';
	}

	public function handleAction() {
		$ls = new LoginService();
		
		if (isset($_POST['login'])) {
			$attempt_successful = $ls->handleLoginAttempt($_POST['username'], $_POST['password']);

			if ($attempt_successful)
				header('Location: index.php?rt=home');
			else
				echo 'Login unsuccessful!';
		} else if (isset($_POST['sign-up'])) {
			$ls->handleSignUpAttempt($_POST['username'], $_POST['password']);
		}
	}
}; 

?>
