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
    $.when(getProfs(search)).then((response) => {
        // let elements = [];
        $('#prof-content').empty();
        response.forEach((element) => {
            let professor = '<div class="card">' +
                                '<img src="' + BASE_URI + '/public/images/avatars/rasta.png" alt="">' + 
                                '<h1>' + element.first_name + ' ' + element.last_name + '</h1>' +
                                '<p>' + element.details + '</p>' +
                                '<button class="redirect" data-id="' + element.id + '" style="margin:auto;">View Subjects</button>' +
                            '</div>';

            $('#prof-content').append(professor).on('click', '.redirect', function() {
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
    $('.start-search').click(function() {
        const $searchContent = $('input[name="search"]');
        let input = $searchContent.val();
        if (!(/^[a-zA-Z" "]+$/.test(input))) {
            alertify.error('Input should only contain letters or space');
        } else {
            filterProfs(input);
        }
    });

    $('.display-all').click(function() {
        filterProfs('');
    });
});