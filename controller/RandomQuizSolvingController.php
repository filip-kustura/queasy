<?php  

require_once __DIR__ . '/../model/quizsolving.class.php';

//Dohvati ime kviza iz baze ? potrebna komunikacija s modelom 
//Dohvati pitanja iz baze ? potrebna komunikacija s modelom 
//brini se za zavrsetak te za globalne pomocne varijable
//Za sada dummy ime kviza,pitanja i odgovori, potrebno implementirati dohvat iz baze podataka


// ------------------------- OVO JOS SAMO TREBA DOHVATITI IZ BAZE
// -------------------------

class RandomQuizSolvingController{
    public function index() {
        $QuizService = new QuizSolving();
        if(!isset($_SESSION["numOfAnswers"])){
            //inicijalizacija kviza
            $quizId = $QuizService->GetRandomQuizId();
            $questionsIds = $QuizService->GetQuestionsIdsByQuizId($quizId);
            $_SESSION["quizName"] = $QuizService->GetQuizNameByQuizId($quizId);
            $_SESSION["numOfQuestions"] = Count($questionsIds);
            //colorsOfQuestions = GetColors(); //jos ovo treba dodati 
            
            //ovo ce trebat inkrementirati
            $_SESSION["numOfAnsweredQuestions"] = 0; 
            $_SESSION["orderNumberOfQuestion"] = 1;
            
            //inkrementirati ako je prosli odgovor bio tocan
            $_SESSION["numOfCorrectlyAnswered"] = 0;  
            
            //pocetak, postavljanje prvog pitanja
            $_SESSION["answers"] = $QuizService->GetAnswersByQuestionId($questionsIds[0]);
            $_SESSION["question"] = $QuizService->GetQuestionByQuestionId($questionsIds[0]); // trenutno pitanje koje se postavlja  
            $_SESSION["questionCategory"] = $QuizService->GetQuestionCategoryByQuestionId($questionsIds[0]); 

            //odlazak u view i izvrsavanje prvog pitanja
            //header('Location: index.php?rt=RandomQuizSolving');
            require_once __DIR__ . '/../view/RandomQuizSolving_index.php';
        }
        else{
            /*
            Jos moram vidjet kako i gdje cu ovo implementirati 
            if(AnswerCorrect()){
                $_SESSION["numOfCorrectlyAnswered"]++;
            }
            */
            $tmp = $_SESSION["numOfAnsweredQuestions"]++; 
            if($_SESSION["numOfAnsweredQuestions"] > Count($questions)){
                //kviz gotov
                //header("Location: ../view/EndQuizView.php");
                //TODO: unsetaj sve potrebne session varijable !
                echo "Kviz gotov, uredi ovo!";
                 
            }
            else{
                $_SESSION["orderNumberOfQuestion"]++; 
                
                $_SESSION["question"] = $QuizService->GetQuestionByQuestionId($questionsIds[$tmp]); 
                $_SESSION["answers"] = $QuizService->GetAnswersByQuestionId($questionsIds[$tmp]); 
                $_SESSION["questionCategory"] =$QuizService->GetQuestionCategoryByQuestionId($questionsIds[$tmp]); 
                header("Location: ../view/RandomQuizSolvingView.php");
            }
        }
    }
};


?>