<?php

class IndexController {
	public function index() {
		session_start();

		if (isset($_POST['logout'])) {
			session_unset();
			session_destroy();
		}
		
		if (!isset($_SESSION['id'])) // Login nije obavljen -- preusmjeri na podstranicu za login
			header('Location: index.php?rt=login');
		else
			header('Location: index.php?rt=???');  // Preusmjeri na ??? podstranicu
	}
}; 

?>
