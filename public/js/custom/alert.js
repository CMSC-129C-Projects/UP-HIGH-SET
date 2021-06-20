$(function() {
    if (CURRENT_URI.includes('profile') && $('#status').length != 0 && $('#status').attr('data-status').length !== 0) {
        displayAlertify('/profile/student/', 'Profile updated successfully.');
    }

    if (CURRENT_URI.includes('update/add') && $('#status').length != 0 && $('#status').attr('data-status').length !== 0) {
        if ($('#status').attr('data-status') === 'true') {
            displayAlertify(CURRENT_URI, 'User has been added. Email sent successfully.');
        } else {
            displayAlertify(CURRENT_URI, 'An error has occurred.');
        }
    }

    // var $bgModal = $('#bg-modal');
    // var $modalContent = $('#content-modal');
    // var id = '';
    // var role = '';
    // $(document).on('click', '#deleteStudent, #yesDelete, #dontDelete', function() {
    //     if($(this).attr('id') === 'deleteStudent') {
    //         $bgModal.fadeTo(500,1);
    //         $modalContent.fadeTo(500,1);
    //         id = $(this).attr('data-id');
    //         role = $(this).attr('data-role');
    //     } else if($(this).attr('id') === 'dontDelete') {
    //         $bgModal.fadeOut(500);
    //         $modalContent.fadeOut(500);
    //     } else {
    //         window.location.href = BASE_URI + '/update/delete/' + id + '/' + (role == '2' ? 'student' : 'admin');
    //     }
    // });
});

function displayAlertify(url, message) {
    alertify.alert('Notification', message, function() {
        window.location.href = BASE_URI + url;
    });
}