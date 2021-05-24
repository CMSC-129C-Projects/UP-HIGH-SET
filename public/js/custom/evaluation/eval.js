$(function() {
    $('.evalbtn').click(function() {
        let evalbtns = $('.evalbtn');

        for(let i=0; i<evalbtns.length; i++) {
            if ($(evalbtns[i]).hasClass('active')) {
                $(evalbtns[i]).removeClass('active');
            }
        }
        $(this).addClass('active');
    });

    setCurrentProgress();

    $('input[name^="choices_"], textarea[name^="answer_"').change(function() {
        let $savestatus = $('.savestatus');
        if ($savestatus.hasClass('d-none')) {
            $savestatus.removeClass('d-none');
        }

        setCurrentProgress();
    });
});

function setCurrentProgress() {
    let $totalChoices = $('input[name^="choices_"]');
    let totalQuestions = $totalChoices.length/5 + $('textarea[name^="answer_"]').length;
    let answeredQuestions = getAnsweredQuestions();

    let progress = (answeredQuestions/totalQuestions)*100;
    
    $('.progress-bar').css('width', (progress.toFixed(0)) + '%');
    $('.progress-bar').text((progress.toFixed(0)) + '%');
}

function getAnsweredQuestions() {
    let alreadyAnswered = 0;
    let questionIDs = $('input[name^="question_id_"]');
    for(let i=0; i<questionIDs.length; i++) {
        if (i < 36 && $('input[name^="choices_' + $(questionIDs[i]).val() + '"]:checked').val() !== undefined) {
            alreadyAnswered++;
        } else if (i >= 36 && $('textarea[name="answer_' + $(questionIDs[i]).val() + '"]').val().length !== 0) {
            alreadyAnswered++;
        }
    }
    return alreadyAnswered;
}