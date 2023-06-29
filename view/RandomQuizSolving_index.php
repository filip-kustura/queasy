<?php 

$title = "Quiz Solving"; 
require_once __DIR__ . '/_header.php'; 

//Ovako ide javascript poziv funkcije iz .js bibioteke QuizSolvinglib 
//Za argumente u pozivu js funkcije u $_SESSION varijabli se brine QuizSolvingController.php
echo '<script>PresentWholeQuestion("' . $_SESSION["orderNumberOfQuestion"]+1 . "," . $_SESSION["question"] . "," . $_SESSION["color"] . "," . $_SESSION["quizName"] . "," . $_SESSION["numOfCorrectlyAnswered"] . "," . $_SESSION["numOfAnswers"] '");</script>';

require_once __DIR__ . '/_footer.php'; 

?>
