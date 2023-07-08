<?php 
require_once __DIR__ . '/../model/myprofileservice.class.php';

class MyProfileController{
    public function index(){
        session_start(); 
        $StatsService = new MyProfileService(); 

        if(isset($_SESSION["id"])){
            $id = $_SESSION["id"]; 

            //dohvacanje i sortiranje podataka za prikaz statistike usera
            $historyStat = $StatsService->GetHistoryStats($id);
            $sportsStat = $StatsService->GetSportsStats($id);
            $artStat = $StatsService->GetArtStats($id); 
            $geographyStat = $StatsService->GetGeographyStats($id); 
            $entertainmentStat = $StatsService->GetEntertainmentStats($id); 
            $scienceStat = $StatsService->GetScienceStats($id); 
            $_SESSION["historyCorr"] = $historyStat[0];
            $_SESSION["historyAns"] = $historyStat[1];
            $_SESSION["sportsCorr"] = $sportsStat[0];
            $_SESSION["sportsAns"] = $sportsStat[1];
            $_SESSION["artCorr"] = $artStat[0];
            $_SESSION["artAns"] = $artStat[1];
            $_SESSION["scienceCorr"] = $scienceStat[0];
            $_SESSION["scienceAns"] = $scienceStat[1];
            $_SESSION["entertainmentCorr"] = $entertainmentStat[0];
            $_SESSION["entertainmentAns"] = $entertainmentStat[1];
            $_SESSION["geographyCorr"] = $geographyStat[0];
            $_SESSION["geographyAns"] = $geographyStat[1];
            
            //odlazak u view 
            require_once __DIR__ . '/../view/myprofile_index.php';
        }
    }
}





?>