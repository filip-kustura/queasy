<?php 

$title = "Quiz Solving"; 
require_once __DIR__ . '/_header.php'; 
echo '<script src="view/QuizSolvinglib.js"></script>';
?>

<style>
    
    #container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h2 {
        font-size: 24px;
        font-weight: bold;
        color: #333333;
        margin-bottom: 10px;
        font-family:  Arial, sans-serif;
    }

    #question-container {
        position: relative;
        width: 800px;
        margin: 0 auto;
        padding: 50px;
        background-color: #F2F2F2;
        text-align: center;
    }
    
    #info {
        border: 2px solid #6c0505;
        border-radius: 10px;
        background-color: #1f1058;
        color: #b7e10e;
        margin: 0 auto;
        padding: 10px 20px;
        width: 250px;
        height: 30px; 
        text-align: center;
        font-size: 25px;
    }

    .answer-button {
        display: inline-block;
        width: 300px;
        margin: 15px;
        padding: 15px;
        background-color: #E0E0E0;
        border: none;
        cursor: pointer;
        color: white;
        background-image: linear-gradient(to bottom, #00a8e8, #0077b5);
        transition: background-color 0.3s;
    }

    .answer-button:hover {
        background-image: linear-gradient(to bottom, #3ac0ea, #0077b5);
    }
    </style>

    <div id="container">
        <div id="question-container">
        <h2 id="question"></h2>
        <div id="answers"></div>
        </div>
        <div id="info"></div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script> 
    

    $(document).ready(function () {
        console.log("Prije poziva PresentWholeQuestion funkcije");
        //Ovo je krivi poziv, popravi
        var answers = []; 
        answers[0] = "<?php echo $_SESSION['answers'][0]; ?>";
        answers[1] = "<?php echo $_SESSION['answers'][1]; ?>";
        answers[2] = "<?php echo $_SESSION['answers'][2]; ?>";
        answers[3] = "<?php echo $_SESSION['answers'][3]; ?>";
        var color = "<?php echo $_SESSION['color']; ?>";
        var quizName = "<?php echo $_SESSION['quizName']; ?>";
        var question = "<?php echo $_SESSION['question']; ?>";
        for(let i = 0; i < answers.length; i++){
            console.log("Odgovor = " + answers[i]); 
        }
        PresentWholeQuestionContainer(
            <?php echo $_SESSION["orderNumberOfQuestion"]; ?>,
            question,
            answers,
            color,
            quizName,
            <?php echo $_SESSION["numOfCorrectlyAnswered"]; ?>,
            <?php echo $_SESSION["numOfAnsweredQuestions"]; ?>
        );
        console.log("Nakon poziva PresentWholeQuestion funkcije");
    });


    //Pomocne funkcije
    function ConvertAnswersToJSArray(str1, str2, str3, str4) {
        return [str1, str2, str3, str4];
    }

</script>


<?php

require_once __DIR__ . '/_footer.php'; 

?>
