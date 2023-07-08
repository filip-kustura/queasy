<?php

require_once __DIR__ . '/../app/database/db.class.php';

class HomeService{
    
    function GetQuizAuthorByQuizId($id){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT author FROM kustura.quizzes WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
        
        $row = $st -> fetchAll();
        $authorId = $row[0][0];  

        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT username FROM kustura.users WHERE id=:id');
			$st->execute(array('id' => $authorId));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
        $authorName = $st -> fetchAll();
        $name = $authorName[0][0];
        return $name; 
    }

    function GetNumberOfQuestionsInQuizById($quiz_id){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT question_id FROM kustura.quizzes_questions WHERE quiz_id=:quiz_id');
			$st->execute(array('quiz_id' => $quiz_id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $rows = $st -> fetchAll();
        $numOfQs = Count($rows); 
        return $numOfQs; 
    }

    function GetQuizNameByQuizId($id){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT name FROM kustura.quizzes WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
        $rows = $st -> fetchAll();
        return $rows[0][0];
    }

    function GetAllQuizIds(){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT id FROM kustura.quizzes');
			$st->execute();
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $rows = $st -> fetchAll(); 
        if($rows === false){
            return null; 
        } 
        else{
            //vraca u obliku row[redak][stupac = 0 uvijek 0 ]
            $returnValue = []; 
            for($i = 0; $i < Count($rows); $i++){
                array_push($returnValue,$rows[$i][0]);
            }
            return $returnValue; 
        }
    }
}



?>