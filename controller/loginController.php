<?php 

require_once __DIR__ . '/../model/loginservice.class.php';

class LoginController {
	public function index() {
		session_start();

		if (isset($_SESSION['username'])) // Korisnik je ulogiran -- preusmjeri na homepage
			header('Location: index.php?rt=home');

		if (isset($_SESSION['warning'])) { // Dohvati warning i uništi session
			$warning = $_SESSION['warning'];
			if ($warning !== '') {
				session_unset();
				session_destroy();
			}
		}

		require_once __DIR__ . '/../view/login_index.php';
	}

	public function handleAction() {
		$ls = new LoginService();

		$username_input = $_POST['username'];
		$password_input = $_POST['password'];
		
		if ($username_input === '' || $password_input === '') {
			session_start();
			$_SESSION['warning'] = 'Please enter the login/sign-up credentials.';
			header('Location: index.php?rt=login');
		} else {
			if (isset($_POST['login'])) {
				$attempt_successful = $ls->handleLoginAttempt($username_input, $password_input);
	
				if ($attempt_successful)
					header('Location: index.php?rt=home');
				else
					header('Location: index.php?rt=login');
			} else if (isset($_POST['sign-up'])) {
				$attempt_successful = $ls->handleSignUpAttempt($username_input, $password_input);
	
				if ($attempt_successful)
					header('Location: index.php?rt=home');
				else
					header('Location: index.php?rt=login');
			}
		}		
	}
}; 

?>
