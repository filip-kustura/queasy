<?php

// Popunjavamo tablice u bazi "probnim" podacima.
require_once __DIR__ . '/db.class.php';

$db = DB::getConnection();

$users_table_empty = isTableEmpty('users');
$questions_table_empty = isTableEmpty('questions');
$quizzes_table_empty = isTableEmpty('quizzes');
$quizzes_questions_table_empty = isTableEmpty('quizzes_questions');

if ($users_table_empty)
	seed_table_users();

if ($questions_table_empty)
	seed_table_questions();

if ($quizzes_table_empty)
	seed_table_quizzes();

if ($quizzes_questions_table_empty)
	seed_table_quizzes_questions();

if (!$users_table_empty && !$questions_table_empty && !$quizzes_table_empty && !$quizzes_questions_table_empty)
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

function seed_table_quizzes() {
	global $db;

	// Ubaci neke kvizove u tablicu users.
	// Uočimo da ne treba specificirati id koji se automatski poveća kod svakog ubacivanja.
	try {
		$st = $db->prepare( 'INSERT INTO quizzes(name, author) VALUES (:name, :author)' );

		$st->execute(array('name' => 'First Quiz', 'author' => 2));
		$st->execute(array('name' => 'Second Quiz', 'author' => 1));
		$st->execute(array('name' => 'Third Quiz', 'author' => 1));
		$st->execute(array('name' => 'Fourth Quiz', 'author' => 2));
		$st->execute(array('name' => 'Fifth Quiz', 'author' => 1));
		$st->execute(array('name' => 'Sixth Quiz', 'author' => 2));
		$st->execute(array('name' => 'Seventh Quiz', 'author' => 2));
		$st->execute(array('name' => 'Eighth Quiz', 'author' => 1));
		$st->execute(array('name' => 'Ninth Quiz', 'author' => 1));
		$st->execute(array('name' => 'Tenth Quiz', 'author' => 2));
		$st->execute(array('name' => 'Eleventh Quiz', 'author' => 1));
	} catch( PDOException $e ) { exit( "PDO error (seed_table_quizzes): " . $e->getMessage() ); }

	echo "Ubacio kvizove u tablicu quizzes.<br>";
}

function seed_table_quizzes_questions() {
	global $db;

	// Ubaci neke parove (kviz, pitanje) u tablicu users.
	try {
		$st = $db->prepare( 'INSERT INTO quizzes_questions(quiz_id, question_id) VALUES (:quiz_id, :question_id)' );

		$st->execute(array('quiz_id' => 1, 'question_id' => 1));
		$st->execute(array('quiz_id' => 1, 'question_id' => 2));
		$st->execute(array('quiz_id' => 1, 'question_id' => 3));
		$st->execute(array('quiz_id' => 1, 'question_id' => 4));
		$st->execute(array('quiz_id' => 1, 'question_id' => 5));
		$st->execute(array('quiz_id' => 1, 'question_id' => 6));
		$st->execute(array('quiz_id' => 1, 'question_id' => 32));
		$st->execute(array('quiz_id' => 1, 'question_id' => 33));
		$st->execute(array('quiz_id' => 1, 'question_id' => 34));
		$st->execute(array('quiz_id' => 1, 'question_id' => 35));
		$st->execute(array('quiz_id' => 1, 'question_id' => 36));

		$st->execute(array('quiz_id' => 2, 'question_id' => 7));
		$st->execute(array('quiz_id' => 2, 'question_id' => 8));
		$st->execute(array('quiz_id' => 2, 'question_id' => 9));
		$st->execute(array('quiz_id' => 2, 'question_id' => 4));
		$st->execute(array('quiz_id' => 2, 'question_id' => 5));
		$st->execute(array('quiz_id' => 2, 'question_id' => 6));
		$st->execute(array('quiz_id' => 2, 'question_id' => 30));
		$st->execute(array('quiz_id' => 2, 'question_id' => 31));
		$st->execute(array('quiz_id' => 2, 'question_id' => 32));

		$st->execute(array('quiz_id' => 3, 'question_id' => 10));
		$st->execute(array('quiz_id' => 3, 'question_id' => 11));
		$st->execute(array('quiz_id' => 3, 'question_id' => 6));
		$st->execute(array('quiz_id' => 3, 'question_id' => 30));
		$st->execute(array('quiz_id' => 3, 'question_id' => 29));

		$st->execute(array('quiz_id' => 4, 'question_id' => 12));
		$st->execute(array('quiz_id' => 4, 'question_id' => 13));
		$st->execute(array('quiz_id' => 4, 'question_id' => 14));
		$st->execute(array('quiz_id' => 4, 'question_id' => 28));
		$st->execute(array('quiz_id' => 4, 'question_id' => 27));
		$st->execute(array('quiz_id' => 4, 'question_id' => 26));

		$st->execute(array('quiz_id' => 5, 'question_id' => 14));
		$st->execute(array('quiz_id' => 5, 'question_id' => 25));
		$st->execute(array('quiz_id' => 5, 'question_id' => 24));
		$st->execute(array('quiz_id' => 5, 'question_id' => 23));

		$st->execute(array('quiz_id' => 6, 'question_id' => 15));
		$st->execute(array('quiz_id' => 6, 'question_id' => 23));
		$st->execute(array('quiz_id' => 6, 'question_id' => 22));
		$st->execute(array('quiz_id' => 6, 'question_id' => 21));
		$st->execute(array('quiz_id' => 6, 'question_id' => 20));

		$st->execute(array('quiz_id' => 7, 'question_id' => 16));
		$st->execute(array('quiz_id' => 7, 'question_id' => 17));

		$st->execute(array('quiz_id' => 8, 'question_id' => 18));
		$st->execute(array('quiz_id' => 8, 'question_id' => 19));
		$st->execute(array('quiz_id' => 8, 'question_id' => 20));
		$st->execute(array('quiz_id' => 8, 'question_id' => 21));
		$st->execute(array('quiz_id' => 8, 'question_id' => 22));
		$st->execute(array('quiz_id' => 8, 'question_id' => 23));
		$st->execute(array('quiz_id' => 8, 'question_id' => 24));
		$st->execute(array('quiz_id' => 8, 'question_id' => 25));
		$st->execute(array('quiz_id' => 8, 'question_id' => 26));
		$st->execute(array('quiz_id' => 8, 'question_id' => 27));
		$st->execute(array('quiz_id' => 8, 'question_id' => 28));
		$st->execute(array('quiz_id' => 8, 'question_id' => 29));
		$st->execute(array('quiz_id' => 8, 'question_id' => 30));

		$st->execute(array('quiz_id' => 9, 'question_id' => 1));
		$st->execute(array('quiz_id' => 9, 'question_id' => 10));
		$st->execute(array('quiz_id' => 9, 'question_id' => 20));
		$st->execute(array('quiz_id' => 9, 'question_id' => 30));
		$st->execute(array('quiz_id' => 9, 'question_id' => 35));
		$st->execute(array('quiz_id' => 9, 'question_id' => 36));

		$st->execute(array('quiz_id' => 10, 'question_id' => 1));
		$st->execute(array('quiz_id' => 10, 'question_id' => 10));
		$st->execute(array('quiz_id' => 10, 'question_id' => 20));
		$st->execute(array('quiz_id' => 10, 'question_id' => 30));
		$st->execute(array('quiz_id' => 10, 'question_id' => 35));
		$st->execute(array('quiz_id' => 10, 'question_id' => 36));

		$st->execute(array('quiz_id' => 11, 'question_id' => 5));
		$st->execute(array('quiz_id' => 11, 'question_id' => 25));
		$st->execute(array('quiz_id' => 11, 'question_id' => 35));
		$st->execute(array('quiz_id' => 11, 'question_id' => 15));
		$st->execute(array('quiz_id' => 11, 'question_id' => 10));
		$st->execute(array('quiz_id' => 11, 'question_id' => 19));
		$st->execute(array('quiz_id' => 11, 'question_id' => 11));
	} catch( PDOException $e ) { exit( "PDO error (seed_table_quizzes_questions): " . $e->getMessage() ); }

	echo "Ubacio parove (kviz, pitanje) u tablicu quizzes_questions.<br>";
}

function seed_table_questions() {
	global $db;
	
	// Ubaci neka pitanja u tablicu questions.
	// Uočimo da ne treba specificirati id koji se automatski poveća kod svakog ubacivanja.
	
	// Ubacimo pitanja s ponuđenim odgovorima
	try {
		$st = $db->prepare( 'INSERT INTO questions(category, question, answer, optionA, optionB, optionC, author) VALUES (:category, :question, :answer, :optionA, :optionB, :optionC, :author)' );

		$st->execute(
			array(
				'category' => 'history',
				'question' => 'What nationality was Benito Mussolini?',
				'answer' => 'Italian',
				'optionA' => 'Spanish',
				'optionB' => 'French',
				'optionC' => 'American',
				'author' => 1
			)
		);

		$st->execute(
			array(
				'category' => 'geography',
				'question' => 'What country is Biscay in?',
				'answer' => 'Spain',
				'optionA' => 'Japan',
				'optionB' => 'Brazil',
				'optionC' => 'Portugal',
				'author' => 2
			)
		);
		
		$st->execute(
			array(
				'category' => 'sports',
				'question' => 'Which of these teams uses a shade of blue as one of its main colors?',
				'answer' => 'Indianapolis Colts',
				'optionA' => 'Cleveland Browns',
				'optionB' => 'Cincinnati Bengals',
				'optionC' => 'Pittsburgh Steelers',
				'author' => 2
			)
		);

		$st->execute(
			array(
				'category' => 'art',
				'question' => 'Who penned the literary classic "The Compleat Angler"?',
				'answer' => 'Izaak Walton',
				'optionA' => 'Lewis Carrol',
				'optionB' => 'John Steinbeck',
				'optionC' => 'Pearl S. Buck',
				'author' => 1
			)
		);

		$st->execute(
			array(
				'category' => 'science',
				'question' => 'What kind of wave is light?',
				'answer' => 'Transverse and Electromagnetic',
				'optionA' => 'Transverse and Mechanical',
				'optionB' => 'Longitudinal and Electromagnetic',
				'optionC' => 'Longitudinal and Mechanical',
				'author' => 2
			)
		);

		$st->execute(
			array(
				'category' => 'entertainment',
				'question' => 'What is Gru\\\'s goal at the beginning of Despicable me?',
				'answer' => 'Steal the moon',
				'optionA' => 'Steal the Egyptian pyramids',
				'optionB' => 'Find Neptune\\\'s crown and save Mr. Krabs',
				'optionC' => 'Teach himself how to fly',
				'author' => 1
			)
		);

		$st->execute(
			array(
				'category' => 'history',
				'question' => 'Who did Cambodia gain independence in 1953 from?',
				'answer' => 'France',
				'optionA' => 'United Kingdom',
				'optionB' => 'Portugal',
				'optionC' => 'The Netherlands',
				'author' => 1
			)
		);

		$st->execute(
			array(
				'category' => 'geography',
				'question' => 'From 1977 to 2011, which countrie\\\'s flag consisted only of a green rectangle?',
				'answer' => 'Libya',
				'optionA' => 'Liberia',
				'optionB' => 'Lebanon',
				'optionC' => 'Lesotho',
				'author' => 1
			)
		);
		
		$st->execute(
			array(
				'category' => 'sports',
				'question' => 'Which country has won the most gold Oympic medals in water polo?',
				'answer' => 'Hungary',
				'optionA' => 'Italy',
				'optionB' => 'Spain',
				'optionC' => 'Croatia',
				'author' => 2
			)
		);

		$st->execute(
			array(
				'category' => 'art',
				'question' => 'What is Bob Fosse known for?',
				'answer' => 'choreographies',
				'optionA' => 'paintings',
				'optionB' => 'fiction novels',
				'optionC' => 'pottery',
				'author' => 2
			)
		);

		$st->execute(
			array(
				'category' => 'science',
				'question' => '1 meter per second equals how many kilometers per hour?',
				'answer' => '3.6',
				'optionA' => '7.2',
				'optionB' => '6.3',
				'optionC' => '2.7',
				'author' => 2
			)
		);

		$st->execute(
			array(
				'category' => 'entertainment',
				'question' => 'What was the road called in the movie "The Wizard of Oz"?',
				'answer' => 'The Yellow Brick Road',
				'optionA' => 'The Blue Cobblestone Road',
				'optionB' => 'The Green Asphalt Road',
				'optionC' => 'The Red Crystal Brick Road',
				'author' => 1
			)
		);

		$st->execute(
			array(
				'category' => 'history',
				'question' => 'The attack on Pearl Harbor was a surprise military strike by which army?',
				'answer' => 'Japanese',
				'optionA' => 'Italian',
				'optionB' => 'American',
				'optionC' => 'British',
				'author' => 2
			)
		);

		$st->execute(
			array(
				'category' => 'geography',
				'question' => 'Where is the biggest airport (by number of passengers) in the United States located?',
				'answer' => 'Atlanta',
				'optionA' => 'Los Angeles',
				'optionB' => 'New York',
				'optionC' => 'Dallas',
				'author' => 1
			)
		);
		
		$st->execute(
			array(
				'category' => 'sports',
				'question' => 'Which of the following events is included in the decathlon?',
				'answer' => '110 metres hurdles',
				'optionA' => '400 metres hurdles',
				'optionB' => '200 metres',
				'optionC' => '800 metres',
				'author' => 1
			)
		);

		$st->execute(
			array(
				'category' => 'art',
				'question' => 'Who painted "The Starry Night"?',
				'answer' => 'Vincent van Gogh',
				'optionA' => 'Pablo Picasso',
				'optionB' => 'Claude Monet',
				'optionC' => 'Leonardo da Vinci',
				'author' => 1
			)
		);

		$st->execute(
			array(
				'category' => 'science',
				'question' => 'Visible light is usually defined as having wavelengths in the range of 400-700...',
				'answer' => 'nanometres',
				'optionA' => 'microometres',
				'optionB' => 'picometres',
				'optionC' => 'femtometres',
				'author' => 2
			)
		);

		$st->execute(
			array(
				'category' => 'entertainment',
				'question' => '"Pump Up the Jam" is the opening track on which Belgian act\\\'s first album?',
				'answer' => 'Technotronic',
				'optionA' => 'Daisy Dee',
				'optionB' => 'Foster The People',
				'optionC' => 'Global Deejays',
				'author' => 2
			)
		);
	} catch( PDOException $e ) { exit( "PDO error (seed_table_questions): " . $e->getMessage() ); }

	// Ubacimo pitanja gdje treba upisati odgovor
	try {
		$st = $db->prepare( 'INSERT INTO questions(category, question, answer, author) VALUES (:category, :question, :answer, :author)' );

		$st->execute(
			array(
				'category' => 'history',
				'question' => 'In which century did the Western Roman Empire fall? Enter a number only.',
				'answer' => '5',
				'author' => 2
			)
		);

		$st->execute(
			array(
				'category' => 'geography',
				'question' => 'What is the capital of Brasil?',
				'answer' => 'brasilia',
				'author' => 1
			)
		);

		$st->execute(
			array(
				'category' => 'sports',
				'question' => 'In what sport should you "float like a butterfly and sting like a bee"?',
				'answer' => 'boxing',
				'author' => 1
			)
		);

		$st->execute(
			array(
				'category' => 'art',
				'question' => 'Who is the Roman god of freshwater and the sea in Roman religion?',
				'answer' => 'neptune',
				'author' => 1
			)
		);

		$st->execute(
			array(
				'category' => 'science',
				'question' => 'Approximately how long (in months) does the cow gestation period last? Enter a number only',
				'answer' => '9',
				'author' => 2
			)
		);

		$st->execute(
			array(
				'category' => 'entertainment',
				'question' => 'What species is SpongeBob SquarePants\\\' employer? Enter a noun only, without "a/an/the".',
				'answer' => 'crab',
				'author' => 2
			)
		);

		$st->execute(
			array(
				'category' => 'history',
				'question' => 'In which century was the first Diesel engine built? Enter a number only.',
				'answer' => '19',
				'author' => 2
			)
		);

		$st->execute(
			array(
				'category' => 'geography',
				'question' => 'What other island forms a nation with Trinidad?',
				'answer' => 'tobago',
				'author' => 2
			)
		);

		$st->execute(
			array(
				'category' => 'sports',
				'question' => 'Which country won the first ever FIFA World Cup in 1930?',
				'answer' => 'uruguay',
				'author' => 1
			)
		);

		$st->execute(
			array(
				'category' => 'art',
				'question' => 'In the Marvel comics, what is the FIRST name of Luke Cage and Jessica Jones\\\' daughter?',
				'answer' => 'danielle',
				'author' => 1
			)
		);

		$st->execute(
			array(
				'category' => 'science',
				'question' => 'One of two main female sex hormones is estrogen. What is the other one called?',
				'answer' => 'progesterone',
				'author' => 1
			)
		);

		$st->execute(
			array(
				'category' => 'entertainment',
				'question' => 'What Madonna\\\'s hit song is also a name of a magazine?',
				'answer' => 'vogue',
				'author' => 2
			)
		);

		$st->execute(
			array(
				'category' => 'history',
				'question' => 'On July 4th of which year was the US Declaration of Independence issued? Enter a number only.',
				'answer' => '1776',
				'author' => 2
			)
		);

		$st->execute(
			array(
				'category' => 'geography',
				'question' => 'What Tennessee city on the Mississippi river is famous for its Pyramid Arena?',
				'answer' => 'memphis',
				'author' => 1
			)
		);

		$st->execute(
			array(
				'category' => 'sports',
				'question' => 'George Weah is the first African former professional footballer to become a president of their country. He was also voted as the best player in the world in 1995. Which country is he from?',
				'answer' => 'liberia',
				'author' => 1
			)
		);

		$st->execute(
			array(
				'category' => 'art',
				'question' => 'Jazz is a music genre that originated in the African-American communities of which American city?',
				'answer' => 'new orleans',
				'author' => 1
			)
		);

		$st->execute(
			array(
				'category' => 'science',
				'question' => 'The International System of Units is internationally known by which abbreviation?',
				'answer' => 'si',
				'author' => 2
			)
		);

		$st->execute(
			array(
				'category' => 'entertainment',
				'question' => 'Situated in New York City\\\'s Greenwich Village, Central Perk is a coffeehouse frequently visited by the main protagonists in which TV show?',
				'answer' => 'friends',
				'author' => 2
			)
		);
	} catch( PDOException $e ) { exit( "PDO error (seed_table_questions): " . $e->getMessage() ); }

	echo "Ubacio pitanja u tablicu questions.<br>";
}

?>
