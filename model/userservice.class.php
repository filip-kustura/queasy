<?php 

require_once __DIR__ . '/../app/database/db.class.php';

class UserService{
    function UpdateUserHistoryStats($id,$corr,$ans){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT history_corr,history_ans FROM kustura.users WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
        $rows = $st -> fetchAll();
        $history_corr = $rows[0][0] + $corr;
        $history_ans = $rows[0][1] + $ans;
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare(
            'UPDATE kustura.users 
            SET history_corr=:history_corr, history_ans=:history_ans
            WHERE id=:id');
			$st->execute(array('id' => $id,'history_corr' => $history_corr,'history_ans' => $history_ans));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function UpdateUserSportsStats($id,$corr,$ans){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT sports_corr,sports_ans FROM kustura.users WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
        $rows = $st -> fetchAll();
        $sports_corr = $rows[0][0] + $corr;
        $sports_ans = $rows[0][1] + $ans;
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare(
            'UPDATE kustura.users 
            SET sports_corr=:sports_corr, sports_ans=:sports_ans
            WHERE id=:id');
			$st->execute(array('id' => $id,'sports_corr' => $sports_corr,'sports_ans' => $sports_ans));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function UpdateUserArtStats($id,$corr,$ans){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT art_corr,art_ans FROM kustura.users WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
        $rows = $st -> fetchAll();
        $art_corr = $rows[0][0] + $corr;
        $art_ans = $rows[0][1] + $ans;
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare(
            'UPDATE kustura.users 
            SET art_corr=:art_corr, art_ans=:art_ans
            WHERE id=:id');
			$st->execute(array('id' => $id,'art_corr' => $art_corr,'art_ans' => $art_ans));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function UpdateUserScienceStats($id,$corr,$ans){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT science_corr,science_ans FROM kustura.users WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
        $rows = $st -> fetchAll();
        $science_corr = $rows[0][0] + $corr;
        $science_ans = $rows[0][1] + $ans;
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare(
            'UPDATE kustura.users 
            SET science_corr=:science_corr, science_ans=:science_ans
            WHERE id=:id');
			$st->execute(array('id' => $id,'science_corr' => $science_corr,'science_ans' => $science_ans));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function UpdateUserGeographyStats($id,$corr,$ans){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT geography_corr,geography_ans FROM kustura.users WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
        $rows = $st -> fetchAll();
        $geography_corr = $rows[0][0] + $corr;
        $geography_ans = $rows[0][1] + $ans;
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare(
            'UPDATE kustura.users 
            SET geography_corr=:geography_corr, geography_ans=:geography_ans
            WHERE id=:id');
			$st->execute(array('id' => $id,'geography_corr' => $geography_corr,'geography_ans' => $geography_ans));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function UpdateUserEntertainmentStats($id,$corr,$ans){
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT entertainment_corr,entertainment_ans FROM kustura.users WHERE id=:id');
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
        $rows = $st -> fetchAll();
        $entertainment_corr = $rows[0][0] + $corr;
        $entertainment_ans = $rows[0][1] + $ans;
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare(
            'UPDATE kustura.users 
            SET entertainment_corr=:entertainment_corr, entertainment_ans=:entertainment_ans
            WHERE id=:id');
			$st->execute(array('id' => $id,'entertainment_corr' => $entertainment_corr,'entertainment_ans' => $entertainment_ans));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

	function UserPlayedQuiz($user_id, $quiz_id){
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare('INSERT INTO 
			kustura.users_quizzes (user_id,quiz_id)
			VALUES (:user_id,:quiz_id);');
			$st->execute(array('user_id' => $user_id,'quiz_id' => $quiz_id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
	}


}; 


?>