<?php

require_once __DIR__ . '/../app/database/db.class.php';

class QuizSolving {
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

    function GetQuizIdByQuizName($quizName){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT id FROM kustura.quizzes WHERE name=:name');
			$st->execute(array('name' => $quizName));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $row = $st -> fetchAll(); 
        if($row === false){
            return null; 
        } 
        else{
            //tu u nekom primjeru vraca klasu, ja cu zasad samo id-eve
            return $row[0][0]; 
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

        $row = $st -> fetchAll(); 
        if($row === false){
            return null; 
        } 
        else{
            return $row[0][0]; 
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

        $randomQuizId = $this->GetRandomElement($allQuizIds);
        return $randomQuizId;
    }

    function GetQuestionCategoryByQuestionId($id){
        $questionCategory = ""; 
        $wholeInfo = $this->GetQuestionInfoFromQuestionId($id);
        $questionCategory = $wholeInfo[0][1];
        return $questionCategory;
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
        $questionText = $wholeInfo[0][2];
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
        $questionIds = $st -> fetchAll();
        return $questionIds;        
    }

    function CheckIfUserIDPlayedQuizID($user_id, $quizId){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT user_id,quiz_id FROM kustura.users_quizzes WHERE user_id=:user_id');
			$st->execute(array('user_id' => $user_id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
        $rows = $st -> fetchAll();
        for($i = 0; $i < Count($rows); $i++){
            if($rows[$i][0] === $user_id && $rows[$i][1] === $quizId) return true; 
        }

        return false;
    }
};


?>