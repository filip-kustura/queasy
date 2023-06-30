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
            <img src="imgs/queasylogo.png" alt="Queasy Logo" class="logo">
        </div>
        <?php
            if (isset($_SESSION['id'])) {
                echo '
        <nav>
            <li><a href="index.php?rt=RandomQuizSolving">My profile</a></li>
            <li><a href="index.php?rt=RandomQuizSolving">Play random quiz</a></li>
            <li><a href="../controller/RandomQsController.php">Answer random questions</a></li>
            <li><a href="../controller/WhateverController.php">Dodati sto nam padne napamet?</a></li>';

                if (isset($_SESSION['admin'])) // Ulogirani korisnik je admin
                    echo '
            <li class="dropdown">
                <a>Admin section</a>
                <div class="dropdown-content">
                    <a href="#">Quizzes</a>
                    <a href="#">Questions</a>
                    <a href="#">Users</a>
                </div>
            </li>';

                echo '
    	</nav>';

            }
        ?>
    </header>
