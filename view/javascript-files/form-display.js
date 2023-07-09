function displayAddQuestionForm(multipleChoiceQuestion) {
    // Prikazuje formu za stvaranje novog pitanja
    // Parametar multipleChoiceQuestion predstavlja radi li se o pitanju s ponuđenim odgovorima ili ne

    let form;
    if ($('#add-question-form').length === 0) { // Na stranici se još ne nalazi nijedna forma
        form = $('<form>') // Stvori formu
            .attr({
                'id': 'add-question-form',
                'action': 'index.php?subdir=admin-section&rt=questions/processQuestionAdding',
                'method': 'post'
            });
    } else { // Dohvati posojeću formu i isprazni njen sadržaj
        form = $('#add-question-form').html('');
    }
    
    let categorySelect = $('<select>')
        .attr({
            'name': 'category',
            'id': 'category-select'
        });

    categorySelect.append(
        $('<option selected="selected" disabled="disabled">Please select...</option>'),
        $('<option value="art">Art</option>'),
        $('<option value="entertainment">Entertainment</option>'),
        $('<option value="geography">Geography</option>'),
        $('<option value="history">History</option>'),
        $('<option value="science">Science</option>'),
        $('<option value="sports">Sports</option>')
    )

    let dl = $('<dl>').append(
        $('<dt><label for="category-select">Category</label></dt>'),
        $('<dd>').append(categorySelect),
        $('<dt><label for="question-input">Question</label></dt>'),
        $('<dd><textarea name="question" id="question-input" rows="5", cols="30"></textarea></dd>'),
        $('<dt><label for="answer-input">Answer</label></dt>'),
        $('<dd><input type="text" name="answer" id="answer-input"></dd>')
    )

    if (multipleChoiceQuestion) {
        dl.append(
            $('<dt><label for="wrong-answer-1-input">Wrong answer #1</label></dt>'),
            $('<dd><input type="text" name="wrong-answer-1" id="wrong-answer-1-input"></dd>'),
            $('<dt><label for="wrong-answer-2-input">Wrong answer #2</label></dt>'),
            $('<dd><input type="text" name="wrong-answer-2" id="wrong-answer-2-input"></dd>'),
            $('<dt><label for="wrong-answer-3-input">Wrong answer #3</label></dt>'),
            $('<dd><input type="text" name="wrong-answer-3" id="wrong-answer-3-input"></dd>'),
        )
    }

    let lastDt = $('<dt id="form-last-row">');
    lastDt.append($('<input type="reset" value="Reset" style="margin-right: 2px;">'));
    lastDt.append($('<input type="submit" value="Add question" style="margin-left: 2px;">'));
    dl.append(lastDt);

    form.append(dl);
    $('#form-div').append(form);
}
