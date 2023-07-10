<?php

require_once __DIR__ . '/../app/database/db.class.php';

class QuizzesManagementService {
    function removeEscChars($string) {
        return str_replace("\\'", "'", $string);
    }

    function getQuizzesArray($statement) {
        // Za dani statement, stvara i popunjava array s podacima o kvizovima
        // Vraća stvoreni i popunjeni array

        $quizzes = array();

        foreach ($statement->fetchAll() as $row) {
            $quiz = array();

            $quiz['id'] = $row['id'];
            $quiz['quiz_name'] = $row['quiz_name'];
            $quiz['author'] = $this->removeEscChars($row['author']);
            $quiz['questions_amount'] = $row['questions_amount'];

            $quizzes[] = $quiz;
        }

        return $quizzes;
    }

    function getAllQuizzes() {
        // Iz baze podataka dohvaća podatke o svim kvizovima (ID kviza, naziv kviza, username autora kviza i broj pitanja u kvizu)
        // Vraća dvodimenzionalni array s kvizovima, odnosno njihovim podacima

        $database = DB::getConnection();

        try {
            $statement = $database->prepare(
                'SELECT quizzes.id id, quizzes.name quiz_name, users.username author, (SELECT COUNT(*) FROM quizzes_questions WHERE quiz_id = quizzes.id) questions_amount
                FROM quizzes, users 
                WHERE quizzes.author = users.id
                ORDER BY id DESC;'
            );

            $statement->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $this->getQuizzesArray($statement);
    }

    function getQuizzesByAuthorId($author_id) {
        // Iz baze podataka dohvaća sve kvizove nekog autora
        // Vraća dvodimenzionalni array s kvizovima, odnosno njihovim podacima

        $database = DB::getConnection();

        try {
            $statement = $database->prepare(
                'SELECT quizzes.id id, quizzes.name quiz_name, users.username author, (SELECT COUNT(*) FROM quizzes_questions WHERE quiz_id = quizzes.id) questions_amount
                FROM quizzes, users 
                WHERE quizzes.author = users.id
                AND users.id = :author_id
                ORDER BY id DESC;'
            );

            $statement->execute(
                array(
                    'author_id' => $author_id
                )
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $this->getQuizzesArray($statement);
    }

    function deleteQuiz($id) {
        // Iz baze podataka briše kviz sa danim IDjem

        $database = DB::getConnection();

        try {
            $statement = $database->prepare(
                'DELETE
                FROM quizzes 
                WHERE id = :id;'
            );

            $statement->execute(
                array(
                    'id' => $id
                )
            );

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

        // Iz tablice quizzes_questions također je potrebno izbrisati zapise sa danim IDjem kviza
        try {
            $statement = $database->prepare(
                'DELETE
                FROM quizzes_questions 
                WHERE quiz_id = :id;'
            );

            $statement->execute(
                array(
                    'id' => $id
                )
            );

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

        return true;
    }

    function getQuizNameById($id) {
        // za dani ID kviza, dohvaća njegovo ime

        $database = DB::getConnection();

        try {
            $statement = $database->prepare(
                'SELECT name
                FROM quizzes 
                WHERE id = :id;'
            );

            $statement->execute(
                array(
                    'id' => $id
                )
            );

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        $row = $statement->fetch();

        return $row['name'];
    }

    function getEmptyQuizzes() {
        // Dohvaća prazne kvizove (kvizove bez pitanja)
        $database = DB::getConnection();

        try {
            $statement = $database->prepare(
                'SELECT id, questions_amount
                FROM (
                    SELECT quizzes.id AS id, (SELECT COUNT(*) FROM quizzes_questions WHERE quiz_id = quizzes.id) AS questions_amount
                    FROM quizzes
                ) AS subquery
                WHERE questions_amount = 0;'
            );

            $statement->execute();
            
            return $statement;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function addNewQuiz($quiz_name, $selected_questions) {
        // Ubacuje novi kviz u bazu podataka
        // Vraća true ako je ubacivanje uspješno, inače vraća false

        $database = DB::getConnection();

        try {
            $statement = $database->prepare(
				'INSERT INTO quizzes
				(name, author)
				VALUES
				(:name, :author);'
            );

            session_start();
            $statement->execute(
                array(
                    'name' => $quiz_name,
                    'author' => $_SESSION['id']
                )
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

        // Dohvati ID novog kviza
        $quiz_id = $this->getQuizIdByName($quiz_name);
        
        // Ubaci pitanja u novi kviz
        foreach ($selected_questions as $question_id) {
            try {
                $statement = $database->prepare(
                    'INSERT INTO quizzes_questions
                    (quiz_id, question_id)
                    VALUES
                    (:quiz_id, :question_id);'
                );

                $statement->execute(
                    array(
                        'quiz_id' => $quiz_id,
                        'question_id' => $question_id
                    )
                );
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        return true;
    }

    public function getQuizIdByName($quiz_name) {
        // Dohvaća ID kviza s danim imenom
        $database = DB::getConnection();

        try {
            $statement = $database->prepare(
                'SELECT id
                FROM quizzes
                WHERE name = :name;'
            );

            $statement->execute(
                array(
                    'name' => $quiz_name
                )
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        $row = $statement->fetch();
        return $row['id'];
    }
}

?>
