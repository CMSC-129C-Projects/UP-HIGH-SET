$(function() {
    if (CURRENT_URI.includes('profile') && $('#status').length != 0 && $('#status').attr('data-status').length !== 0) {
        if (CURRENT_URI.includes('student'))
            displayAlertify('/profile/student/', 'Profile updated successfully.');
        else
            displayAlertify('/profile/admin/', 'Profile updated successfully.');
    }

    if (CURRENT_URI.includes('update/add') && $('#status').length != 0 && $('#status').attr('data-status').length !== 0) {
        displayAlertify(CURRENT_URI, 'User has been added. Email sent successfully.');
    }

    if (CURRENT_URI.includes('subjects') && $('#status').length != 0 && $('#status').attr('data-status').length !== 0) {
        displayAlertify('/professors', 'Subject added successfully.');
    }

    if (CURRENT_URI.includes('send_email') && $('#status').length != 0 && $('#status').attr('data-status').length !== 0) {
        displayAlertify(CURRENT_URI, 'Email content updated succesfully.');
    }

    if (CURRENT_URI.includes('evaluation/evaluate') && $('#status').length != 0 && $('#status').attr('data-status').length !== 0) {
        displayAlertify(CURRENT_URI, 'Responses are saved to the database.');
    }

    if (CURRENT_URI.includes('questions') && $('#status').length != 0 && $('#status').attr('data-status').length !== 0) {
        displayAlertify(CURRENT_URI, 'Updated questions are saved to the database.');
    }

    $('.item-table').on('click', '#deleteStudent', function() {
        alertify.confirm('Delete User', 'Are you sure you want to delete this student?', function() {
            window.location.href = BASE_URI + '/update/delete/' + id + '/' + (role == '2' ? 'student' : 'admin');
        },
        function() {
            alertify.error('Delete Cancelled.')
        });

        $('.alertify .btn-primary').prepend('<i class="bi bi-check-circle"></i>');
        $('.alertify .btn-danger').prepend('<i class="bi bi-x-circle"></i>');
        // if($(this).attr('id') === 'deleteStudent') {
        //     $bgModal.fadeTo(500,1);
        //     $modalContent.fadeTo(500,1);
        //     id = $(this).attr('data-id');
        //     role = $(this).attr('data-role');
        // } else if($(this).attr('id') === 'dontDelete') {
        //     $bgModal.fadeOut(500);
        //     $modalContent.fadeOut(500);
        // } else {
            
        // }
    });



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

function displayAlertify(url, successMessage) {
    if ($('#status').attr('data-status') === 'true') {
        alertify.alert('Notification', successMessage, function() {
            window.location.href = BASE_URI + url;
        });
    } else {
        alertify.alert('Notification', 'An error has occurred. Please try again.', function() {
            window.location.href = BASE_URI + url;
        });
    }
    $('.alertify .btn-primary').prepend('<i class="bi bi-x-circle"></i>');
}