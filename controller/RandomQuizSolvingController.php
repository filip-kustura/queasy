<?php  

require_once __DIR__ . '../model/quizsolving.class.php';

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

$colorOfQuestions = ["#FFA500","#FFFF00","#0000FF","#FF0000","#008000","#800080","#FFFF00","#0000FF","#FF0000","#008000","#800080","#FFFF00","#0000FF","#FF0000","#008000","#800080"]; // svaka boja treba odgovarati  
// -------------------------
 

if(!isset($_SESSION["numOfAnswers"])){
    
    //inicijalizacija kviza
    $quizId = GetRandomQuizId();
    $questionsIds = GetQuestionsIdsByQuizId($quizId);
    $_SESSION["quizName"] = GetQuizNameByQuizId($quizId);
    $_SESSION["numOfQuestions"] = Count($questionsIds);
    //colorsOfQuestions = GetColors(); //jos ovo treba dodati 
    
    //ovo ce trebat inkrementirati
    $_SESSION["numOfAnsweredQuestions"] = 0; 
    $_SESSION["orderNumberOfQuestion"] = 1;
    
    //inkrementirati ako je prosli odgovor bio tocan
    $_SESSION["numOfCorrectlyAnswered"] = 0;  
    
    //pocetak, postavljanje prvog pitanja
    $_SESSION["answers"] = GetAnswersByQuestionId($questions[0]);
    $_SESSION["question"] = $questions[0]; // trenutno pitanje koje se postavlja  
    $_SESSION["color"] = $colorOfQuestions[0]; 

    //odlazak u view i izvrsavanje prvog pitanja
    header("Location: ../view/RandomQuizSolvingView.php");
}
else{

    /*
    // Jos moram vidjet kako i gdje cu ovo implementirati 
    if(AnswerCorrect()){
        $_SESSION["numOfCorrectlyAnswered"]++;
    }
    */
    $tmp = $_SESSION["numOfAnsweredQuestions"]++; 
    if($_SESSION["numOfAnsweredQuestions"] > Count($questions)){
        //kviz gotov
        header("Location: ../view/EndQuizView.php");
    }
    else{
        $_SESSION["orderNumberOfQuestion"]++; 
        
        $_SESSION["question"] = $questions[$tmp]; 
        $_SESSION["answers"] = GetAnswersByQuestionId($questionsIds[$tmp]); 
        $_SESSION["color"] = $colorOfQuestions[$tmp]; 
        header("Location: ../view/RandomQuizSolvingView.php");
    }
}
?>