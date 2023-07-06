<?php 
require_once __DIR__ . '/model/userservice.class.php';

function sendJSONandExit($message)
{
    // Kao izlaz skripte po alji $message u JSON formatu i prekini izvo enje.
    header( 'Content-type:application/json;charset=utf-8' );
    echo json_encode($message);
    flush();
    exit( 0 );
}


function UpdateResultsInDatabaseForCategory($array,$category){
    $corr = 0; 
    $ans = Count($array);
    for($i = 0; i < $ans; $i++){
        if($array[$i] === 1) $corr++; 
    }

    $UService= new UserService();
    $userId = $_SESSION['id'];

    if($category === "history") $UserService->UpdateHistory($userId,$corr,$ans);
    else if($category === "sports") $UserService->UpdateSports($userId,$corr,$ans);
    else if($category === "art") $UserService->UpdateArt($userId,$corr,$ans);
    else if($category === "science") $UserService->UpdateScience($userId,$corr,$ans);
    else if($category === "entertainment") $UserService->UpdateEntertainment($userId,$corr,$ans);
    else if($category === "geography") $UserService->UpdateGeography($userId,$corr,$ans);
}


$message = true; 
$quizName = $_GET["quizName"]; 
$numOfCorrectAnswers = $_GET["numberOfCorrectAnswers"]; 
$numOfQuestions = $_GET["numberOfQuestions"]; 

//Rezultati zavrsenog kviza
$historyResults = $_GET["historyArray"]; 
$geographyResults = $_GET["geographyArray"]; 
$artResults = $_GET["artArray"]; 
$scienceResults = $_GET["scienceArray"]; 
$sportsResults = $_GET["sportsArray"]; 
$entertainmentResults = $_GET["entertainmentArray"]; 

UpdateResultsInDatabaseForCategory($historyResults,"history");
UpdateResultsInDatabaseForCategory($geographyResults,"geography");
UpdateResultsInDatabaseForCategory($artResults,"art");
UpdateResultsInDatabaseForCategory($scienceResults,"science");
UpdateResultsInDatabaseForCategory($sportsResults,"sports");
UpdateResultsInDatabaseForCategory($entertainmentResults,"entertainment");


//TODO: Unsetaj sve potrebne za unset globalne varijable
 
sendJSONandExit($message); 

?>