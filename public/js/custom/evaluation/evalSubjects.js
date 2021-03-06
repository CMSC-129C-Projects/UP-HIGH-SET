function getSubjects() {
    return $.ajax({
        url: BASE_URI + '/subjects/get_subjects_taken/',
        type: 'POST',
        dataType: 'json'
    });
}

function appendSubjectCards() {
    $.when(getSubjects()).then((response) => {
        $('#subjects').empty();
        response.forEach((element) => {
            
            const disableEvaluate = (element.status === 'Completed') ? 'disabled' : '';
            const text = (element.status === 'Completed') ? 'Evaluated' : 'Evaluate';

            console.log(element);

            let subject = '<div class="card">' +
                                '<img src="' + BASE_URI + '/public/images/EvaluationCover.jpg" class="img-fluid" alt="">' + 
                                '<h1>' + capitalize(element.name) + '</h1>' +
                                '<p>' + capitalize(element.first_name) + ' ' + capitalize(element.last_name) + '</p>' +
                                '<p>Status: ' + capitalize(element.status) + '</p>' +
                                '<button type="button" class="redirect" ' + disableEvaluate + ' data-id="' + element.eval_sheet_id + '" style="margin:auto;"><i class="bi bi-pencil-square"></i> ' + text + '</button>' +
                            '</div>';

            $('#subjects').append(subject).on('click', '.redirect', function() {
                window.location.href = BASE_URI + '/evaluation/evaluate/' + $(this).attr('data-id');
            });
        });
    });
}

$(function() {
    appendSubjectCards();
});