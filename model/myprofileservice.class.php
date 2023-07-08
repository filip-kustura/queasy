<?php 


require_once __DIR__ . '/../app/database/db.class.php';

class MyProfileService{
    function GetHistoryStats($id){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT history_corr,history_ans FROM kustura.users WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $rows = $st -> fetchAll(); 
        if($rows === false){
            return null; 
        } 
        else{
            $returnValue = []; 
            $returnValue[0] = $rows[0][0];
            $returnValue[1] = $rows[0][1];
            return $returnValue; 
        }
    }

    function GetSportsStats($id){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT sports_corr,sports_ans FROM kustura.users WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $rows = $st -> fetchAll(); 
        if($rows === false){
            return null; 
        } 
        else{
            $returnValue = []; 
            $returnValue[0] = $rows[0][0];
            $returnValue[1] = $rows[0][1];
            return $returnValue; 
        }
    }

    function GetScienceStats($id){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT science_corr,science_ans FROM kustura.users WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $rows = $st -> fetchAll(); 
        if($rows === false){
            return null; 
        } 
        else{
            $returnValue = []; 
            $returnValue[0] = $rows[0][0];
            $returnValue[1] = $rows[0][1];
            return $returnValue; 
        }
    }

    function GetArtStats($id){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT art_corr,art_ans FROM kustura.users WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $rows = $st -> fetchAll(); 
        if($rows === false){
            return null; 
        } 
        else{
            $returnValue = []; 
            $returnValue[0] = $rows[0][0];
            $returnValue[1] = $rows[0][1];
            return $returnValue; 
        }
    }

    function GetGeographyStats($id){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT geography_corr,geography_ans FROM kustura.users WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $rows = $st -> fetchAll(); 
        if($rows === false){
            return null; 
        } 
        else{
            $returnValue = []; 
            $returnValue[0] = $rows[0][0];
            $returnValue[1] = $rows[0][1];
            return $returnValue; 
        }
    }

    function GetEntertainmentStats($id){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT entertainment_corr,entertainment_ans FROM kustura.users WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $rows = $st -> fetchAll(); 
        if($rows === false){
            return null; 
        } 
        else{
            $returnValue = []; 
            $returnValue[0] = $rows[0][0];
            $returnValue[1] = $rows[0][1];
            return $returnValue; 
        }
    }
};




?>