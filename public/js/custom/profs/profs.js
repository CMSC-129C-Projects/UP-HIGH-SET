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

// Background Colors for Name initials
const COLORS = ['red', 'maroon', 'blue', 'skyblue', 'yellow', 'green', 'orange', 'magenta'];

/**
 * Returns a random number between min (inclusive) and max (exclusive)
 */
function getRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min) + min);
}

function appendProfCards(search = undefined) {
    $.when(getProfs(search)).then((response) => {
        // let elements = [];
        $('#prof-content').empty();
        response.forEach((element) => {
            let chosenColor = getRandomNumber(0, COLORS.length);

            let professor = '<div class="card">' +
                                '<div class="dot text-center d-flex align-items-center justify-content-center" style="background-color: ' + COLORS[chosenColor]+ ';">' +
                                '<strong class="initials">' + capitalize(element.first_name[0]) + capitalize(element.last_name[0]) + '</strong>' +
                                '</div>' +
                                '<h1>' + capitalize(element.first_name) + ' ' + capitalize(element.last_name) + '</h1>' +
                                '<p>' + element.details + '</p>' +
                                '<div class="dropdown" style="margin:auto;">' +
                                    '<button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-eye"></i> Action</button>' +
                                    '<div class="dropdown-menu dropdown-menu-center" aria-labelledby="dropdownMenuButton">'+
                                        '<a class="dropdown-item" href="' + BASE_URI + '/view_subjects/' + element.id + '">View Subjects</a>' +
                                        '<hr>' +
                                        '<a class="dropdown-item" href="' + BASE_URI + '/professors/edit_professor/' + element.id + '">Edit Faculty</a>' +
                                        '<hr>' +
                                        '<a class="dropdown-item" href="' + BASE_URI + '/professors/delete_professor/' + element.id + '">Delete Faculty</a>' +
                                    '</div>' +
                                '</div>' +
                            '</div>';

            $('#prof-content').append(professor);
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
