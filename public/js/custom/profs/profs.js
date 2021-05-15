function getProfs(search) {
    if (search === undefined) {
        return $.ajax({
            url: BASE_URI + '/professors/profList/',
            type: 'POST',
            dataType: 'json'
        });
    } else {
        return $.ajax({
            url: BASE_URI + '/professors/profList/' + search,
            type: 'POST',
            dataType: 'json'
        });
    }
}

function appendProfCards(search = undefined) {
    $.when(getProfs(search)).then((reponse) => {
        $('#prof-content').empty();
        reponse.forEach(element => {
            let profDisplay = '<div class="col-md-2"><div class="card bg-dark text-white" style="width: 18rem;"><img class="card-img-top" src="https://cdn1.iconfinder.com/data/icons/UltraBuuf/256/Red_Chin_Iron_Man.png" alt="Prof image cap"><div class="card-body"><h5 class="card-title">' + element.first_name + ' ' + element.last_name + '</h5><p class="card-text">' + element.details + '</p><button class="btn btn-primary redirect" data-id="' + element.id + '">Subjects handled</button></div></div></div>';

            $('#prof-content').append(profDisplay).on('click', '.redirect', function() {
                window.location.href = BASE_URI + '/view_subjects/' + $(this).attr('data-id');
            });
        });
    });
}

function filterProfs(searchItem) {
    if (searchItem.length !== 0) {
        appendProfCards(searchItem);
    } else {
        appendProfCards();
    }
}

$(function() {
    appendProfCards();

    $('input[name="search"]').keyup(function(event) {
        let input = $(this).val();
        if (!(/^[a-zA-Z" "]+$/.test(input)) && event.which != 8) {
            alertify.error('Input should only contain letters in the alphabet.');
            if (!(/^[a-zA-Z" "]+$/.test(input[input.length - 1])))
                input = input.substring(0, input.length - 1);
            $(this).val(input);
        }
        filterProfs(input);
    });
});