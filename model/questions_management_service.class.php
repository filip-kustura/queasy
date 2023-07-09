<?php

require_once __DIR__ . '/../app/database/db.class.php';
require_once __DIR__ . '/quizzes_management_service.class.php';

class QuestionsManagementService {
    function removeEscChars($string) {
        return str_replace("\\'", "'", $string);
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

    function getAllQuestions() {
        // Iz baze podataka dohvaća podatke o svim pitanjima
        // Vraća dvodimenzionalni array s pitanjima, odnosno njihovim podacima

        $database = DB::getConnection();

        try {
            $statement = $database->prepare(
                'SELECT questions.id id, category, question, answer, optionA, optionB, optionC, users.username author, (SELECT COUNT(*) FROM quizzes_questions WHERE question_id = questions.id) occurrences
                FROM questions, users 
                WHERE questions.author = users.id
                ORDER BY id DESC;'
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

        return $this->getQuestionsArray($statement);
    }

    function deleteQuestion($id) {
        // Iz baze podataka briše pitanje sa danim IDjem

        $database = DB::getConnection();

        try {
            $statement = $database->prepare(
                'DELETE
                FROM questions 
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

        // Iz tablice quizzes_questions također je potrebno izbrisati zapise sa danim IDjem pitanja
        try {
            $statement = $database->prepare(
                'DELETE
                FROM quizzes_questions 
                WHERE question_id = :id;'
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

        // Provjeri je li pitanje koje smo izbrisali bilo jedino pitanje (preostalo) u nekom od kvizova
        // Ako jest, izbriši svaki kviz koji je sada prazan
        $qms = new QuizzesManagementService();
        $emptyQuizzesStatement = $qms->getEmptyQuizzes();
        foreach ($emptyQuizzesStatement->fetchAll() as $row)
            $qms->deleteQuiz($row['id']);

        return true;
    }

    function insertMultipleChoiceQuestion($category, $question, $answer, $wrong_answer_1, $wrong_answer_2, $wrong_answer_3, $author_id) {
        // U bazu podataka ubacuje pitanje s ponuđenim odgovorima
        
        $database = DB::getConnection();

        try {
            $st = $database->prepare( 'INSERT INTO questions(category, question, answer, optionA, optionB, optionC, author) VALUES (:category, :question, :answer, :optionA, :optionB, :optionC, :author)' );
    
            $st->execute(
                array(
                    'category' => $category,
                    'question' => $question,
                    'answer' => $answer,
                    'optionA' => $wrong_answer_1,
                    'optionB' => $wrong_answer_2,
                    'optionC' => $wrong_answer_3,
                    'author' => $author_id
                )
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function insertOpenClozeQuestion($category, $question, $answer, $author_id) {
        $database = DB::getConnection();

        try {
            $st = $database->prepare( 'INSERT INTO questions(category, question, answer, author) VALUES (:category, :question, :answer, :author)' );

            $st->execute(
                array(
                    'category' => $category,
                    'question' => $question,
                    'answer' => $answer,
                    'author' => $_SESSION['id']
                )
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
