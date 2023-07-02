
var globalAnswers = []; 
var correctAnswer = "";  

    function PresentWholeQuestionContainer(number,question,answers,category,quizName,numOfCorrectlyAnswered,numOfAnswers,isAnswerCorrect){
        document.getElementById("info").innerHTML = quizName + "  \n  " + numOfCorrectlyAnswered + "/" + numOfAnswers;
        PresentQuestion(number,question,category);
        for(let i = 0; i < answers.length; i++){
            globalAnswers[i] = answers[i]; 
            if(i === 0) correctAnswer = answers[i]; 
        }
        ShuffleArray(globalAnswers);
        for(let i = 0; i < globalAnswers.length; i++) PresentAnswer(globalAnswers[i],isAnswerCorrect);
    }

    function PresentQuestion(number,question,category) {
        var questionContainer = document.getElementById("question-container");
        questionContainer.innerHTML = "<h2>" + number + ". " + question + "</h2>";
        questionContainer.style.backgroundColor = GetColorByQuestionCategory(category);
    }
    
    function PresentAnswer(answer,isAnswerCorrect) {
            var questionContainer = document.getElementById("question-container");
            var answerButton = document.createElement("button");
            answerButton.classList.add("answer-button");
            answerButton.innerHTML = answer;
            answerButton.addEventListener("click", function() {
                AnswerButtonClickHandler(isAnswerCorrect);
            });
            questionContainer.appendChild(answerButton);
    }

    function AnswerButtonClickHandler(isAnswerCorrect){
        console.log("AnswerButtonClickHandler funkcija!"); 
        var answerText = $(event.target).text()
        if(answerText === correctAnswer) {
            console.log("tocan odgovor!"); 
            isAnswerCorrect = true;  
        }   
        else {
            console.log("netocan odgovor"); 
            isAnswerCorrect = false;
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
      