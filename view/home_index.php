<?php require_once __DIR__ . '/_header.php'; 

?>

<?php if (isset($_SESSION['new-user'])) {
    echo '<p style="color: green;">Registration successful!</p>';
    unset($_SESSION['new-user']);
} ?>

<?php echo "<br>"; ?>
<span>Welcome, <?php echo($_SESSION['username']); ?>.</span>
<?php

if(isset($_SESSION["sendMsg"])){
    if($_SESSION["sendMsg"] === true){
        $_SESSION["sendMsg"] = false; 
        echo '<script> alert("You already played this quiz!"); </script>';
    }
}

if(isset($_SESSION["playedAll"])){
    if($_SESSION["playedAll"] === true){
        $_SESSION["playedAll"] = false; 
        echo '<script> alert("Congratulations! You played all our quizzes!"); </script>';
    }
}
?>


<?php echo "<br>"; ?>

<style>
.quiz-container {
    background-color: #f8f8f8;
    border: 1px solid #ddd;
    padding: 20px;
    margin: 20px;
    border-radius: 5px;
}

.play-button {
    background-color: green;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 4px;
}
</style>

<?php 
//U svakoj kartici koja reprezentira jedan kviz prikazi:
//Ime kviza
//Ime autora kviza 
//Broj pitanja 
//Play button

function GenerateQuizContainers($names, $counts, $authors) {
    $container = '';
    
    for ($i = 0; $i < Count($names); $i++) {
        $quizName = $names[$i];
        $questionCount = $counts[$i];
        $authorName = $authors[$i];
        $container .= '<div class="quiz-container">';
        $container .= '<h3>' . $quizName . '</h3>';
        $container .= '<p>Number of Questions: ' . $questionCount . '</p>';
        $container .= '<p>Author: ' . $authorName . '</p>';
        $container .= '<form method="post" action="index.php?rt=RandomQuizSolving">';
        $container .= '<input type="hidden" name="quizName" value="' . htmlspecialchars($quizName) . '">';
        $container .= '<button type="submit" class="play-button">Play</button>';
        $container .= '</form>';
        $container .= '</div>';
    }
    return $container;
}




echo GenerateQuizContainers($_SESSION["quizNames"],$_SESSION["quizNumOfQuestions"],$_SESSION["quizAuthor"]);

echo "<br>";
echo "<br>";
echo "<br>"; 
?>

<?php require_once __DIR__ . '/_footer.php'; ?>
