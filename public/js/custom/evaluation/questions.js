function deleteQuestion(questionID) {
    return $.ajax({
        url: BASE_URI + '/questions/delete_question/' + questionID,
        type: 'POST',
        dataType: 'json'
    });
}

function makeRandomId() {
    var text = '';
    var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    for (var i = 0; i < 32; i++) {
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }

    return text;
}

function deleteElement($element) {
    let superParent = $element.parent().parent().parent();

    $(superParent).remove();
}

function add_question(section, questionNumber) {
    let randID = 'new_' + makeRandomId();

    return (
        '<div class="form-group"">' +
            '<input type="hidden" name="question_id_' + randID + '" value="' + randID + '">' +

            '<input type="hidden" name="section_' + randID + '" value="' + section + '"></input>' +

            '<label for="q' + randID + '" style="margin-left: 10%; padding-top:3rem; font-size:3.5vmin; margin-bottom:5vh;"> Question ' + questionNumber + ': </label>' +
            '<div class="row">' +
                '<div class="col-md-11">' +
                    '<input type="text" class="form-control" name="question' + randID + '" id="q' + randID + '" value="">' +
                '</div>' +
                '<div class="col-md-1 text-left">' +
                    '<i class="bi bi-trash text-danger action_delete" id="delete_' + randID + '" style="cursor: pointer; font-size: 4vmin"></i>' +
                '</div>' +
            '</div>' +
        '</div>'
    );
}

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

        if ($('#evalCategories').hasClass('responsive')) {
            $('#evalCategories').removeClass('responsive');
        }

        $('.action-display').text($(this).text());
    });

    $('.question_grp').on('click', ".action_delete", function() {
        const $this = $(this);
        let questionID = $(this).attr('id').split('_')[1];

        if (questionID.includes('new')) {
            alertify.success('Item deleted successfully.');
            deleteElement($this);
        } else {
            alertify.confirm('Delete Question', 'Are you sure you want to delete this question in the database? Note: Changes made to other questions will be removed. Save first before continuing.', function() {
                $.when(deleteQuestion(questionID)).then(function(response) {
                    if (response.message === 'success') {
                        alertify.success('Item deleted in the database successfully.');
                        deleteElement($this);
                    } else {
                        alertify.error('An error has occurred while deleting this question. Please try again.');
                    }
                });
            }, function() {
                    
            }).set('labels', {ok:'<i class="bi bi-check-circle-fill"></i> Confirm', cancel:'<i class="bi bi-x-circle-fill"></i> Cancel'});
        }
    });
    
    
    $('.action-add-question').click(function() {
        let section = $(this).attr('data-section');

        let $newRow = $(add_question(section, getQuestionNumber(section)));

        $('#question_grp_' + section).append($newRow);
    });
});

function getQuestionNumber(section) {
    let count = parseInt($('#counter_' + section).attr('data-count'));
    $('#counter_' + section).attr('data-count', (count+1))
    return count+1;
}