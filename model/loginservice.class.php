<?php

require_once __DIR__ . '/../app/database/db.class.php';

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
			
			session_start();

			if ($row === false) {
				$_SESSION['warning'] = 'Non-existent user.';
				return false; // Login unsuccessful
			} else {
				if ($username_input !== $row['username']) {
					$_SESSION['warning'] = 'Non-existent user.';
					return false; // Login unsuccessful
				}
				
				$hash = $row['password'];
	
				if (password_verify($password_input, $hash)) {
					// Spremi korisnikov ID i username u session
					$_SESSION['id'] = $row['id'];
					$_SESSION['username'] = $row['username'];
					return true; // Login successful
				} else {
					$_SESSION['warning'] = 'Invalid password.';
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
