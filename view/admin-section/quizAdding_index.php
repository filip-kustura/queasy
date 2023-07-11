<?php require_once __DIR__ . '/../_header.php'; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="view/javascript-files/emphasize-active-tab.js"></script>
<script src="view/javascript-files/table-display.js"></script>

<p id="notification" style="color: green; padding-left: 40px;">
    <?php
        if (isset($_SESSION['notification'])) {
            echo '<b>' . $_SESSION['notification'] . '</b>';
            unset($_SESSION['notification']);
        }
    ?>
</p>
<?php require_once __DIR__ . '/../warning.php'; ?>

<div style="position: absolute; top: 150px; padding-left: 40px; padding-bottom: 100px;">
    <h1>Add new quiz</h1>
    <div style="margin-left: 20px;">
        <h2>Select the questions from the table below by using checkboxes.</h2>
        <form action="index.php?subdir=admin-section&rt=quizAdding/processQuizAdding" method="post">
            <label for="quiz-name-input">Quiz name:</label>
            <input type="text" name="quiz-name" id="quiz-name-input" style="margin-left: 5px;">
            <input type="submit" value="Add quiz">
            <p style="margin-bottom: 0px;">
                <?php
                echo '<input type="checkbox" name="my-questions" id="my-questions-checkbox" onclick="myQuestionsCheckboxClickEventHandler(' . $_SESSION['id'] . ')">';
                ?>
                <label for="my-questions-checkbox">Show my questions only</label>
            </p>
            <table>
                <caption><h1>Questions</h1></caption>
                <thead>
                    <tr>
                        <th class="empty-cell"></th>
                        <th>Question ID</th>
                        <th>Category</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Option</th>
                        <th>Option</th>
                        <th>Option</th>
                        <th>Author</th>
                        <th>Number of occurrences</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <!-- Popunjava se dinamički iz JavaScripta -->
                </tbody>
            </table>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    // Istakni aktivni tab
    emphasizeActiveTab('admin-section-tab');
    
    $('#my-questions-checkbox').prop('checked', false);
    $('input[name="question-type"]').prop('checked', false);

    $('input[name="question-type"]').change(function() {
        if ($(this).is(':checked')) {
            multipleChoiceQuestion = $(this).val() === 'multiple-choice';
            
            if (multipleChoiceQuestion)
                displayAddQuestionForm(multipleChoiceQuestion = true);
            else
                displayAddQuestionForm(multipleChoiceQuestion = false);

            $('#notification').html('');
        }
    });

    getQuestionsAndDisplayTable();
});

function getQuestionsAndDisplayTable(authorId = 0) {
    // Kroz ajax request dohvaća podatke o željenim pitanjima
    // authorId predstavlja ID admina čija je pitanja potrebno prikazati
    // Ako je potrebno prikazati sva pitanja, authorId je 0
    // Po uspješnom requestu, prikazuje podatke o željenim pitanjima
    $.ajax({
        url: 'ajax_handler.php',
        type: 'GET',
        dataType: 'json',
        data: {
            action: 'get_questions',
            authorId: authorId
        },
        success: function(data) {
            displayQuestionsTable(data, checkboxes = true);
        }
    });
}

function myQuestionsCheckboxClickEventHandler($id) {
    // Event handler za click na checkbox

    // Onemogući klik na checkbox sve dok podaci ne budu dohvaćeni
    $('#my-questions-checkbox').prop('disabled', true);

    if ($('#my-questions-checkbox').prop('checked'))
        getQuestionsAndDisplayTable($id); // Korisnik je označio checkbox pa prikaži samo njegova pitanja
    else
        getQuestionsAndDisplayTable(); // Korisnik je odznačio checkbox pa prikaži sva pitanja

    // Ponovno omogući klik na checkbox nakon što su podaci dohvaćeni
    $('#my-questions-checkbox').prop('disabled', false);

    $('#warning').remove();
    $('#notification').html('');
}
</script>

<?php require_once __DIR__ . '/../_footer.php'; ?>
