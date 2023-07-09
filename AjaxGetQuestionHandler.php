<?php 

require_once __DIR__ . '/model/quizsolving.class.php';
require_once __DIR__ . '/controller/EndQuizController.php'; 
function sendJSONandExit($message)
{
    // Kao izlaz skripte po alji $message u JSON formatu i prekini izvo enje.
    header( 'Content-type:application/json;charset=utf-8' );
    echo json_encode($message);
    flush();
    exit( 0 );
}

session_start();

$message = []; 
$QuizService = new QuizSolving();
$quizName = $_GET["quizName"]; 
$tmp = $_GET["indexOfNextQuestionId"]; 
$quizId = $QuizService->GetQuizIdByQuizName($quizName); 
$questionsIds = $QuizService->GetQuestionsIdsByQuizId($quizId); 


//spremanje rezultata proslog pitanja u sessione
$category = $_GET["category"]; 

if($_SESSION["orderNumberOfQuestion"] === 1){
    //incijalizacija varijabli za pracenje tijeka kviza i obradu rezultata 
    $_SESSION["historyAns"] = 0;
    $_SESSION["historyCorr"] = 0;
    $_SESSION["sportsAns"] = 0;
    $_SESSION["sportsCorr"] = 0;
    $_SESSION["scienceAns"] = 0;
    $_SESSION["scienceCorr"] = 0;
    $_SESSION["entertainmentAns"] = 0;
    $_SESSION["entertainmentCorr"] = 0;
    $_SESSION["geographyAns"] = 0;
    $_SESSION["geographyCorr"] = 0;
    $_SESSION["artAns"] = 0;
    $_SESSION["artCorr"] = 0;
}
else{
    $_SESSION["numberOfAnswers"]++;
    if($_GET["isCorrect"] === "yes") $_SESSION["numberOfCorrectAnswers"]++;
    if($category === "history"){
        $_SESSION["historyAns"]++;    
        if($_GET["isCorrect"] === "yes") $_SESSION["historyCorr"]++;
    }
    else if($category === "sports"){
        $_SESSION["sportsAns"]++;
        if($_GET["isCorrect"] === "yes") $_SESSION["sportsCorr"]++;
    }
    else if($category === "science"){
        $_SESSION["scienceAns"]++;
        if($_GET["isCorrect"] === "yes") $_SESSION["scienceCorr"]++;
    }
    else if($category === "entertainment"){
        $_SESSION["entertainmentAns"]++;
        if($_GET["isCorrect"] === "yes") $_SESSION["entertainmentCorr"]++;
    }
    else if($category === "art"){
        $_SESSION["artAns"]++;
        if($_GET["isCorrect"] === "yes") $_SESSION["artCorr"]++;
    }
    else if($category === "geography"){
        $_SESSION["geographyAns"]++;
        if($_GET["isCorrect"] === "yes") $_SESSION["geographyCorr"]++;
    }
}

$_SESSION["orderNumberOfQuestion"]++;

if($tmp >= Count($questionsIds)){
    //Detektiran kraj kviza, saljemo na znanje viewu koji dalje radi odgovarajuce akcije
    $message = true;
}
else{
    //dohvat i slanje iduceg pitanja
    $message[0] = $QuizService->GetQuestionByQuestionId($questionsIds[$tmp][0]);
    $message[1] = $QuizService->GetAnswersByQuestionId($questionsIds[$tmp][0]);
    $message[2] = $QuizService->GetQuestionCategoryByQuestionId($questionsIds[$tmp][0]);
}
sendJSONandExit($message); 






?>