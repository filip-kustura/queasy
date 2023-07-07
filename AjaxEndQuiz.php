<?php 
//require_once __DIR__ . '/model/userservice.class.php';

function sendJSONandExit($message)
{
    // Kao izlaz skripte po alji $message u JSON formatu i prekini izvo enje.
    header( 'Content-type:application/json;charset=utf-8' );
    echo json_encode($message);
    flush();
    exit( 0 );
}

/*
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

*/
$message = []; 
$quizName = $_GET["quizName"]; 
//$numOfCorrectAnswers = $_GET["numberOfCorrectAnswers"]; 
//$numOfQuestions = $_GET["numberOfQuestions"]; 

//Rezultati zavrsenog kviza
$historyCorr = $_GET["historyCorr"]; 
$sportsCorr = $_GET["sportsCorr"]; 
$artCorr = $_GET["artCorr"]; 
$geographyCorr = $_GET["geographyCorr"]; 
$entertainmentCorr = $_GET["entertainmentCorr"]; 
$scienceCorr = $_GET["scienceCorr"]; 

$historyAns = $_GET["historyAns"]; 
$sportsAns = $_GET["sportsAns"]; 
$artAns = $_GET["artAns"]; 
$geographyAns = $_GET["geographyAns"]; 
$entertainmentAns = $_GET["entertainmentAns"]; 
$scienceAns = $_GET["scienceAns"]; 
/*
UpdateResultsInDatabaseForCategory($historyResults,"history");
UpdateResultsInDatabaseForCategory($geographyResults,"geography");
UpdateResultsInDatabaseForCategory($artResults,"art");
UpdateResultsInDatabaseForCategory($scienceResults,"science");
UpdateResultsInDatabaseForCategory($sportsResults,"sports");
UpdateResultsInDatabaseForCategory($entertainmentResults,"entertainment");
*/

//TODO: Unsetaj sve potrebne za unset globalne varijable
 
$message = [$historyCorr,$historyAns,$sportsCorr,$sportsAns,$artCorr,$artAns,$geographyAns,$geographyCorr,$entertainmentCorr,$entertainmentAns,$scienceCorr,$scienceAns];

sendJSONandExit($message); 

?>