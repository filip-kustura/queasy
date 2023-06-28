<?php

// Stvaramo tablice u bazi (ako već ne postoje od ranije).
require_once __DIR__ . '/db.class.php';

$db = DB::getConnection();

try {
	$st = $db->prepare('SHOW TABLES');
	$st->execute();
	$tables = $st->fetchAll(PDO::FETCH_COLUMN);

	$has_users_table = in_array('users', $tables);
	$has_questions_table = in_array('questions', $tables);
	$has_quizzes_table = in_array('quizzes', $tables);
	$has_quizzes_questions_table = in_array('quizzes_questions', $tables);
} catch( PDOException $e ) {
	exit( "PDO error [show tables]: " . $e->getMessage() );
}

if (!$has_users_table)
	create_table_users();

if (!$has_questions_table)
	create_table_questions();

if (!$has_quizzes_table)
	create_table_quizzes();

if (!$has_quizzes_questions_table)
	create_table_quizzes_questions();

if ($has_users_table && $has_questions_table && $has_quizzes_table && $has_quizzes_questions_table)
	echo 'Sve potrebne tablice već postoje u bazi.';

// ------------------------------------------
function create_table_users()
{
	global $db;

	// Stvaramo tablicu users.
	// Svaki user ima svoj id (automatski će se povećati za svakog novoubačenog korisnika), username i password hash.
	try
	{
		$st = $db->prepare(
			'CREATE TABLE IF NOT EXISTS users (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'username varchar(50) NOT NULL,' .
			'password varchar(255) NOT NULL,' .
			'admin boolean NOT NULL)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error (create_table_users): " . $e->getMessage() ); }

	echo "Napravio tablicu users.<br />";
}

function create_table_questions() {
	global $db;

	// Stvaramo tablicu questions.
	/*
	Svaki question ima:
		- id (automatski će se povećati za svako novoubačeno pitanje)
		- kategoriju
		- tekst pitanja
		- točan odgovor
		- tri ponuđena netočna odgovora (null ako se radi o pitanju gdje treba upisati odgovor)
	*/

	try {
		$st = $db->prepare(
			'CREATE TABLE IF NOT EXISTS questions (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'category varchar(20) NOT NULL,' .
			'question varchar(255) NOT NULL,' .
			'answer varchar(50) NOT NULL,' .
			'optionA varchar(50),' .
			'optionB varchar(50),' .
			'optionC varchar(50));'
		);

		$st->execute();
	} catch( PDOException $e ) { exit( "PDO error (create_table_questions): " . $e->getMessage() ); }

	echo "Napravio tablicu questions.<br>";
}

function create_table_quizzes() {
	global $db;

	// Stvaramo tablicu quizzes.
	/*
	Svaki quiz ima:
		- id (automatski će se povećati za svaki novoubačeni kviz)
		- naziv
		- id autora kviza
	*/

	try {
		$st = $db->prepare(
			'CREATE TABLE IF NOT EXISTS quizzes (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'name varchar(30) NOT NULL,' .
			'author int NOT NULL);'
		);

		$st->execute();
	} catch( PDOException $e ) { exit( "PDO error (create_table_quizzes): " . $e->getMessage() ); }

	echo "Napravio tablicu quizzes.<br>";
}

function create_table_quizzes_questions() {
	global $db;

	// Stvaramo tablicu quizzes_questions koja povezuje kvizove s pitanjima koja sadrže.
	/*
	Svaki zapis u tablici quizzes_questions ima:
		- id kviza
		- id pitanja
	*/

	try {
		$st = $db->prepare(
			'CREATE TABLE IF NOT EXISTS quizzes_questions (' .
			'quiz_id int NOT NULL,' .
			'question_id int NOT NULL);'
		);

		$st->execute();
	} catch( PDOException $e ) { exit( "PDO error (create_table_quizzes_questions): " . $e->getMessage() ); }

	echo "Napravio tablicu quizzes_questions.<br>";
}

?>
