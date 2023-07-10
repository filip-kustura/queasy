function RemoveQuestionContainer(){
    const container = document.getElementById('container');
    if (container) container.remove();
}

function SendNextQuestionAjax(quizName,orderNumberOfQuestion,numberOfCorrectAnswers,numberOfAnswers,indexOfNextQuestionId,isCorrect,category){
    return new Promise(function (resolve, reject) {
    $.ajax({
        url: 'AjaxGetQuestionHandler.php',
        type: 'GET',
        dataType: 'json',
        data: {
            isCorrect: isCorrect,
            category: category,
            indexOfNextQuestionId: indexOfNextQuestionId,
            quizName: quizName
        },
        success: function (data) {
            if (data === true) {
                PresentEndQuizContainer();
            } else {
                PresentWholeQuestionContainer(
                    orderNumberOfQuestion,
                    data[0],
                    data[1],
                    data[2],
                    quizName,
                    numberOfCorrectAnswers,
                    numberOfAnswers
                );
            }
            resolve();
        },
        error: function (xhr, status, errorThrown) {
            console.log("error?");
            console.log(xhr);
            console.log(status);
            console.log(errorThrown);
            reject(errorThrown); 
        }
    });
});
}

function IsQuestionABCDType(answers){
    if(answers[1] === null && answers[2] === null && answers[3] === null) return false; 
    else return true; 
}

PrintArray = function(array){
    for(var i = 0; i < array.length; i++){
        console.log("i = " + i + "vrijednost arr[i] = " + array[i]);
    }
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

function PresentEndQuizContainer(){        
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
    const finishButton = document.createElement('a');
    finishButton.textContent = 'Finish';
    finishButton.classList.add('finish-button');
    finishButton.href = 'index.php?rt=EndQuiz';
    container.appendChild(finishButton);
    document.body.appendChild(container);
}

function removeEscChars(string) {
    return string.replace(/\\'/g, "'");
  }