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

    $('.category').click(function() {
        let evalbtns = $('.category');

        for(let i=0; i<evalbtns.length; i++) {
            if ($(evalbtns[i]).hasClass('activeCategory')) {
                $(evalbtns[i]).removeClass('activeCategory');
            }
        }
        $(this).addClass('activeCategory');

        let tabs = $('.tab-pane');

        for(let i=0; i<tabs.length; i++) {
            if ($(tabs[i]).hasClass('active')) {
                $(tabs[i]).removeClass('active');
            }
            if ($(tabs[i]).hasClass('show')) {
                $(tabs[i]).removeClass('show');
            }
        }
        let target = $(this).attr('data-target');
        $('#' + target).addClass('show');
        $('#' + target).addClass('active');
    });

    setCurrentProgress();

    $('input[name^="choices_"], textarea[name^="answer_"').change(function() {
        let $savestatus = $('.savestatus');
        if ($savestatus.hasClass('d-none')) {
            $savestatus.removeClass('d-none');
        }

        updateReview($(this));
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

function updateReview($this) {
    let name = $this.attr('name');
    if (name.includes('answer')) {
        let textarea = $('textarea[name="review_' + name + '"]');
        textarea.text($this.val());
    } else if (name.includes('choices')) {
        let radios = $('input[name="review_' + name + '"]');
        for(let i=0; i<radios.length; i++) {
            if ($(radios[i]).val() === $this.val()) {
                $(radios[i]).prop('checked', true);
                $('input[name="review_final_' + name + '"]').val($(radios[i]).val());
            } else {
                $(radios[i]).prop('checked', false);
            }
        }
    }
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