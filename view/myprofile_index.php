<?php 

require_once __DIR__ . '/_header.php'; 

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
#diagrams-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: flex-start;
      }

      .diagram-container {
        width: 200px;
        height: 250px; 
        margin: 5px;
        border: 4px solid #baa414; 
        padding: 10px; 
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border-radius: 10px; 
        background-color: #1f086c;

      }

      .diagram-text {
        text-align: center;
        color: #dbc848; 
        font-weight: bold; 
        font-size: 20px;
        font-family: Arial, sans-serif; 
    }

    .diagram-percentage {
        color: #dbc848;
        font-weight: bold;
        font-size: 20px;
      }
</style>

<div id="diagrams-container">
    <div class="diagram-container" id="diagram-container-1">
      <div class="diagram-text">History</div>
      <div class="diagram-percentage"></div>
    </div>
    <div class="diagram-container" id="diagram-container-2">
      <div class="diagram-text">Sports</div>
      <div class="diagram-percentage"></div>
    </div>
    <div class="diagram-container" id="diagram-container-3">
      <div class="diagram-text">Science</div>
      <div class="diagram-percentage"></div>
    </div>
    <div class="diagram-container" id="diagram-container-4">
      <div class="diagram-text">Entertainment</div>
      <div class="diagram-percentage"></div>
    </div>
    <div class="diagram-container" id="diagram-container-5">
      <div class="diagram-text">Art</div>
      <div class="diagram-percentage"></div>
    </div>
    <div class="diagram-container" id="diagram-container-6">
      <div class="diagram-text">Geography</div>
      <div class="diagram-percentage"></div>
    </div>
  </div>


<script>



$(document).ready(function () {
    
    var historyCorr =<?php echo $_SESSION['historyCorr']; ?>;
    var historyAns = <?php echo $_SESSION['historyAns']; ?>;
    var sportsCorr = <?php echo $_SESSION['sportsCorr']; ?>;
    var sportsAns = <?php echo $_SESSION['sportsAns']; ?>;
    var scienceCorr = <?php echo $_SESSION['scienceCorr']; ?>;
    var scienceAns = <?php echo $_SESSION['scienceAns']; ?>;
    var entertainmentCorr = <?php echo $_SESSION['entertainmentCorr']; ?>;
    var entertainmentAns = <?php echo $_SESSION['entertainmentAns']; ?>;
    var geographyCorr = <?php echo $_SESSION['geographyCorr']; ?>;
    var geographyAns = <?php echo $_SESSION['geographyAns']; ?>;
    var artCorr = <?php echo $_SESSION['artCorr']; ?>;
    var artAns = <?php echo $_SESSION['artAns']; ?>;
    
    //crtanje odgovarajucih dijagrama
    CreateDiagram(historyCorr,historyAns,"history","diagram-container-1");
    CreateDiagram(sportsCorr,sportsAns,"sports","diagram-container-2");
    CreateDiagram(scienceCorr,scienceAns,"science","diagram-container-3");
    CreateDiagram(entertainmentCorr,entertainmentAns,"entertainment","diagram-container-4");
    CreateDiagram(artCorr,artAns,"art","diagram-container-5");
    CreateDiagram(geographyCorr,geographyAns,"geography","diagram-container-6");
});

function CreateDiagram(numOfCorrect, numOfAnswered, category, containerId) {
        var container = document.getElementById(containerId);
        var canvas = document.createElement("canvas");
        container.appendChild(canvas);
        var color = GetColorByQuestionCategory(category);
        new Chart(canvas, {
          type: "doughnut",
          data: {
            datasets: [
              {
                data: [numOfCorrect, numOfAnswered - numOfCorrect],
                backgroundColor: [color, "gray"],
              },
            ],
            labels: ["Correct", "Incorrect"],
          },
          options: {
            responsive: true,
            cutout: "40%",
            width: 50,
            height: 50,
            layout: {
              padding: {
                left: 0,
                right: 0,
                top: 5,
                bottom: 0,
              },
            },
            plugins: {
              legend: {
                display: false,
              },
            },
          },
        });
        var percentage;
        if(numOfAnswered === 0) percentage = "Answer some " + category +  " questions! :)";
        else percentage = ((numOfCorrect * 100) / numOfAnswered).toFixed(0) + "%";
        container.getElementsByClassName(
          "diagram-percentage"
        )[0].innerText = percentage;
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



