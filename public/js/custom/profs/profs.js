$(function() {
    $('.redirect').click(function() {
        window.location.href = BASE_URI + '/view_subjects/' + $(this).attr('data-id');
    });
});