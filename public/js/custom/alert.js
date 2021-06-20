$(function() {
    if ($('#status').attr('data-status').length !== 0) {
        alertify.alert('Notification', 'Profile updated successfully.', function() {
            window.location.href = BASE_URI + '/profile/student/';
        });
        // alertify.alert().set('title', 'Notification').set('message', 'Profile updated successfully.').showModal('ajs-custom');
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