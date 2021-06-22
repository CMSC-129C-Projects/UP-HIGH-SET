$(function() {
    let avatar_url = $('input[name="avatar"]').val();
    $("#selected_avatar").attr('src', BASE_URI + avatar_url);

    $('#avatars').imagepicker();

    $('#avatars').change(function() {
        let selectedAvatar =  $('#avatars :selected').attr('data-img-src');
        $('#selected_avatar').attr('src', selectedAvatar);
        $('input[name=avatar]').attr('value', selectedAvatar.replace(BASE_URI, ''));
    });

    $('#changePass').click(function() {
        // Redirect to Patrick's change password page
        window.location.href = BASE_URI + '/change_password';
    });
});

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}