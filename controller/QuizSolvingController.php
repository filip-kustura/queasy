<?php  

//Dohvati ime kviza iz baze ? potrebna komunikacija s modelom 
//Dohvati pitanja iz baze ? potrebna komunikacija s modelom 
//brini se za zavrsetak te za globalne pomocne varijable
//Za sada dummy ime kviza,pitanja i odgovori, potrebno implementirati dohvat iz baze podataka


// ------------------------- OVO SVE TREBA DOHVATITI IZ BAZE
$quizName = "Ime kviza"; 
$questions = ["pitanje1?","pitanje2?","pitanje3?","pitanje4?","pitanje5?","pitanje6?"];
$answers = [
    ["odgovornaprvotocan","odgovornaprvoNEtocan1","odgovornaprvoNEtocan2","odgovornaprvoNEtocan3"],
    ["odgovornadrugotocan","odgovornadrugoNEtocan1","odgovornadrugoNEtocan2","odgovornadrugoNEtocan3"],
    ["odgovornatrecetocan","odgovornatreceNEtocan1","odgovornatreceNEtocan2","odgovornatreceNEtocan3"],
    ["odgovornacetvrtotocan","odgovornacetvrtoNEtocan1","odgovornacetvrtoNEtocan2","odgovornacetvrtoNEtocan3"],
    ["odgovornapetotocan","odgovornapetoNEtocan1","odgovornapetoNEtocan2","odgovornapetoNEtocan3"],
    ["odgovornasestotocan","odgovornasestoNEtocan1","odgovornasestoNEtocan2","odgovornasestoNEtocan3"],
];

$colorOfQuestions = ["#FFA500","#FFFF00","#0000FF","#FF0000","#008000","#800080"]; // svaka boja treba odgovarati  
// -------------------------
 

if(!isset($_SESSION["numOfAnswers"])){
    $_SESSION["numOfAnswers"] = 0; //pocinje od 0 biti oprezan!
    $_SESSION["orderNumberOfQuestion"] = 0; 
    $_SESSION["question"] = $questions[0]; 
    $_SESSION["color"] = $colorOfQuestions[0]; 
    $_SESSION["quizName"] = $quizName;
    $_SESSION["numOfCorrectlyAnswered"] = 0;  
}
else{
    $tmp = $_SESSION["numOfAnswers"]++; 
    if($_SESSION["numOfAnswers"] > Count($questions)){
        //kviz gotov
        header("Location: ../view/EndQuizView.php");
    }
    else{
        $_SESSION["orderNumberOfQuestion"] = $tmp; //pocinje od 0 biti oprezan 
        $_SESSION["question"] = $questions[$tmp]; 
        $_SESSION["color"] = $colorOfQuestions[$tmp]; 
        header("Location: ../view/QuizSolvingView.php");
    }
}
?>