 <?php 

$title = "Quiz Solving"; 

require_once __DIR__ . '/_header.php'; 

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
    
    var correctAnswer = ""; 
    var quizName = "";
    var orderNumberOfQuestion = 1; 
    var numberOfQuestions = 0; 
    var numberOfCorrectAnswers = 0; 
    var numberOfAnswers = 0; 
    
    $(document).ready(function () {
        //prvo pitanje
        
        var answers = []; 
        numberOfQuestions =<?php echo $_SESSION['numberOfQuestions']; ?>;
        answers[0] = "<?php echo $_SESSION['answers'][0]; ?>";
        answers[1] = "<?php echo $_SESSION['answers'][1]; ?>";
        answers[2] = "<?php echo $_SESSION['answers'][2]; ?>";
        answers[3] = "<?php echo $_SESSION['answers'][3]; ?>";
        var category = "<?php echo $_SESSION['questionCategory']; ?>";
        quizName = "<?php echo $_SESSION['quizName']; ?>";
        var question = "<?php echo $_SESSION['question']; ?>";

        PresentWholeQuestionContainer(
            1,
            question,
            answers,
            category,
            quizName,
            0,
            0
        );
    });

    //Funkcija iz biblioteke, necu includeat zbog greske sa pozivom handlera! 

    function PresentWholeQuestionContainer(number,question,answers,category,quizName,numOfCorrectlyAnswered,numOfAnswers){
        document.getElementById("info").innerHTML = quizName + "  \n  " + numOfCorrectlyAnswered + "/" + numOfAnswers;
        PresentQuestion(number,question,category);
        correctAnswer = answers[0]; 
        ShuffleArray(answers);
        for(let i = 0; i < answers.length; i++) PresentAnswer(answers[i]);
    }

    function PresentQuestion(number,question,category) {
        var questionContainer = document.getElementById("question-container");
        questionContainer.innerHTML = "<h2>" + number + ". " + question + "</h2>";
        questionContainer.style.backgroundColor = GetColorByQuestionCategory(category);
    }
    
    function PresentAnswer(answer) {
        console.log("present answer funkcija");
        var questionContainer = document.getElementById("question-container");
        var answerButton = document.createElement("button");
        answerButton.classList.add("answer-button");
        answerButton.innerHTML = answer;
        answerButton.addEventListener("click",AnswerButtonClickHandler);
        questionContainer.appendChild(answerButton);
    }

    function AnswerButtonClickHandler(){
        console.log("AnswerButtonClickHandler funkcija!"); 
        var answerText = $(event.target).text();
        orderNumberOfQuestion++;
        var indexOfNextQuestionId = orderNumberOfQuestion - 1;  
        numberOfAnswers++;
        console.log("quiz name " + quizName); 
        console.log("numberOfAnswers" + numberOfAnswers);
        if(answerText === correctAnswer) {
            numberOfCorrectAnswers++;
            console.log("u ifu");
            $.ajax({
            url: 'AjaxGetQuestionHandler.php',
            type: 'GET',
            dataType: 'json',
            data: {
                indexOfNextQuestionId: indexOfNextQuestionId,
                quizName: quizName 
            },
            success: function(data) {
                console.log("succes");
                PresentWholeQuestionContainer(
                        orderNumberOfQuestion,
                        data[0],
                        data[1],
                        data[2],
                        quizName,
                        numberOfCorrectAnswers,
                        numberOfAnswers
                    );
            },
            error: function( xhr, status, errorThrown ) { 
                    console.log("error?"); 
                    console.log(xhr);
                    console.log(status);
                    console.log(errorThrown);
                }
            });
        }
        else{
            $.ajax({
            url: 'AjaxGetQuestionHandler.php',
            type: 'GET',
            dataType: 'json',
            data: {
                indexOfNextQuestionId: indexOfNextQuestionId,
                quizName: quizName 
            },
            success: function(data) {
                console.log("succes");
                PresentWholeQuestionContainer(
                        orderNumberOfQuestion,
                        data[0],
                        data[1],
                        data[2],
                        quizName,
                        numberOfCorrectAnswers,
                        numberOfAnswers
                    );
            },
            error: function( xhr, status, errorThrown ) { 
                    console.log("error?"); 
                    console.log(xhr);
                    console.log(status);
                    console.log(errorThrown);
                }
            });
        }
                
    }

    //Pomocne funkcije
    function ShuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
       return array;
    }

    function GetColorByQuestionCategory($category){
        if($category === "history") return "lightblue";
        else if($category === "sports") return "orange";
        else if($category === "art") return "yellow"; 
        else if($category === "science") return "green";
        else if($category === "entertainment") return "red";
        else if($category === "geography") return "pink";
    }
      

</script>


<?php

require_once __DIR__ . '/_footer.php'; 

?>
