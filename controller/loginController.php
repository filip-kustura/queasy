<?php 

require_once __DIR__ . '/../model/loginservice.class.php';

class LoginController {
	public function index() {
		session_start();

		if (isset($_SESSION['username'])) // Korisnik je ulogiran -- preusmjeri na homepage
			header('Location: index.php?rt=home');

		if (isset($_SESSION['warning'])) {
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
		
		if (isset($_POST['login'])) {
			if ($_POST['username'] !== '' && $_POST['password'] !== '') {
				$attempt_successful = $ls->handleLoginAttempt($_POST['username'], $_POST['password']);
	
				if ($attempt_successful)
					header('Location: index.php?rt=home');
				else
					header('Location: index.php?rt=login');
			} else {
				session_start();
				$_SESSION['warning'] = 'Please enter the login credentials.';
				header('Location: index.php?rt=login');
			}
		} else if (isset($_POST['sign-up'])) {
			$ls->handleSignUpAttempt($_POST['username'], $_POST['password']);
		}
	}
}; 

?>
