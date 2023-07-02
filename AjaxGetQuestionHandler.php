<?php 

require_once __DIR__ . '/model/quizsolving.class.php';

function sendJSONandExit($message)
{
    // Kao izlaz skripte po alji $message u JSON formatu i prekini izvo enje.
    header( 'Content-type:application/json;charset=utf-8' );
    echo json_encode($message);
    flush();
    exit( 0 );
}

$message = []; 
$QuizService = new QuizSolving();
/*
                indexOfNextQuestionId: indexOfNextQuestionId,
                quizName: quizName 

*/

$quizName = $_GET["quizName"]; 

$tmp = $_GET["indexOfNextQuestionId"]; 
$quizId = $QuizService->GetQuizIdByQuizName($quizName); 
$questionsIds = $QuizService->GetQuestionsIdsByQuizId($quizId[0]); 
$message[0] = $QuizService->GetQuestionByQuestionId($questionsIds[$tmp][0]);
$message[1] = $QuizService->GetAnswersByQuestionId($questionsIds[$tmp][0]);
$message[2] = $QuizService->GetQuestionCategoryByQuestionId($questionsIds[$tmp][0]);

sendJSONandExit($message); 




?>