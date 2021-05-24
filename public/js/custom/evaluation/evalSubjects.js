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
            let subject = '<div class="card">' +
                                '<img src="' + BASE_URI + '/public/images/EvaluationCover.jpg" class="img-fluid" alt="">' + 
                                '<h1>' + element.name + '</h1>' +
                                '<p>' + element.first_name + ' ' + element.last_name + '</p>' +
                                '<p>Status: ' + element.status + '</p>' +
                                '<button class="redirect" data-id="' + element.eval_sheet_id + '" style="margin:auto;">Evaluate</button>' +
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