function confirmDeletion(id, quizName, author) {
    // Event handler za klik na delete ikonu
    if (confirm('Are you sure you want to delete the quiz "' + quizName + '" by ' + author + '?'))
        deleteQuiz(id, quizName, author);
};

function deleteQuiz(id, quizName, author) {
    $.ajax({
        url: 'ajax_handler.php',
        type: 'GET',
        dataType: 'json',
        data: {
            action: 'delete_quiz',
            id: id
        },
        success: function(data) {
            if (data === true) {
                $('#row' + id).remove();
                $('#notification').html('<b>Quiz "' + quizName + '" by ' + author + ' deleted.</b>');
            } else {
                alert('Error: Couldn\'t delete quiz "' + quizName + '" by ' + author + '.');
                $('#notification').html('');
            }
        }
    });
}
