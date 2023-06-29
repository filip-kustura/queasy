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
            if (isset($_SESSION['id']))
                echo '
        <nav>
            <li><a href="../controller/MyProfileController.php">My profile</a></li>
            <li><a href="RandomQuizSolvingController.php">Play random quiz</a></li>
            <li><a href="../controller/RandomQsController.php">Answer random questions</a></li>
            <li><a href="../controller/WhateverController.php">Dodati sto nam padne napamet?</a></li>
    	</nav>
        ';
        ?>
    </header>
