<?php

require_once __DIR__ . '/../model/homeservice.class.php';

class HomeController {
	public function index() {
		session_start();
		if (!isset($_SESSION['username']))
			header('Location: index.php?rt=login'); // Korisnik nije ulogiran -- preusmjeri na podstranicu za login

		$HomeDB = new HomeService();
		$quizIds = $HomeDB->GetAllQuizIds();
		
		$_SESSION["quizName"] = []; 
		$_SESSION["quizAuthor"] = [];
		$_SESSION["quizNumOfQuestions"] = []; 
		
		for($i = 0; $i < Count($quizIds); $i++){
			$quizName = $HomeDB->GetQuizNameByQuizId($quizIds[$i]);
			$authorName = $HomeDB->GetQuizAuthorByQuizId($quizIds[$i]);
			$numOfQuestions = $HomeDB->GetNumberOfQuestionsInQuizById($quizIds[$i]);
			array_push($_SESSION["quizName"], $quizName);
			array_push($_SESSION["quizAuthor"], $authorName);
			array_push($_SESSION["quizNumOfQuestions"], $numOfQuestions);				
		}
		
		require_once __DIR__ . '/../view/home_index.php';
	}
}; 

?>
