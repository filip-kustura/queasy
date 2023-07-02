function displayTable(quizzes) {
    $('#tbody').html('');
    $('#notification').html('');

    for (let quiz of quizzes) { // quizzes je array
        let deleteIcon = $('<img>')
            .attr({
                'src': 'imgs/delete-icon.png',
                'alt': 'delete-icon'
            });
        
        let deleteButton = $('<button>')
            .addClass('delete-button')
            .on('click', function() {
                confirmDeletion(quiz['id'], quiz['quiz_name'], quiz['author']);
            })
            .append(deleteIcon);
        
        let tdEmptyCell = $('<td>')
            .addClass('empty-cell')
            .append(deleteButton);

        let tr = $('<tr>')
            .attr('id', 'row' + quiz['id'])
            .append(tdEmptyCell);
        
        tr.append($('<td>')
            .html(quiz['id']));

        let tdQuizName = $('<td>')
            .append($('<a>')
                .attr('href', 'index.php?subdir=admin-section&rt=quiz&id=' + quiz['id'])
                .html(quiz['quiz_name']));
        tr.append(tdQuizName);

        tr.append($('<td>')
            .html(quiz['author']));

        tr.append($('<td>')
            .html(quiz['questions_amount']));

        $('#tbody').append(tr);
    }
}