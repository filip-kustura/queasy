function confirmDeletion(id, author) {
    // Event handler za klik na delete ikonu
    $('#warning').remove();
    $('#notification').html('');
    
    if (confirm('Are you sure you want to delete the question (ID = ' + id + ') by ' + author + '?'))
        deleteQuestion(id, author);
};

function deleteQuestion(id, author) {
    $.ajax({
        url: 'ajax_handler.php',
        type: 'GET',
        dataType: 'json',
        data: {
            action: 'delete_question',
            id: id
        },
        success: function(data) {
            if (data === true) {
                $('#row' + id).remove();
                $('#notification').html('<b>Question (ID = ' + id + ') by ' + author + ' deleted.</b>');
            } else {
                alert('Error: Couldn\'t delete question (ID = ' + id + ') by ' + author + '.');
            }
        }
    });
}
