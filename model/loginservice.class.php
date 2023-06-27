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

			if ($row === false) {
				//displayLoginForm('Non-existent user.');
				//return;

				return false; // Login unsuccessful
			} else {
				/*if ($_POST['username'] !== $row['username']) {
					displayLoginForm('Non-existent user.');
					return;
				}*/
				$hash = $row['password'];
	
				if (password_verify($password_input, $hash)) {
					//$_SESSION['id'] = $_POST['username'];
					//header('Location: my_quacks.php');
					//exit();
	
					// Dohvati session
					$ss = Session::getInstance();
					$ss->id = $row['id'];
					return true;
				}/* else {
					displayLoginForm('Invalid password.');
					return;
				}*/

				return false; // Login unsuccessful
			}
        } catch (PDOException $e) {
            //displayLoginForm($e->getMessage());
            //return;

			echo $e->getMessage();
        }
	}


	function handleSignUpAttempt($username_input, $password_input) {
		// TODO
	}
};

?>
