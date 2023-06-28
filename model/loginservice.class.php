<?php

require_once __DIR__ . '/../app/database/db.class.php';
require_once __DIR__ . '/session.class.php';

class LoginService {
	function handleLoginAttempt($username_input, $password_input) {
		$database = DB::getConnection();

        try {
            $statement = $database->prepare(
                'SELECT id, username, password
                FROM users 
                WHERE username = :username;'
            );

            $statement->execute(
                array(
                    'username' => $username_input
                )
            );
			
			$row = $statement->fetch();
			
			// Započni session
			$ss = Session::getInstance();

			if ($row === false) {
				$ss->warning = 'Non-existent user.';
				return false; // Login unsuccessful
			} else {
				if ($username_input !== $row['username']) {
					$ss->warning = 'Non-existent user.';
					return false; // Login unsuccessful
				}
				
				$hash = $row['password'];
	
				if (password_verify($password_input, $hash)) {
					// Spremi korisnikov ID i username u session
					$ss->id = $row['id'];
					$ss->username = $row['username'];
					return true; // Login successful
				} else {
					$ss->warning = 'Invalid password.';
					return false; // Login unsuccessful
				}
			}
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
	}

	function handleSignUpAttempt($username_input, $password_input) {
		// TODO
	}
};

?>
