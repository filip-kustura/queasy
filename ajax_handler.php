<?php

require_once __DIR__ . '/model/quizzesdatabaseservice.class.php';

function sendJSONandExit($message)
{
    // Kao izlaz skripte pošalji $message u JSON formatu i prekini izvođenje.
    header( 'Content-type:application/json;charset=utf-8' );
    echo json_encode($message);
    flush();
    exit( 0 );
}

$qds = new QuizzesDatabaseService();

$action = $_GET['action'];
if ($action === 'delete_quiz') {
    if ($qds->deleteQuiz($_GET['id'])) // Uspješan delete
        sendJSONandExit(true);
    else
        sendJSONandExit(false);
} else if ($action === 'get_quizzes') {
    if ($_GET['authorId'] === '0')
        sendJSONandExit($qds->getAllQuizzes());
    else
        sendJSONandExit($qds->getQuizzesByAuthorId($_GET['authorId']));
}

?>
