<?php

require_once __DIR__ . '/../app/database/db.class.php';
require_once __DIR__ . '/session.class.php';

class QuizSolving {
    function GetAllQuizIds(){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT id FROM kustura.quizzes');
			$st->execute();
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $rows = $st -> fetch(); 
        if($rows === false){
            return null; 
        } 
        else{
            //tu u nekom primjeru vraca klasu, ja cu zasad samo id-eve
            return $rows; 
        }
    }

    function GetQuizIdByQuizName($quizName){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT id FROM kustura.quizzes WHERE name=:name');
			$st->execute(array('name' => $quizName));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $row = $st -> fetch(); 
        if($row === false){
            return null; 
        } 
        else{
            //tu u nekom primjeru vraca klasu, ja cu zasad samo id-eve
            return $row; 
        }
    }
    
    function GetQuestionsByQuizId($id){

    }


};


?>