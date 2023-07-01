

function PresentWholeQuestionContainer(number,question,answers,questionColor,quizName,numOfCorrectlyAnswered,numOfAnswers){
        console.log("Pozvana PresentWholeQuestionContainer");
        document.getElementById("info").innerHTML = quizName + "  \n  " + numOfCorrectlyAnswered + "/" + numOfAnswers;
        PresentQuestion(number,question,questionColor);
        for(let i = 0; i < answers.length; i++) PresentAnswer(answers[i]);
    }

    function PresentQuestion(number,question,questionColor) {
        var questionContainer = document.getElementById("question-container");
        questionContainer.innerHTML = "<h2>" + number + ". " + question + "</h2>";
        questionContainer.style.backgroundColor = questionColor;
    }
    
    function PresentAnswer(answer) {
            var questionContainer = document.getElementById("question-container");
            var answerButton = document.createElement("button");
            answerButton.classList.add("answer-button");
            answerButton.innerHTML = answer;
            answerButton.addEventListener("click", IsAnswerCorrect);
            questionContainer.appendChild(answerButton);
    }

    //vraca true/false
    function IsAnswerCorrect(){
        var answerText = $(event.target).text()
        if(answerText === answers[i]) return true; 
        else return false;
    }