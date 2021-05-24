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

function rowCreator(elementsList) {
    let profDisplay = '<div class="row" style="margin-top: 5vh;" >';
    elementsList.forEach(element => {
        profDisplay += element;
    });
    profDisplay += '</div>';
    return profDisplay;
}

function appendProfCards(search = undefined) {
    $.when(getProfs(search)).then((response) => {
        let elements = [];
        $('#prof-content').empty();
        response.forEach((element, index) => {
            let professor =     '<div class="col-md-4 d-flex justify-content-center">' +
                                    '<div class="card">' +
                                        '<img src="' + BASE_URI + '/public/images/avatars/rasta.png" alt="">' + 
                                        '<h1>' + element.first_name + ' ' + element.last_name + '</h1>' +
                                        '<p>' + element.details + '</p>' +
                                        '<button class="redirect" data-id="' + element.id + '" style="margin:auto;">View Subjects</button>' +
                                    '</div>' +
                                '</div>';
            if (index == 0 || index%3 !== 0) {
                elements.push(professor);
            } else {
                let elementToAppend = rowCreator(elements);
                $('#prof-content').append(elementToAppend).on('click', '.redirect', function() {
                    window.location.href = BASE_URI + '/view_subjects/' + $(this).attr('data-id');
                });
                elements = [];
                elements.push(professor);
            }
            if (index === response.length-1) {
                if (elements.length === 1) {
                    elements[0] = elements[0].replace('col-md-4', 'col-md-12');
                } else if (elements.length === 2) {
                    elements[0] = elements[0].replace('col-md-4', 'col-md-6');
                    elements[1] = elements[1].replace('col-md-4', 'col-md-6');
                }
                let elementToAppend = rowCreator(elements);
                $('#prof-content').append(elementToAppend).on('click', '.redirect', function() {
                    window.location.href = BASE_URI + '/view_subjects/' + $(this).attr('data-id');
                });
            }
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