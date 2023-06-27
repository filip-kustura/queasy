<?php

// Popunjavamo tablice u bazi "probnim" podacima.
require_once __DIR__ . '/db.class.php';

seed_table_users();

// ------------------------------------------
function seed_table_users()
{
	$db = DB::getConnection();

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

?>
