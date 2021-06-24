function animateProgressBars(studElement, studLeft, studRight, subElement, subLeft, subRight) {
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
}

$(function() {
    let studentStat = parseFloat($('#studentstat').attr('data-studentstat'));
    let subjectStat = parseFloat($('#subjectstat').attr('data-subjectstat'));

    let studfinalstats = computeProgress(studentStat);
    let subfinalstats = computeProgress(subjectStat);
    animateProgressBars('student-progress', studfinalstats[0], studfinalstats[1], 'subject-progress', subfinalstats[0], subfinalstats[1]);
});

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