function animateProgressBars(studElement, studLeft, studRight, subElement, subLeft, subRight, faculElement, faculLeft, faculRight) {
    var supportedFlag = $.keyframe.isSupported();

    $.keyframe.define([{
        name: 'loading-studentl',
        '0%': {'transform': 'rotate(0deg)'},
        '100%': {'transform': 'rotate(' + studLeft + 'deg)'}
    }, {
        name: 'loading-studentr',
        '0%': {'transform': 'rotate(0deg)'},
        '100%': {'transform': 'rotate(' + studRight + 'deg)'}
    }, {
        name: 'loading-subjectl',
        '0%': {'transform': 'rotate(0deg)'},
        '100%': {'transform': 'rotate(' + subLeft + 'deg)'}
    }, {
        name: 'loading-subjectr',
        '0%': {'transform': 'rotate(0deg)'},
        '100%': {'transform': 'rotate(' + subRight + 'deg)'}
    }, {
        name: 'loading-faculL',
        '0%': {'transform': 'rotate(0deg)'},
        '100%': {'transform': 'rotate(' + faculLeft + 'deg)'}
    }, {
        name: 'loading-faculR',
        '0%': {'transform': 'rotate(0deg)'},
        '100%': {'transform': 'rotate(' + faculRight + 'deg)'}
    }]);

    $('.progress .progress-right .' + studElement).playKeyframe({
        name: 'loading-studentr',
        duration: '1.8s',
        timingFunction: 'linear',
        fillMode: 'forwards'
    });

    $('.progress .progress-left .' + studElement).playKeyframe({
        name: 'loading-studentl',
        duration: '1.5s',
        timingFunction: 'linear',
        delay: '1.8s',
    });

    $('.progress .progress-right .' + subElement).playKeyframe({
        name: 'loading-subjectr',
        duration: '1.8s',
        timingFunction: 'linear',
        fillMode: 'forwards'
    });

    $('.progress .progress-left .' + subElement).playKeyframe({
        name: 'loading-subjectl',
        duration: '1.5s',
        timingFunction: 'linear',
        delay: '1.8s',
    });

    $('.progress .progress-right .' + faculElement).playKeyframe({
        name: 'loading-faculR',
        duration: '1.8s',
        timingFunction: 'linear',
        fillMode: 'forwards'
    });

    $('.progress .progress-left .' + faculElement).playKeyframe({
        name: 'loading-faculL',
        duration: '1.5s',
        timingFunction: 'linear',
        delay: '1.8s',
    });
}

function getRate(overallRate) {
    if (overallRate <= 1.49)
        return 'E';
    if (overallRate <= 2.490)
        return 'VG';
    if (overallRate <= 3.49)
        return 'G';
    if (overallRate <= 4.499)
        return 'F';

    return 'P';
}

function computeProgress(stat) {
    let degree = Math.round(360 * (stat/100));
    let left, right;

    if (degree > 180) {
        left = degree - 180;
        right = 180;
    } else {
        left = 0;
        right = degree;
    }

    return [left, right];
}

function interpret() {
    let td = $('td[class^="interpretation_"]');

    Object.values(td).forEach((element, index) => {
        if (index < td.length) {
            let id = $(element).attr('class').split('_')[1];

            let value = parseFloat($('td[class="rating_' + id + '"]').text());
            $(element).text(getRate(value.toFixed(2)));
        }
    });
}

$(function() {
    let studentStat = parseFloat($('#studentstat').attr('data-studentstat'));
    let subjectStat = parseFloat($('#subjectstat').attr('data-subjectstat'));
    let faculStat = parseFloat($('#faculstat').attr('data-faculstat'));

    let studfinalstats = computeProgress(studentStat);
    let subfinalstats = computeProgress(subjectStat);
    let faculfinalstats = computeProgress(faculStat);
    animateProgressBars('student-progress', studfinalstats[0], studfinalstats[1], 'subject-progress', subfinalstats[0], subfinalstats[1], 'faculty-progress', faculfinalstats[0], faculfinalstats[1]);

    interpret();

    let notif = $('#notif').attr('data-notif');

    console.log(notif);
    if (notif.length !== 0) {
        if (notif.includes('transcend')) {
            alertify.alert('Notification', 'Transcend students successful.', function() {
                window.location.href = BASE_URI + '/dashboard';
            });
        } else if (notif.includes('archive')) {
            alertify.alert('Notification', 'Archive successful.', function() {
                window.location.href = BASE_URI + '/dashboard';
            });
        }
    }
});