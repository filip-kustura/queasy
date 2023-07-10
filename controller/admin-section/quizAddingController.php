<?php

require_once __DIR__ . '/../../model/quizzes_management_service.class.php';

class QuizAddingController {
	public function index() {
        session_start();
		if (!isset($_SESSION['admin'])) // Netko tko nije admin je pokušao pristupiti admin sectionu -- preusmjeri na homepage
			header('Location: index.php?rt=home');

        if (isset($_SESSION['warning'])) { // Dohvati warning i uništi session
            $warning = $_SESSION['warning'];
            unset($_SESSION['warning']);
        }

		require_once __DIR__ . '/../../view/admin-section/quizAdding_index.php';
	}

    public function processQuizAdding() {
        if ($_POST['quiz-name'] === '') {
            session_start();
			$_SESSION['warning'] = 'Please enter the quiz name.';
			header('Location: index.php?subdir=admin-section&rt=quizAdding');
			return;
        }

        if (!isset($_POST['questions'])) {
            session_start();
			$_SESSION['warning'] = 'Please select at least one question.';
			header('Location: index.php?subdir=admin-section&rt=quizAdding');
			return;
        }

        $qms = new QuizzesManagementService();
        $attempt_successful = $qms->addNewQuiz($_POST['quiz-name'], $_POST['questions']);
        if ($attempt_successful) {
            $quiz_id = $qms->getQuizIdByName($_POST['quiz-name']);
            session_start();
            $_SESSION['notification'] = 'Quiz (ID = ' . $quiz_id . ') added.';
			header('Location: index.php?subdir=admin-section&rt=quizAdding');
            return;
        }
    }
}; 

?>
