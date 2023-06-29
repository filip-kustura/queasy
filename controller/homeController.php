<?php

class HomeController {
	public function index() {
		session_start();
		if (!isset($_SESSION['username']))
			header('Location: index.php?rt=login'); // Korisnik nije ulogiran -- preusmjeri na podstranicu za login

		require_once __DIR__ . '/../view/home_index.php';
	}
}; 

?>
