function displayQuizzesTable(quizzes) {
    $('#tbody').html('');

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

function displayQuestionsTable(questions) {
    $('#tbody').html('');

    for (let question of questions) { // questions je array
        let deleteIcon = $('<img>')
            .attr({
                'src': 'imgs/delete-icon.png',
                'alt': 'delete-icon'
            });
        
        let deleteButton = $('<button>')
            .addClass('delete-button')
            .on('click', function() {
                confirmDeletion(question['id'], question['author']);
            })
            .append(deleteIcon);
        
        let tdEmptyCell = $('<td>')
            .addClass('empty-cell')
            .append(deleteButton);

        let tr = $('<tr>')
            .attr('id', 'row' + question['id'])
            .append(tdEmptyCell);
        
        tr.append($('<td>')
            .html(question['id']));

        tr.append($('<td>')
            .html(question['category']));

        tr.append($('<td>')
            .html(question['question']));

        tr.append($('<td>')
            .html(question['answer']));

        tr.append($('<td>')
            .html(question['optionA']));

        tr.append($('<td>')
            .html(question['optionB']));

        tr.append($('<td>')
            .html(question['optionC']));

        tr.append($('<td>')
            .html(question['author']));

        tr.append($('<td>')
            .html(question['occurrences']));

        $('#tbody').append(tr);
    }
}
