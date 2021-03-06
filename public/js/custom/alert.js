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
        if (CURRENT_URI.includes('add_subject')) {
            displayAlertify('/professors', 'Subject added successfully.');
        } else {
            displayAlertify('/professors', 'Subject updated successfully.');
        }
    }

    if (CURRENT_URI.includes('view_subjects') &&  $('#status').length != 0 && $('#status').attr('data-status').length !== 0) {        
        alertify.alert('Notification', 'No subjects handled by the professor.', function() {
            window.location.href = BASE_URI + '/dashboard';
        });
    }

    if (CURRENT_URI.includes('professors') && $('#status').length != 0 && $('#status').attr('data-status').length !== 0) {
        if (CURRENT_URI === '/professors') {
            alertify.alert('Notification', 'No professors recorded in the database.', function() {
                window.location.href = BASE_URI + '/dashboard';
            });
        } else if (CURRENT_URI.includes('add_professor')) {
            displayAlertify('/professors', 'Professor added successfully.');
        } else {
            displayAlertify('/professors', 'Professor updated successfully.');
        }
    }

    if (CURRENT_URI.includes('send_email') && $('#status').length != 0 && $('#status').attr('data-status').length !== 0) {
        displayAlertify(CURRENT_URI, 'Email sent to all students succesfully.');
    }

    if (CURRENT_URI.includes('evaluation/evaluate') && $('#status').length != 0 && $('#status').attr('data-status').length !== 0) {
        displayAlertify(CURRENT_URI, 'Responses are saved to the database.');
    }

    if (CURRENT_URI.includes('questions') && $('#status').length != 0 && $('#status').attr('data-status').length !== 0) {
        displayAlertify(CURRENT_URI, 'Updated questions are saved to the database.');
    }

    if (CURRENT_URI.includes('update_set_status') && $('#status').length != 0 && $('#status').attr('data-status').length !== 0) {
        displayAlertify(CURRENT_URI, 'Evaluation period is opened.');
    }

    if (CURRENT_URI.includes('update_set_status') && $('#db_content').length != 0 && $('#status').attr('data-dbcontent').length !== 0) {
        alertify.alert('Notification', 'No students are enrolled yet. Please add students before opening the evaluation period.', function() {
            window.location.href = BASE_URI + '/dashboard';
        });
    }

    $('.item-table').on('click', '#deleteStudent', function() {
        let id = $(this).attr('data-id');
        let role = $(this).attr('data-role');
        
        alertify.confirm('Delete User', 'Are you sure you want to delete this student?', function() {
            window.location.href = BASE_URI + '/update/delete/' + id + '/' + (role == '2' ? 'student' : 'admin');
        },
        function() {
            alertify.error('Delete Cancelled.')
        }).set('labels', {ok:'<i class="bi bi-check-circle"></i> Confirm', cancel:'<i class="bi bi-x-circle"></i> Cancel'});
    });
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