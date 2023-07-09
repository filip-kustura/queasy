<?php

require_once __DIR__ . '/../../model/questions_management_service.class.php';

class QuestionsController {
	public function index() {
        session_start();
		if (!isset($_SESSION['admin'])) // Netko tko nije admin je pokušao pristupiti admin sectionu -- preusmjeri na homepage
			header('Location: index.php?rt=home');

		if (isset($_SESSION['warning'])) { // Dohvati warning i uništi session
			$warning = $_SESSION['warning'];
			unset($_SESSION['warning']);
		}

		require_once __DIR__ . '/../../view/admin-section/questions_index.php';
	}

	public function processQuestionAdding() {
		$qms = new QuestionsManagementService();

		if (!isset($_POST['category'])) {
			session_start();
			$_SESSION['warning'] = 'Please select the question category.';
			header('Location: index.php?subdir=admin-section&rt=questions');
			return;
		}

		$category = $_POST['category'];
		$question = $_POST['question'];
		$answer = $_POST['answer'];

		if ($question === '' || $answer === '') {
			session_start();
			$_SESSION['warning'] = 'Please fill in the form completely.';
			header('Location: index.php?subdir=admin-section&rt=questions');
			return;
		}

		if (isset($_POST['wrong-answer-1'])) { // Multiple-choice pitanje
			$wrong_answer_1 = $_POST['wrong-answer-1'];
			$wrong_answer_2 = $_POST['wrong-answer-2'];
			$wrong_answer_3 = $_POST['wrong-answer-3'];

			if ($wrong_answer_1 === '' || $wrong_answer_2 === '' || $wrong_answer_3 === '') {
				session_start();
				$_SESSION['warning'] = 'Please fill in the form completely.';
				header('Location: index.php?subdir=admin-section&rt=questions');
				return;
			}

			session_start();
			$qms->insertMultipleChoiceQuestion(
				$category,
				$question,
				$answer,
				$wrong_answer_1,
				$wrong_answer_2,
				$wrong_answer_3,
				$_SESSION['id']
			);
			$_SESSION['notification'] = 'Question added to category ' . $category . '.';
			header('Location: index.php?subdir=admin-section&rt=questions');
		} else { // Open cloze pitanje			
			session_start();
			$qms->insertOpenClozeQuestion(
				$category,
				$question,
				$answer,
				$_SESSION['id']
			);
			$_SESSION['notification'] = 'Question added to category ' . $category . '.';
			header('Location: index.php?subdir=admin-section&rt=questions');
		}
	}
}; 

?>
