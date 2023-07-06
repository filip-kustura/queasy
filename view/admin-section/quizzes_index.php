<?php require_once __DIR__ . '/../_header.php'; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="view/javascript-files/emphasize-active-tab.js"></script>
<script src="view/javascript-files/quiz-deletion.js"></script>
<script src="view/javascript-files/table-display.js"></script>

<p id="notification" style="color: green; padding-left: 40px;"></p>
<div style="position: absolute; top: 150px; padding-bottom: 100px;">
    <p style="margin-bottom: 0px; padding-left: 40px;">
        <?php
        echo '<input type="checkbox" name="my-quizzes" id="my-quizzes-checkbox" onclick="myQuizzesCheckboxClickEventHandler(' . $_SESSION['id'] . ')">';
        ?>
        <label for="my-quizzes-checkbox">Show my quizzes only</label>
    </p>
    <table>
        <caption><h1>Quizzes</h1></caption>
        <thead>
            <tr>
                <th class="empty-cell"></th>
                <th>Quiz ID</th>
                <th style="min-width: 160px;">Quiz Name</th>
                <th style="min-width: 160px;">Author</th>
                <th>No. of questions</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <!-- Popunjava se dinamički iz JavaScripta -->
        </tbody>
    </table>
</div>

<script>
// Istakni aktivni tab
emphasizeActiveTab('admin-section-tab');

$(document).ready(function() {
    getQuizzesAndDisplayTable();
});

function getQuizzesAndDisplayTable(authorId = 0) {
    // Kroz ajax request dohvaća podatke o željenim kvizovima
    // authorId predstavlja ID admina čije je kvizove potrebno prikazati
    // Ako je potrebno prikazati sve kvizove, authorId je 0
    // Po uspješnom requestu, prikazuje podatke o željenim kvizovima u tablici
    $.ajax({
        url: 'ajax_handler.php',
        type: 'GET',
        dataType: 'json',
        data: {
            action: 'get_quizzes',
            authorId: authorId
        },
        success: function(data) {
            displayQuizzesTable(data);
        }
    });
}

function myQuizzesCheckboxClickEventHandler($id) {
    // Event handler za click na checkbox

    if ($('#my-quizzes-checkbox').prop('checked'))
        getQuizzesAndDisplayTable($id); // Korisnik je označio checkbox pa prikaži samo njegove kvizove
    else
        getQuizzesAndDisplayTable(); // Korisnik je odznačio checkbox pa prikaži sve kvizove
}
</script>

<?php require_once __DIR__ . '/../_footer.php'; ?>
