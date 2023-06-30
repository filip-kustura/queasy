<?php

require_once __DIR__ . '/../app/database/db.class.php';

class LoginService {
	function handleLoginAttempt($username_input, $password_input) {
		// Ukoliko je login neuspješan, postavlja warning za ispis korisniku i vraća false
		// Inače sprema korisnikov id i username u session i vraća true
		$database = DB::getConnection();

        try {
            $statement = $database->prepare(
                'SELECT id, username, password, admin
                FROM users 
                WHERE username = :username;'
            );

            $statement->execute(
                array(
                    'username' => $username_input
                )
            );
			
			$row = $statement->fetch();
			
			session_start();

			if ($row === false) {
				$_SESSION['warning'] = 'Non-existent user.';
				return false; // Login neuspješan
			} else {
				if ($username_input !== $row['username']) {
					$_SESSION['warning'] = 'Non-existent user.';
					return false; // Login neuspješan
				}
				
				$hash = $row['password'];
	
				if (password_verify($password_input, $hash)) {
					// Spremi korisnikov ID i username u session
					$_SESSION['id'] = $row['id'];
					$_SESSION['username'] = $row['username'];

					if ($row['admin'] === 1) // Korisnik je admin
						$_SESSION['admin'] = true;

					return true; // Login uspješan
				} else {
					$_SESSION['warning'] = 'Invalid password.';
					return false; // Login neuspješan
				}
			}
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
	}

	function handleSignUpAttempt($username_input, $password_input) {
		// Ukoliko je sign-up neuspješan, postavlja warning za ispis korisniku i vraća false
		// Inače vraća true
		$database = DB::getConnection();

        try {
            $statement = $database->prepare(
                'SELECT username
                FROM users 
                WHERE username = :username;'
            );

            $statement->execute(
                array(
                    'username' => $username_input
                )
            );
			
			$row = $statement->fetch();

			if ($row !== false) {
				session_start();
				$_SESSION['warning'] = 'User ' . $username_input . ' already exists.';
				return false;
			} else { // Novi korisnik!
				$this->addNewUser($username_input, $password_input);
				return true;
			}
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
	}

	function addNewUser($username_input, $password_input) {
		// Dodaje novog korisnika u bazu podataka
		$database = DB::getConnection();

		try {
			$statement = $database->prepare(
				'INSERT INTO users
				(username, password, admin)
				VALUES
				(:username, :password, 0);'
			);

			$statement->execute(
                array(
                    'username' => $username_input,
					'password' => password_hash($password_input, PASSWORD_DEFAULT)
                )
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

		try {
			// Dohvati ID novog korisnika kako bi ga spremio u session
			$statement = $database->prepare(
				'SELECT id
				FROM users
				WHERE username = :username;'
			);

			$statement->execute(
                array(
                    'username' => $username_input
                )
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

		$row = $statement->fetch();

		// Spremi ID i username novog korisnika u session
		session_start();
		$_SESSION['id'] = $row['id'];
		$_SESSION['username'] = $username_input;
		$_SESSION['new-user'] = true;
	}
};

?>
