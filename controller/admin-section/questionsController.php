<?php

class QuestionsController {
	public function index() {
        session_start();
		if (!isset($_SESSION['admin'])) // Netko tko nije admin je pokušao pristupiti admin sectionu -- preusmjeri na homepage
			header('Location: index.php?rt=home');

		require_once __DIR__ . '/../../view/admin-section/questions_index.php';
	}
}; 

?>
