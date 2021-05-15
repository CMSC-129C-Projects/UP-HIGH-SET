$(function() {
    $('.toggle-password').click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#pass_log_id");
        input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
    });
    
    $('.cancel').click(function() {
        window.location.href = BASE_URI + '/dashboard';
    });
});