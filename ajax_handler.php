<?php

require_once __DIR__ . '/model/quizzes_management_service.class.php';
require_once __DIR__ . '/model/questions_management_service.class.php';

function sendJSONandExit($message)
{
    // Kao izlaz skripte pošalji $message u JSON formatu i prekini izvođenje.
    header( 'Content-type:application/json;charset=utf-8' );
    echo json_encode($message);
    flush();
    exit( 0 );
}

$quizzes_ms = new QuizzesManagementService();
$questions_ms = new QuestionsManagementService();

$action = $_GET['action'];
if ($action === 'delete_quiz') {
    if ($quizzes_ms->deleteQuiz($_GET['id'])) // Uspješan delete
        sendJSONandExit(true);
    else
        sendJSONandExit(false);
} else if ($action === 'delete_question') {
    if ($questions_ms->deleteQuestion($_GET['id'])) // Uspješan delete
        sendJSONandExit(true);
    else
        sendJSONandExit(false);
} else if ($action === 'get_quizzes') {
    if ($_GET['authorId'] === '0')
        sendJSONandExit($quizzes_ms->getAllQuizzes());
    else
        sendJSONandExit($quizzes_ms->getQuizzesByAuthorId($_GET['authorId']));
} else if ($action === 'get_questions') {
    if ($_GET['authorId'] === '0')
        sendJSONandExit($questions_ms->getAllQuestions());
    else
        sendJSONandExit($questions_ms->getQuestionsByAuthorId($_GET['authorId']));
}

?>
