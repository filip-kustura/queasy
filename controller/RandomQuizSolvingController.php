<?php  

require_once __DIR__ . '/../model/quizsolving.class.php';

class RandomQuizSolvingController{
    public function index() {
        $QuizService = new QuizSolving();
        if(!isset($_SESSION["quizId"])){
            //inicijalizacija kviza
            $_SESSION["quizId"] = $QuizService->GetRandomQuizId();
            echo "ispis"; 
            echo $_SESSION["quizId"]; 
            $questionsIds = $QuizService->GetQuestionsIdsByQuizId($_SESSION["quizId"]);
            $_SESSION["questionIds"] = $questionsIds;
            $_SESSION["numberOfQuestions"] = Count($questionsIds); 
            $_SESSION["quizName"] = $QuizService->GetQuizNameByQuizId($_SESSION["quizId"]);
            $_SESSION["numOfQuestions"] = Count($questionsIds);
            $_SESSION["numOfAnsweredQuestions"] = 0; 
            $_SESSION["orderNumberOfQuestion"] = 1;
            $_SESSION["numOfCorrectlyAnswered"] = 0;  
             
            //pocetak, postavljanje prvog pitanja
            $_SESSION["answers"] = $QuizService->GetAnswersByQuestionId($questionsIds[0][0]);
            $_SESSION["question"] = $QuizService->GetQuestionByQuestionId($questionsIds[0][0]); // trenutno pitanje koje se postavlja  
            $_SESSION["questionCategory"] = $QuizService->GetQuestionCategoryByQuestionId($questionsIds[0][0]); 
            
            //odlazak u view 
            require_once __DIR__ . '/../view/RandomQuizSolving_index.php';
        }
        else{

        }
    }
};



?>