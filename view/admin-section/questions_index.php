<?php require_once __DIR__ . '/../_header.php'; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="view/javascript-files/emphasize-active-tab.js"></script>
<script src="view/javascript-files/table-display.js"></script>
<script src="view/javascript-files/question-deletion.js"></script>
<script src="view/javascript-files/form-display.js"></script>

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
    <div>
        Add new question:
        <input type="radio" name="question-type" id="multiple-choice-radio" value="multiple-choice"><label for="multiple-choice-radio">Multiple-choice</label>
        <input type="radio" name="question-type" id="open-cloze-radio" value="open-cloze"><label for="open-cloze-radio">Open cloze</label>
        <div id="form-div" style="margin-top: 10px;"></div>
    </div>
    
    <div>
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

    getQuestionsAndDisplayTables();
});

function getQuestionsAndDisplayTables(authorId = 0) {
    // Kroz ajax request dohvaća podatke o željenim pitanjima
    // authorId predstavlja ID admina čija je pitanja potrebno prikazati
    // Ako je potrebno prikazati sva pitanja, authorId je 0
    // Po uspješnom requestu, prikazuje podatke o željenim pitanjima u dvije tablice
    $.ajax({
        url: 'ajax_handler.php',
        type: 'GET',
        dataType: 'json',
        data: {
            action: 'get_questions',
            authorId: authorId
        },
        success: function(data) {
            displayQuestionsTable(data);
        }
    });
}

function myQuestionsCheckboxClickEventHandler($id) {
    // Event handler za click na checkbox

    // Onemogući klik na checkbox sve dok podaci ne budu dohvaćeni
    $('#my-questions-checkbox').prop('disabled', true);

    if ($('#my-questions-checkbox').prop('checked'))
        getQuestionsAndDisplayTables($id); // Korisnik je označio checkbox pa prikaži samo njegova pitanja
    else
        getQuestionsAndDisplayTables(); // Korisnik je odznačio checkbox pa prikaži sva pitanja

    // Ponovno omogući klik na checkbox nakon što su podaci dohvaćeni
    $('#my-questions-checkbox').prop('disabled', false);

    $('#warning').remove();
    $('#notification').html('');
}
</script>

<?php require_once __DIR__ . '/../_footer.php'; ?>
