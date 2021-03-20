var data = [
    {
        'id': 3,
        'name': "Crispaul John Rubi",
        'grade-level': "Grade 12",
        'semester': "AY 2020-2021",
        'action': '<div><a href="https://google.com/id" target="_blank"><button class="btn btn-primary">Edit</button></a><button class="btn btn-primary">Delete</button></div>'
    },
    {
        'id': 4,
        'name': "Lianne Simone Rosales",
        'grade-level': "Grade 11",
        'semester': "AY 2020-2021",
        'action': '<div><a href="https://google.com/id" target="_blank"><button class="btn btn-primary">Edit</button></a><button class="btn btn-primary">Delete</button></div>'
    }
]

$(function() {
    data[0].action = data[0].action.replace('id',data[0].id);
    data[1].action = data[1].action.replace('id',data[1].id);
    $('#student').DataTable({
        data: data,
        columns: [
            {data: 'name'},
            {data: 'grade-level'},
            {data: 'semester'},
            {data: 'action'},
        ]
    });
});