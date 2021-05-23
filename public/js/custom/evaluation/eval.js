$(function() {
    $('.evalbtn').click(function() {
        let evalbtns = $('.evalbtn');

        for(let i=0; i<evalbtns.length; i++) {
            if ($(evalbtns[i]).hasClass('active')) {
                $(evalbtns[i]).removeClass('active');
            }
        }
        $(this).addClass('active');

        // htmlResize();
        // setTimeout(htmlResize, 1000);
    });
});