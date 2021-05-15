function getProfs() {
    return $.ajax({
        url: BASE_URI + '/professors/profList/',
        type: 'POST',
        dataType: 'json'
    });
}

function filterProfs(searchItem) {
    $('.prof-content').empty();
}

$(function() {
    $('.redirect').click(function() {
        window.location.href = BASE_URI + '/view_subjects/' + $(this).attr('data-id');
    });

    $.when(getProfs()).then((reponse) => {
        reponse.forEach(element => {
            let profDisplay = '<div class="col-md-2"><div class="card bg-dark text-white" style="width: 18rem;"><img class="card-img-top" src="https://cdn1.iconfinder.com/data/icons/UltraBuuf/256/Red_Chin_Iron_Man.png" alt="Prof image cap"><div class="card-body"><h5 class="card-title">' + element.first_name + ' ' + element.last_name + '</h5><p class="card-text">' + element.details + '</p><button class="btn btn-primary redirect" data-id="' + element.id + '">Subjects handled</button></div></div></div>';

            $('#prof-content').append(profDisplay);
        });
    });
});