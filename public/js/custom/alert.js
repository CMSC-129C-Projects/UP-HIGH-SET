$(function() {
    var $bgModal = $('#bg-modal');
    var $modalContent = $('#content-modal');
    $(document).on('click', '#deleteStudent, #yesDelete, #dontDelete', function() {
        if($(this).attr('id') === 'deleteStudent') {
            $bgModal.fadeTo(500,1);
            $modalContent.fadeTo(500,1);
        } else if($(this).attr('id') === 'dontDelete') {
            $bgModal.fadeOut(500);
            $modalContent.fadeOut(500);
        } else {
            window.location.href = BASE_URI + '/update/delete/' + $('#deleteStudent').attr('data-id');
        }
    });
});