$(function() {
    'use strict';
    var table;

    function getStudents(gradeLevel) {
        return $.ajax({
            url: BASE_URI + '/update/studentList/' + gradeLevel,
            type: 'POST',
            dataType: 'json',
        });
    }

    function setTable(initTable) {
        table = initTable;
    }

    $.when(getStudents('7').then(
        function(response) {
            response.forEach(element => {
                element['action'] = '<div><a href="'+ BASE_URI + '/update/edit/student/' + element.id + '"><button class="btn btn-primary">Edit</button></a><a href="'+ BASE_URI + '/update/delete/' + element.id + '"><button class="btn btn-primary" style="margin-left: 2%;" id="deleteStudent">Delete</button></a></div>';
            });

            var table = $('#student').DataTable({
                data: response,
                columns: [
                    {data: 'first_name'},
                    {data: 'last_name'},
                    {data: 'grade_level'},
                    {data: 'student_num'},
                    {data: 'action'}
                ],
                searching: false,
                ordering: false
            });

            setTable(table);
        },
        function(jqXHR) {
            var response = JSON.parse(jqXHR.responseText);
            alertify.error(response.message);
        }
    ));

    $('#gl').on('change', function() {
        $.when(getStudents($(this).val()).then(
                function(response) {
                    response.forEach(element => {
                        element['action'] = '<div><a href="'+ BASE_URI + '/update/edit/student/' + element.id + '"><button class="btn btn-primary">Edit</button></a><a href="'+ BASE_URI + '/update/delete/' + element.id + '"><button class="btn btn-primary" style="margin-left: 2%;" id="deleteStudent">Delete</button></a></div>';
                    });

                    table.clear();
                    table.rows.add(response);
                    table.draw(false);
                }
            )
        )
    });
});