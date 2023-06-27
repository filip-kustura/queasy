<?php

// Stvaramo tablice u bazi (ako već ne postoje od ranije).
require_once __DIR__ . '/db.class.php';

create_table_users();

// ------------------------------------------
function create_table_users()
{
	$db = DB::getConnection();

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

?>
