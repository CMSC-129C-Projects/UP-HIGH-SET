function getSubjectsByFaculty(facultyID) {
    return $.ajax({
        url: BASE_URI + '/monitoring/get_subjects/' + facultyID,
        type: 'GET',
        dataType: 'json',
    });
}

function createAccordion(subject) {
    let accordion = '<button class="accordion">Student Not Finished Evaluating</button>' +
                    '<div class="panel">';
    subject.studentsNotDone.forEach(studentDetail => {
        accordion += '<div>'
                        '<p>' + studentDetail.student_name + '</p>' +
                        '<div class="progress">' +
                            '<div class="progress-bar bg-danger" style="width:' + studentDetail.progress + '%">' + studentDetail.progress + '%</div>' +
                        '</div>' +
                    '</div>';
    });
    accordion += '</div>';
    return accordion;
}

function displaySubjects(facultyID) {
    $.when(getSubjectsByFaculty(facultyID)).then(function(response) {
        if (response.is_available) {
            $('#subjects').empty();
            let parent = $('#subjects').parent();
            $(parent).removeClass('d-none');
            $('#piechart').addClass('d-none')

            response.subjects.forEach(subject => {
                let progress = subject.progress;
                let element;
                let accordion;
                let pBar = '<div class="progress">' +
                                '<div class="progress-bar bg-danger" style="width:percentage">percentage</div>' +
                            '</div>';
                if (progress !== 'No students') {
                    progress = progress + '%';
                    pBar = pBar.replaceAll('percentage', progress);
                    element = '<strong>' + subject.name + '</strong>' + pBar;
                } else {
                    element = '<strong>' + subject.name + '</strong><p style="color: #7b1113;">' + progress + '</p>';
                }
                let $div;
                if (subject.studentsNotDone)
                    $div = $('<div style="margin: 2% 0;">' + element + subject.studentsNotDone + '</div>');
                else
                    $div = $('<div style="margin: 2% 0;">' + element + '</div>');
                $div.on('click', '.accordion', function (){
                    if ($(this).hasClass('active')) {
                        $(this).removeClass("active");    
                    } else {
                        $(this).addClass("active");
                    }
                    var panel = $(this).next();
                    if ($(panel).height() != 0) {
                        $(panel).css('max-height', '0px');
                    } else {
                        $(panel).css('max-height', $(panel).prop('scrollHeight') + "px");
                    }
                });
                $('#subjects').append($div);
            });
        } else {
            alertify.error(response.message);
        }
    });
}

function accord() {
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
}

$(function() {
    $('.prof-names').click(function() {
        let profnames = $('.prof-names');
        for(let i=0; i<profnames.length; i++) {
            if ($(profnames[i]).hasClass('chosen')) {
                $(profnames[i]).removeClass('chosen');
                $(profnames[i]).css('transform', '');
            }
        }

        $(this).css('transform', 'scale(1.05)');
        $(this).addClass('chosen');
        displaySubjects($(this).attr('data-id'));
    });
});