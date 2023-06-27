<?php

// Popunjavamo tablice u bazi "probnim" podacima.
require_once __DIR__ . '/db.class.php';

$db = DB::getConnection();

$users_table_empty = isTableEmpty('users');
$questions_table_empty = isTableEmpty('questions');

if ($users_table_empty)
	seed_table_users();

if ($questions_table_empty)
	seed_table_questions();

if (!$users_table_empty && !$questions_table_empty)
	echo 'Sve potrebne tablice već su popunjene podacima.';

// ------------------------------------------
function isTableEmpty($table_name) {
	global $db;
	
	$st = $db->prepare('SELECT COUNT(*) FROM ' . $table_name);
	$st->execute();
	$rowCount = $st->fetchColumn();

	return ($rowCount === 0);
}

function seed_table_users()
{
	global $db;

	// Ubaci neke korisnike u tablicu users.
	// Uočimo da ne treba specificirati id koji se automatski poveća kod svakog ubacivanja.
	try
	{
		$st = $db->prepare( 'INSERT INTO users(username, password, admin) VALUES (:username, :password, :admin)' );

		$st->execute( array( 'username' => 'Vilim', 'password' => password_hash( 'vilimovasifra', PASSWORD_DEFAULT ), 'admin' => 1 ) );
		$st->execute( array( 'username' => 'Filip', 'password' => password_hash( 'filipovasifra', PASSWORD_DEFAULT ), 'admin' => 1 ) );
		$st->execute( array( 'username' => 'Slavko', 'password' => password_hash( 'slavkovasifra', PASSWORD_DEFAULT ), 'admin' => 0 ) );
		$st->execute( array( 'username' => 'Ana', 'password' => password_hash( 'aninasifra', PASSWORD_DEFAULT ), 'admin' => 0 ) );
		$st->execute( array( 'username' => 'Maja', 'password' => password_hash( 'majinasifra', PASSWORD_DEFAULT ), 'admin' => 0 ) );
	}
	catch( PDOException $e ) { exit( "PDO error (seed_table_users): " . $e->getMessage() ); }

	echo "Ubacio korisnike u tablicu users.<br />";
}

function seed_table_questions() {
	global $db;
	
	// Ubaci neka pitanja u tablicu questions.
	// Uočimo da ne treba specificirati id koji se automatski poveća kod svakog ubacivanja.
	
	// Ubacimo pitanja s ponuđenim odgovorima
	try {
		$st = $db->prepare( 'INSERT INTO questions(category, question, answer, optionA, optionB, optionC) VALUES (:category, :question, :answer, :optionA, :optionB, :optionC)' );

		$st->execute(
			array(
				'category' => 'history',
				'question' => 'What nationality was Benito Mussolini?',
				'answer' => 'Italian',
				'optionA' => 'Spanish',
				'optionB' => 'French',
				'optionC' => 'American'
			)
		);

		$st->execute(
			array(
				'category' => 'geography',
				'question' => 'What country is Biscay in?',
				'answer' => 'Spain',
				'optionA' => 'Japan',
				'optionB' => 'Brazil',
				'optionC' => 'Portugal'
			)
		);
		
		$st->execute(
			array(
				'category' => 'sports',
				'question' => 'Which of these teams uses a shade of blue as one of its main colors?',
				'answer' => 'Indianapolis Colts',
				'optionA' => 'Cleveland Browns',
				'optionB' => 'Cincinnati Bengals',
				'optionC' => 'Pittsburgh Steelers'
			)
		);

		$st->execute(
			array(
				'category' => 'art',
				'question' => 'Who penned the literary classic "The Compleat Angler"?',
				'answer' => 'Izaak Walton',
				'optionA' => 'Lewis Carrol',
				'optionB' => 'John Steinbeck',
				'optionC' => 'Pearl S. Buck'
			)
		);

		$st->execute(
			array(
				'category' => 'science',
				'question' => 'What kind of wave is light?',
				'answer' => 'Transverse and Electromagnetic',
				'optionA' => 'Transverse and Mechanical',
				'optionB' => 'Longitudinal and Electromagnetic',
				'optionC' => 'Longitudinal and Mechanical'
			)
		);

		$st->execute(
			array(
				'category' => 'entertainment',
				'question' => 'What is Gru\'s goal at the beginning of Despicable me?',
				'answer' => 'Steal the moon',
				'optionA' => 'Steal the Egyptian pyramids',
				'optionB' => 'Find Neptune\'s crown and save Mr. Krabs',
				'optionC' => 'Teach himself how to fly'
			)
		);
	} catch( PDOException $e ) { exit( "PDO error (seed_table_questions): " . $e->getMessage() ); }

	// Ubacimo pitanja gdje treba upisati odgovor
	try {
		$st = $db->prepare( 'INSERT INTO questions(category, question, answer) VALUES (:category, :question, :answer)' );

		$st->execute(
			array(
				'category' => 'history',
				'question' => 'In which century did the Western Roman Empire fall? (1 digit)',
				'answer' => '5'
			)
		);

		$st->execute(
			array(
				'category' => 'geography',
				'question' => 'What is the capital of Brasil?',
				'answer' => 'brasilia'
			)
		);

		$st->execute(
			array(
				'category' => 'sports',
				'question' => 'In what sport should you "float like a butterfly and sting like a bee"?',
				'answer' => 'boxing'
			)
		);

		$st->execute(
			array(
				'category' => 'art',
				'question' => 'Who is the Roman god of freshwater and the sea in Roman religion?',
				'answer' => 'neptune'
			)
		);

		$st->execute(
			array(
				'category' => 'science',
				'question' => 'Approximately how long (in months) does the cow gestation period last? (1 digit)',
				'answer' => '9'
			)
		);

		$st->execute(
			array(
				'category' => 'entertainment',
				'question' => 'What species is SpongeBob SquarePants\' employer? (1 word, 4 letters)',
				'answer' => 'crab'
			)
		);

		/*$st->execute(
			array(
				'category' => 'history',
				'question' => 'In which century did the Western Roman Empire fall? (1 digit)',
				'answer' => '5'
			)
		);

		$st->execute(
			array(
				'category' => 'geography',
				'question' => 'What other island forms a nation with Trinidad?',
				'answer' => 'tobago'
			)
		);

		$st->execute(
			array(
				'category' => 'sports',
				'question' => 'In what sport should you "float like a butterfly and sting like a bee"?',
				'answer' => 'boxing'
			)
		);

		$st->execute(
			array(
				'category' => 'art',
				'question' => 'Who is the Roman god of freshwater and the sea in Roman religion?',
				'answer' => 'neptune'
			)
		);

		$st->execute(
			array(
				'category' => 'science',
				'question' => 'Approximately how long (in months) does the gestation period for cows last? (1 digit)',
				'answer' => '9'
			)
		);

		$st->execute(
			array(
				'category' => 'entertainment',
				'question' => 'What species is SpongeBob SquarePants\' employer? (1 word, 4 letters)',
				'answer' => 'crab'
			)
		);*/
	} catch( PDOException $e ) { exit( "PDO error (seed_table_questions): " . $e->getMessage() ); }

	echo "Ubacio pitanja u tablicu questions.<br>";
}

?>
