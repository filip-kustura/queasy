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



$message = true; 
$quizName = $_GET["quizName"]; 
$numOfCorrectAnswers = $_GET["numberOfCorrectAnswers"]; 
$numOfQuestions = $_GET["numberOfQuestions"]; 

//Insertaj rezultate u bazu, u usera, dakle treba mi i userov id,kasnije jos implementiraj da se spremaju rezultati po kategorijama
//TODO: quizservice->Insert(....); 


//TODO: Unsetaj sve potrebne za unset globalne varijable
 
sendJSONandExit($message); 



?>