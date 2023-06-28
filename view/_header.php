<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Queasy</title>
    <style>
        .footer-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #1f086c;
            padding: 16px;
        }

        .logo {
            width: 225px; /* Adjust the width as needed */
        }

        .menu {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .menu li {
            margin-right: 16px;
        }

        .menu li a {
            text-decoration: none;
            color: #da630e;
            padding: 8px 16px;
            font-size: 22px;
            font-weight: bold;
            font-family: "Arial", sans-serif;
        }

        .menu li a:hover {
            font-size: 22px;
            background-color: #da630e;
            color: #1f086c;
            font-weight: bold;
            font-family: "Arial", sans-serif;
        }

        .menu li a.active {
            background-color: #baa414;
            color: #baa414;
        }
    </style>
</head>
<body>
    <div class="footer-container">
        <div>
            <img src="queasylogo.png" alt="Queasy Logo" class="logo">
        </div>
        <ul class="menu">
            <li><a href="../controller/MyProfileController.php">My profile</a></li>
            <li><a href="../controller/RandomQuizController.php">Play random quiz</a></li>
            <li><a href="../controller/RandomQsController.php">Answer random questions</a></li>
            <li><a href="../controller/WhateverController.php">Dodati sto nam padne napamet?</a></li>
        </ul>
    </div>

