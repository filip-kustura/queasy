<?php 

require_once __DIR__ . '/_header.php'; 

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    #diagram-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    canvas {
        width: 100px;
        height: 100px;
        max-width: 20%; 
    }    

</style>

<div id="diagram-container">
  <!-- Dijagrami idu ovdje, dodaju se preko js -->
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
    CreateDiagram(historyCorr,historyAns,"history");
    CreateDiagram(sportsCorr,sportsAns,"sports");
    CreateDiagram(scienceCorr,scienceAns,"science");
    CreateDiagram(entertainmentCorr,entertainmentAns,"entertainment");
    CreateDiagram(artCorr,artAns,"art");
    CreateDiagram(geographyCorr,geographyAns,"geography");
});

    function CreateDiagram(numOfCorrect, numOfAnswered, category) {
        var container = document.getElementById('diagram-container');
        var canvas = document.createElement('canvas');
        container.appendChild(canvas);
        var color = GetColorByQuestionCategory(category);
        new Chart(canvas, {
            type: 'doughnut', 
            data: {
            datasets: [{
                data: [numOfCorrect, numOfAnswered ],
                backgroundColor: [
                color,
                'black' 
                ]
            }],
            labels: ['Correct', 'Incorrect']
            },
            options: {
                responsive: true,
                width: 50,
                height: 50,
                legend: {
                    display: false
                },
                layout: {
                    padding: {
                    left: 0,
                    right: 0,
                    top: 5, 
                    bottom: 0
                    }
                },
                plugins: {
                    legend: {
                    position: 'top' 
                    }
                }
            }
        });
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



