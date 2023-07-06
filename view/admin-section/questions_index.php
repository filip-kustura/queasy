<?php require_once __DIR__ . '/../_header.php'; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="view/javascript-files/emphasize-active-tab.js"></script>
<script src="view/javascript-files/table-display.js"></script>

<p id="notification" style="color: green; padding-left: 40px;"></p>
<div style="position: absolute; top: 150px; padding-bottom: 100px;">
    <p style="margin-bottom: 0px; padding-left: 40px;">
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
                <th>No. of occurrences</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <!-- Popunjava se dinamički iz JavaScripta -->
        </tbody>
    </table>
</div>

<script>
// Istakni aktivni tab
emphasizeActiveTab('admin-section-tab')

$(document).ready(function() {
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
</script>

<?php require_once __DIR__ . '/../_footer.php'; ?>
