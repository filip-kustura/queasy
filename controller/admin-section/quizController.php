<?php

require_once __DIR__ . '/../../model/quizzes_management_service.class.php';

class QuizController {
	public function index() {
        session_start();
		if (!isset($_SESSION['admin'])) // Netko tko nije admin je pokušao pristupiti admin sectionu -- preusmjeri na homepage
			header('Location: index.php?rt=home');

		$qms = new QuizzesManagementService();

		$quiz_id = $_GET['id'];
		$quiz_name = $qms->getQuizNameById($quiz_id);

		require_once __DIR__ . '/../../view/admin-section/quiz_index.php';
	}
}; 

?>
