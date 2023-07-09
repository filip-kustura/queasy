<?php 
require_once __DIR__ . '/../model/userservice.class.php';



class EndQuizController{
    public function index(){
        session_start();

        $id = $_SESSION["id"];
        $UserDB = new UserService();
        $quizId = $_SESSION['quizId'];
        
        $historyAns = $_SESSION["historyAns"];
        $historyCorr = $_SESSION["historyCorr"]; 
        $sportsAns = $_SESSION["sportsAns"];
        $sportsCorr = $_SESSION["sportsCorr"];
        $scienceAns = $_SESSION["scienceAns"];
        $scienceCorr = $_SESSION["scienceCorr"];
        $entertainmentAns = $_SESSION["entertainmentAns"];
        $entertainmentCorr = $_SESSION["entertainmentCorr"];
        $geographyAns = $_SESSION["geographyAns"];
        $geographyCorr = $_SESSION["geographyCorr"];
        $artAns = $_SESSION["artAns"];
        $artCorr = $_SESSION["artCorr"];

        //spremanje rezultata po kategorijama
        $UserDB->UpdateUserHistoryStats($id,$historyCorr,$historyCorr);
        $UserDB->UpdateUserSportsStats($id,$sportsCorr,$sportsCorr);
        $UserDB->UpdateUserGeographyStats($id,$geographyCorr,$geographyCorr);
        $UserDB->UpdateUserArtStats($id,$artCorr,$artCorr);
        $UserDB->UpdateUserScienceStats($id,$scienceCorr,$scienceCorr);
        $UserDB->UpdateUserEntertainmentStats($id,$entertainmentCorr,$entertainmentCorr);

        //korinik nakon sljedece naredbe nece vise moci igrati ovaj kviz
        $UserDB->UserPlayedQuiz($id,$quizId);
        //unsetanje varijabli koje nam vise netrebaju
        unset($_SESSION["historyAns"]);
        unset($_SESSION["historyCorr"]);
        unset($_SESSION["sportsAns"]);
        unset($_SESSION["sportsCorr"]);
        unset($_SESSION["scienceAns"]);
        unset($_SESSION["scienceCorr"]);
        unset($_SESSION["entertainmentAns"]);
        unset($_SESSION["entertainmentCorr"]);
        unset($_SESSION["geographyAns"]);
        unset($_SESSION["geographyCorr"]);
        unset($_SESSION["artAns"]);
        unset($_SESSION["artCorr"]);
        unset($_SESSION["orderNumberOfQuestion"]);
        //sve obavljeno, rezultati spremljeni korisnika saljemo na homepage
        header( 'Location: index.php?rt=home' );
    }
};


?>