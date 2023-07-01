<?php require_once __DIR__ . '/../_header.php'; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="view/javascript-files/emphasize-active-tab.js"></script>
<script src="view/javascript-files/quiz-deletion.js"></script>

<table>
    <caption><h1>Quizzes</h1></caption>
    <thead>
        <tr>
            <th class="empty-cell"></th>
            <th>Quiz ID</th>
            <th>Quiz Name</th>
            <th>Author</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($quizzes as $quiz) {
                echo '<tr id="row' . $quiz['id'] . '">';
                echo '<td class="empty-cell">
                        <button class="delete-button" onclick="confirmDeletion(' . $quiz['id'] . ', \'' . $quiz['quiz_name'] . '\', \'' . $quiz['author'] . '\')">
                            <img src="imgs/delete-icon.png" alt="delete icon">
                        </button>
                    </td>';
                echo '<td>'.$quiz['id'].'</td>';
                echo '<td>'.$quiz['quiz_name'].'</td>';
                echo '<td>'.$quiz['author'].'</td>';
                echo '</tr>';
            }
        ?>
    </tbody>
</table>

<script>
// Istakni aktivni tab
emphasizeActiveTab('admin-section-tab')
</script>

<?php require_once __DIR__ . '/../_footer.php'; ?>
