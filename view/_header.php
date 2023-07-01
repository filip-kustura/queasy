<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Queasy</title>
    <link rel="stylesheet" href="css/queasy.css">
</head>
<body>
    <header>
        <div>
            <a href="index.php?rt=home"><img src="imgs/queasylogo.png" alt="Queasy Logo" class="logo"></a>
        </div>
        <?php
            if (isset($_SESSION['id'])) {
                echo '
        <nav>
            <li><a id="my-profile-tab" href="index.php?rt=RandomQuizSolving">My profile</a></li>
            <li><a id="play-random-quiz-tab" href="index.php?rt=RandomQuizSolving">Play random quiz</a></li>
            <li><a id="answer-radnom-questions-tab" href="../controller/RandomQsController.php">Answer random questions</a></li>';

                if (isset($_SESSION['admin'])) // Ulogirani korisnik je admin
                    echo '
            <li class="dropdown">
                <a id="admin-section-tab">Admin section</a>
                <div class="dropdown-content">
                    <a href="index.php?subdir=admin-section&rt=quizzes">Quizzes</a>
                    <a href="index.php?subdir=admin-section&rt=questions">Questions</a>
                    <a href="index.php?subdir=admin-section&rt=users">Users</a>
                </div>
            </li>';

                echo '
    	</nav>';

            }
        ?>
    </header>
