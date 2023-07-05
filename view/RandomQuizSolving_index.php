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

    function PresentWholeQuestionContainer(number,question,answers,category,quizName,numOfCorrectlyAnswered,numOfAnswers){
        document.getElementById("info").innerHTML = quizName + "  \n  " + numOfCorrectlyAnswered + "/" + numOfAnswers;
        var isQuestionABCDType = IsQuestionABCDType(answers);  
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
    
    function TextAnswerButtonClickHandler(){
        const textbox = document.getElementById('input-textbox');
        const answerText = textbox.value;
        orderNumberOfQuestion++;
        var indexOfNextQuestionId = orderNumberOfQuestion - 1;  
        numberOfAnswers++;
        if(orderNumberOfQuestion - 1 === numberOfQuestions) SendEndQuizAjax();
        if(answerText === correctAnswer) numberOfCorrectAnswers++;
        SendNextQuestionAjax(orderNumberOfQuestion,numberOfCorrectAnswers,numberOfAnswers,indexOfNextQuestionId);
    }

    function AnswerButtonClickHandler(){
        var answerText = $(event.target).text();
        orderNumberOfQuestion++;
        var indexOfNextQuestionId = orderNumberOfQuestion - 1;  
        numberOfAnswers++;
        if(orderNumberOfQuestion - 1 === numberOfQuestions) SendEndQuizAjax();
        if(answerText === correctAnswer) numberOfCorrectAnswers++;
        SendNextQuestionAjax(orderNumberOfQuestion,numberOfCorrectAnswers,numberOfAnswers,indexOfNextQuestionId);
    }

    //Pomocne funkcije

    function SendEndQuizAjax(){
        $.ajax({
            url: 'AjaxEndQuiz.php',
            type: 'GET',
            dataType: 'json',
            data: {
                //posalji rezultate kviza da se spreme u bazu podataka
                quizName: quizName,
                numberOfCorrectAnswers: numberOfCorrectAnswers,
                numberOfQuestions: numberOfQuestions 
            },
            success: function(data) {
                PresentEndQuizContainer(quizName,numberOfCorrectAnswers,numberOfQuestions); 
            },
            error: function( xhr, status, errorThrown ) { 
                console.log("error?"); 
                console.log(xhr);
                console.log(status);
                console.log(errorThrown);
            }
        });
    }

    function RemoveQuestionContainer(){
        const container = document.getElementById('container');
        if (container) container.remove();
    }

    function PresentEndQuizContainer(quizName, numberOfCorrectAnswers, numberOfAnswers){
        RemoveQuestionContainer();
        const container = document.createElement('div');
        container.classList.add('end-quiz-container');
        const quizNameElement = document.createElement('h2');
        quizNameElement.textContent = quizName;
        quizNameElement.classList.add('quiz-name');
        container.appendChild(quizNameElement);
        const quizResultsElement = document.createElement('p');
        quizResultsElement.textContent = `Results: ${numberOfCorrectAnswers}/${numberOfAnswers}`;
        quizResultsElement.classList.add('quiz-results');
        container.appendChild(quizResultsElement);
        document.body.appendChild(container);
    }

    function SendNextQuestionAjax(orderNumberOfQuestion,numberOfCorrectAnswers,numberOfAnswers,indexOfNextQuestionId){
        $.ajax({
            url: 'AjaxGetQuestionHandler.php',
            type: 'GET',
            dataType: 'json',
            data: {
                indexOfNextQuestionId: indexOfNextQuestionId,
                quizName: quizName 
            },
            success: function(data) {
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



    function IsQuestionABCDType(answers){
        if(answers[1] === null && answers[2] === null && answers[3] === null) return false; 
        else return true; 
    }

    function ShuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
       return array;
    }

    function GetColorByQuestionCategory(category){
        if(category === "history") return "lightblue";
        else if(category === "sports") return "orange";
        else if(category === "art") return "yellow"; 
        else if(category === "science") return "green";
        else if(category === "entertainment") return "red";
        else if(category === "geography") return "pink";
    }
      

</script>


<?php

require_once __DIR__ . '/_footer.php'; 

?>
