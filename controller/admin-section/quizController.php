<?php

require_once __DIR__ . '/../../model/quizzesdatabaseservice.class.php';

class QuizController {
	public function index() {
        session_start();
		if (!isset($_SESSION['admin'])) // Netko tko nije admin je pokušao pristupiti admin sectionu -- preusmjeri na homepage
			header('Location: index.php?rt=home');

		$qds = new QuizzesDatabaseService();

		$quiz_id = $_GET['id'];
		$quiz_name = $qds->getQuizNameById($quiz_id);

		require_once __DIR__ . '/../../view/admin-section/quiz_index.php';
	}
}; 

?>
