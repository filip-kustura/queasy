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

    function GetQuizNameByQuizId($id){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT name FROM kustura.quizzes WHERE id=:id');
			$st->execute(array('id' => $id));
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

    function GetRandomElement($array) {
        $index = array_rand($array);
        return $array[$index];
    }

    function GetRandomQuizId(){
        try
		{
			$db = DB::getConnection();
			$allQuizIds = $this->GetAllQuizIds();
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        while(1){
            $randomQuizId = $this->GetRandomElement($allQuizIds);
            //ako je igrac vec odigrao random odabrani kviz ponovo odaberi novi kviz, id cemo dohvatiti iz SESSION-a? 
            if(true) break; // zasada ovako 
        }
        
        return $randomQuizId;
    }

    function GetQuestionInfoFromQuestionId($id){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT * FROM kustura.questions WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
        
        $questionInfo = $st -> fetchAll();
        return $questionInfo; 
    }

    function GetQuestionByQuestionId($id){
        $questionText = ""; 
        $wholeInfo = $this->GetQuestionInfoFromQuestionId($id); 
        $questionText = $wholeInfo[0][1];
        return $questionText;
    }

    function GetAnswersByQuestionId($id){
        $answers = []; 
        $wholeInfo = $this->GetQuestionInfoFromQuestionId($id); 
        array_push($answers, $wholeInfo[0][3],$wholeInfo[0][4],$wholeInfo[0][5],$wholeInfo[0][6]);
        return $answers; 
    }

    function GetQuestionsIdsByQuizId($id){
        //dohvati question ids koji su povezani sa tim id-em kviza
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT question_id FROM kustura.quizzes_questions WHERE quiz_id=:quiz_id');
			$st->execute(array('quiz_id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
        $questionIds = $st -> fetch();
        
        return $questionIds;        
    }
};


?>