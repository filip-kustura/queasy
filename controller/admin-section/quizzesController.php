<?php

require_once __DIR__ . '/../../model/quizzesdatabaseservice.class.php';

class QuizzesController {
	public function index() {
        session_start();
		if (!isset($_SESSION['admin'])) // Netko tko nije admin je pokušao pristupiti admin sectionu -- preusmjeri na homepage
			header('Location: index.php?rt=home');

		require_once __DIR__ . '/../../view/admin-section/quizzes_index.php';
	}
}; 

?>
