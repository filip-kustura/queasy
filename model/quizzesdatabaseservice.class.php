<?php

require_once __DIR__ . '/../app/database/db.class.php';

class QuizzesDatabaseService {
    function removeEscChars($string) {
        return str_replace("\\'", "'", $string);
    }

    function getQuizzesArray($statement) {
        // Za dani statement, stvara i popunjava array s podacima o kvizovima
        // Vraća stvoreni i popunjeni array

        $quizzes = array();

        foreach($statement->fetchAll() as $row) {
            $quiz = array();

            $quiz['id'] = $row['id'];
            $quiz['quiz_name'] = $row['quiz_name'];
            $quiz['author'] = $this->removeEscChars($row['author']);
            $quiz['questions_amount'] = $row['questions_amount'];

            $quizzes[] = $quiz;
        }

        return $quizzes;
    }

    function getQuestionsArray($statement) {
        // Za dani statement, stvara i popunjava array s podacima o pitanjima
        // Vraća stvoreni i popunjeni array

        $questions = array();

        foreach($statement->fetchAll() as $row) {
            $question = array();

            $question['id'] = $row['id'];
            $question['category'] = $this->removeEscChars($row['category']);
            $question['question'] = $this->removeEscChars($row['question']);
            $question['answer'] = $this->removeEscChars($row['answer']);
            
            $question['optionA'] = $this->removeEscChars($row['optionA']) !== '' ? $this->removeEscChars($row['optionA']) : '/';
            $question['optionB'] = $this->removeEscChars($row['optionB']) !== '' ? $this->removeEscChars($row['optionB']) : '/';
            $question['optionC'] = $this->removeEscChars($row['optionC']) !== '' ? $this->removeEscChars($row['optionC']) : '/';

            $question['author'] = $row['author'];
            $question['occurrences'] = $row['occurrences'];

            $questions[] = $question;
        }

        return $questions;
    }

    function getAllQuizzes() {
        // Iz baze podataka dohvaća podatke o svim kvizovima (ID kviza, naziv kviza, username autora kviza i broj pitanja u kvizu)
        // Vraća dvodimenzionalni array s kvizovima, odnosno njihovim podacima

        $database = DB::getConnection();

        try {
            $statement = $database->prepare(
                'SELECT quizzes.id id, quizzes.name quiz_name, users.username author, (SELECT COUNT(*) FROM quizzes_questions WHERE quiz_id = quizzes.id) questions_amount
                FROM quizzes, users 
                WHERE quizzes.author = users.id;'
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
                AND users.id = :author_id;'
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

    function getAllQuestions() {
        // Iz baze podataka dohvaća podatke o svim pitanjima
        // Vraća dvodimenzionalni array s pitanjima, odnosno njihovim podacima

        $database = DB::getConnection();

        try {
            $statement = $database->prepare(
                'SELECT questions.id id, category, question, answer, optionA, optionB, optionC, users.username author, (SELECT COUNT(*) FROM quizzes_questions WHERE question_id = questions.id) occurrences
                FROM questions, users 
                WHERE questions.author = users.id;'
            );

            $statement->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $this->getQuestionsArray($statement);
    }

    function getQuestionsByAuthorId($author_id) {
        // Iz baze podataka dohvaća sva pitanja nekog autora
        // Vraća dvodimenzionalni array s pitanjima, odnosno njihovim podacima

        $database = DB::getConnection();

        try {
            $statement = $database->prepare(
                'SELECT questions.id id, category, question, answer, optionA, optionB, optionC, users.username author, (SELECT COUNT(*) FROM quizzes_questions WHERE question_id = questions.id) occurrences
                FROM questions, users 
                WHERE questions.author = users.id
                AND users.id = :author_id;'
            );

            $statement->execute(
                array(
                    'author_id' => $author_id
                )
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $this->getQuestionsArray($statement);
    }
}

?>
