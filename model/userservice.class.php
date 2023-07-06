<?php 

require_once __DIR__ . '/../app/database/db.class.php';


class UserService{
    function GetHistoryResultsById($id){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT history_corr, history_ans FROM kustura.users WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
        $row = $st -> fetchAll(); 
        if($row === false){
            return null; 
        } 
        else{
            return $row; 
        }
    }

    function GetSportsResultsById($id){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT sports_corr, sports_ans FROM kustura.users WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
        $row = $st -> fetchAll(); 
        if($row === false){
            return null; 
        } 
        else{
            return $row; 
        }
    }

    function GetArtResultsById($id){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT art_corr, art_ans FROM kustura.users WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
        $row = $st -> fetchAll(); 
        if($row === false){
            return null; 
        } 
        else{
            return $row; 
        }
    }

    function GetScienceResultsById($id){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT science_corr, science_ans FROM kustura.users WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
        $row = $st -> fetchAll(); 
        if($row === false){
            return null; 
        } 
        else{
            return $row; 
        }
    }

    function GetGeographyResultsById($id){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT geography_corr, geography_ans FROM kustura.users WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
        $row = $st -> fetchAll(); 
        if($row === false){
            return null; 
        } 
        else{
            return $row; 
        }
    }

    function GetEntertainmentResultsById($id){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT entertainment_corr, entertainment_ans FROM kustura.users WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
        $row = $st -> fetchAll(); 
        if($row === false){
            return null; 
        } 
        else{
            return $row; 
        }
    }
    
    function UpdateHistory($id,$corr,$ans){
        $results = GetHistoryResultsById($id); 
        $newCorr = $results[0][0] + $corr; 
        $newAns = $results[0][1] + $ans; 
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('UPDATE kustura.users SET history_corr =: newCorr,history_ans =: newAns  WHERE id=:id');
            $st->execute(array('id' => $id, 'newCorr' => $newCorr, 'newAns' => $newAns));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function UpdateSports($id,$corr,$ans){
        $results = GetSportsResultsById($id); 
        $newCorr = $results[0][0] + $corr; 
        $newAns = $results[0][1] + $ans; 
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('UPDATE kustura.users SET sports_corr =: newCorr,sports_ans =: newAns  WHERE id=:id');
            $st->execute(array('id' => $id, 'newCorr' => $newCorr, 'newAns' => $newAns));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function UpdateScience($id,$corr,$ans){
        $results = GetScienceResultsById($id); 
        $newCorr = $results[0][0] + $corr; 
        $newAns = $results[0][1] + $ans; 
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('UPDATE kustura.users SET science_corr =: newCorr,science_ans =: newAns  WHERE id=:id');
            $st->execute(array('id' => $id, 'newCorr' => $newCorr, 'newAns' => $newAns));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function UpdateArt($id,$corr,$ans){
        $results = GetArtResultsById($id); 
        $newCorr = $results[0][0] + $corr; 
        $newAns = $results[0][1] + $ans; 
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('UPDATE kustura.users SET art_corr =: newCorr,art_ans =: newAns  WHERE id=:id');
            $st->execute(array('id' => $id, 'newCorr' => $newCorr, 'newAns' => $newAns));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function UpdateEntertainment($id,$corr,$ans){
        $results = GetEntertainmentResultsById($id); 
        $newCorr = $results[0][0] + $corr; 
        $newAns = $results[0][1] + $ans; 
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('UPDATE kustura.users SET entertainment_corr =: newCorr,entertainment_ans =: newAns  WHERE id=:id');
            $st->execute(array('id' => $id, 'newCorr' => $newCorr, 'newAns' => $newAns));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function UpdateGeography($id,$corr,$ans){
        $results = GetGeographyResultsById($id); 
        $newCorr = $results[0][0] + $corr; 
        $newAns = $results[0][1] + $ans; 
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('UPDATE kustura.users SET geography_corr =: newCorr,geography_ans =: newAns  WHERE id=:id');
            $st->execute(array('id' => $id, 'newCorr' => $newCorr, 'newAns' => $newAns));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }
}; 


?>