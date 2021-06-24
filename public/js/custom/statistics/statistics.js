function animateProgressBars() {
    var supportedFlag = $.keyframe.isSupported();

    let degree = 20;
    let full = 180;
    $.keyframe.define([{
        name: 'loading-l',
        '0%': {'transform': 'rotate(0deg)'},
        '100%': {'transform': 'rotate(' + degree + 'deg)'}
    }]);

    $.keyframe.define([{
        name: 'loading-r',
        '0%': {'transform': 'rotate(0deg)'},
        '100%': {'transform': 'rotate(' + full + 'deg)'}
    }]);

    $('.progress .progress-right .progress-bar').playKeyframe({
        name: 'loading-r',
        duration: '1.8s',
        timingFunction: 'linear',
        fillMode: 'forwards'
    });

    $('.progress.maroon .progress-left .progress-bar').playKeyframe({
        name: 'loading-l',
        duration: '1.5s',
        timingFunction: 'linear',
        delay: '1.8s',
    });
}

$(function() {
    // Computations
});