<?php  

require_once __DIR__ . '/../model/quizsolving.class.php';

class RandomQuizSolvingController{
    public function index() {
        session_start();
        $QuizService = new QuizSolving();
    
        if (isset($_POST['quizName'])) {
            $_SESSION['quizName'] = $_POST['quizName'];
        }

        if(!isset($_SESSION["quizName"])){

            //provjeri jel user odigrao sve kvizove da se izbjegne beskonacna petlja
            $quizIds = $QuizService->GetAllQuizIds();
            $playedAll = true; 
            for($i = 0; $i < Count($quizIds); $i++){
                if(!($QuizService->CheckIfUserIDPlayedQuizID($_SESSION["id"], $quizIds[$i]))){
                    $playedAll = false; 
                } 
            }

            if($playedAll){
                $_SESSION["playedAll"] = true; 
                header( 'Location: index.php?rt=home' );
                return; 
            }

            //inicijalizacija random kviza
            while(1){
                $_SESSION["quizId"] = $QuizService->GetRandomQuizId();
                if(!($QuizService->CheckIfUserIDPlayedQuizID($_SESSION["id"],$_SESSION["quizId"]))){
                    break; 
                }
            }

            $questionsIds = $QuizService->GetQuestionsIdsByQuizId($_SESSION["quizId"]);
            $_SESSION["numberOfQuestions"] = Count($questionsIds); 
            $_SESSION["quizName"] = $QuizService->GetQuizNameByQuizId($_SESSION["quizId"]);
            $_SESSION["orderNumberOfQuestion"] = 1;

            //odlazak u view 
            require_once __DIR__ . '/../view/RandomQuizSolving_index.php';
        }
        else if(isset($_SESSION['quizName'])){
            //Odabrani kviz iz home page-a je selektiran
            $_SESSION["quizId"]= $QuizService->GetQuizIdByQuizName($_SESSION['quizName']);
            
    
            if(($QuizService->CheckIfUserIDPlayedQuizID($_SESSION["id"],$_SESSION["quizId"]))){
                //Posalji poruku da je korisnik vec odigrao ovaj kviz te ga posalji nazad na home page
                $_SESSION["sendMsg"] = true; 
                header( 'Location: index.php?rt=home' );
                return; 
            }


            $questionsIds = $QuizService->GetQuestionsIdsByQuizId($_SESSION["quizId"]);
            $_SESSION["numberOfQuestions"] = Count($questionsIds); 
            $_SESSION["orderNumberOfQuestion"] = 1;
            $_SESSION["isCorrect"] = false; 
            //odlazak u view 
            require_once __DIR__ . '/../view/RandomQuizSolving_index.php';
        }
    }
};



?>