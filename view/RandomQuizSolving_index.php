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

    .end-quiz-container {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        padding: 20px;
        margin: 20px;
        border-radius: 5px;
    }

    .quiz-name {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .quiz-results {
        font-size: 18px;
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

    .input-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
    }

    .input-textbox {
        padding: 10px;
        margin-right: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 16px;
        width: 200px;
    }

    .input-button {
        padding: 10px 20px;
        background-color: #4caf50;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
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

    .finish-button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 20px;
        cursor: pointer;
        border-radius: 5px;
    }

    .answer-button:hover {
        background-image: linear-gradient(to bottom, #3ac0ea, #0077b5);
    }
    </style>

    <div id="container">
        <div id="question-container">
        <h2 id="question"></h2>
        <div id="answers"></div>
        <input type="text" id="input-textbox"/>
        </div>
        <div id="info"></div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="view/QuizSolving.js"></script>

<script> 
    
    var correctAnswer = ""; 
    var quizName = "";
    var orderNumberOfQuestion = 1; 
    var numberOfQuestions = 0; 
    var numberOfCorrectAnswers = 0; 
    var numberOfAnswers = 0; 
    var curr_category = ""; 
    
    $(document).ready(function () {
        numberOfQuestions =<?php echo $_SESSION['numberOfQuestions']; ?>;
        quizName = '<?php echo $_SESSION['quizName']; ?>';
        SendNextQuestionAjax(quizName,1,0,0,0,false,"none");
    });

    function PresentWholeQuestionContainer(number,question,answers,category,quizName,numOfCorrectlyAnswered,numOfAnswers){
        document.getElementById("info").innerHTML = quizName + "  \n  " + numOfCorrectlyAnswered + "/" + numOfAnswers;
        var isQuestionABCDType = IsQuestionABCDType(answers);  
        curr_category = category; 
        question = removeEscChars(question);
        for(let i = 0; i < answers.length; i++){
            if(answers[i] === null) continue; 
            answers[i] = removeEscChars(answers[i]);
        }
        PresentQuestion(number,question,category);
        correctAnswer = answers[0]; 
        if(isQuestionABCDType){
            ShuffleArray(answers);
            for(let i = 0; i < answers.length; i++) PresentAnswer(answers[i]);
        }
        else PresentTextAnswerInput(); 
    }

    function PresentQuestion(number,question,category) {
        var questionContainer = document.getElementById("question-container");
        questionContainer.innerHTML = "<h2>" + number + ". " + question + "</h2>";
        questionContainer.style.backgroundColor = GetColorByQuestionCategory(category);
    }
    
    function PresentAnswer(answer) {
        var questionContainer = document.getElementById("question-container");
        var answerButton = document.createElement("button");
        answerButton.classList.add("answer-button");
        answerButton.innerHTML = answer;
        answerButton.addEventListener("click",AnswerButtonClickHandler);
        questionContainer.appendChild(answerButton);
    }

    function PresentTextAnswerInput(){
        const container = document.createElement('div');
        container.classList.add('input-container');
        const textbox = document.createElement('input');
        textbox.type = 'text';
        textbox.placeholder = 'Enter your answer in lower case...';
        textbox.classList.add('input-textbox');
        textbox.id = 'input-textbox';
        const button = document.createElement('button');
        button.textContent = 'Submit';
        button.classList.add('input-button');
        container.appendChild(textbox);
        container.appendChild(button);
        button.addEventListener("click", TextAnswerButtonClickHandler);
        const parentContainer = document.getElementById('question-container');
        parentContainer.appendChild(container);
    }
    
    async function TextAnswerButtonClickHandler(){
        const textbox = document.getElementById('input-textbox');
        var answerText = textbox.value;
        answerText = convertToLowerCase(answerText);
        orderNumberOfQuestion++;
        var isCorrect = "yes";
        var indexOfNextQuestionId = orderNumberOfQuestion - 1;  
        numberOfAnswers++;
        if(answerText === correctAnswer){
            numberOfCorrectAnswers++;
            isCorrect = "yes"; 
        }
        else isCorrect = "no";
        await SendNextQuestionAjax(quizName,orderNumberOfQuestion,numberOfCorrectAnswers,numberOfAnswers,indexOfNextQuestionId,isCorrect,curr_category);
    }

    async function AnswerButtonClickHandler(){
        var answerText = $(event.target).text();
        orderNumberOfQuestion++;
        var isCorrect = true; 
        var indexOfNextQuestionId = orderNumberOfQuestion - 1;  
        numberOfAnswers++;
        if(answerText === correctAnswer){
            numberOfCorrectAnswers++; 
            isCorrect = "yes"; 
        }
        else isCorrect = "no"; 
        await SendNextQuestionAjax(quizName,orderNumberOfQuestion,numberOfCorrectAnswers,numberOfAnswers,indexOfNextQuestionId,isCorrect,curr_category);
    }

</script>


<?php

require_once __DIR__ . '/_footer.php'; 

?>
