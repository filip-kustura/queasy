
function confirmDeletion(id, quizName, author) {
    // Event handler za klik na delete ikonu
    if (confirm('Are you sure you want to delete the quiz "' + quizName + '" by ' + author + '?'))
        deleteQuiz(id);
};

function deleteQuiz(id) {
    $.ajax({
        url: 'ajax_handler.php',
        type: 'GET',
        dataType: 'json',
        data: {
            action: 'delete',
            id: id
        },
        success: function(data) {
            if (data === true) {
                $('#row' + id).remove();
            }
        }
    })
}