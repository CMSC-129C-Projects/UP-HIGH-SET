$(function() {
    $('.redirect').click(function() {
        window.location.href = BASE_URI + '/subjects/' + $(this).attr('data-id');
    });
});