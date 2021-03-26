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
                element['action'] = '<div><a href="'+ BASE_URI + '/update/edit/student/' + element.id + '"><button class="btn btn-primary">Edit</button></a><button data-id="' + element.id + '" class="btn btn-primary" style="margin-left: 2%;" id="deleteStudent">Delete</button></div>';
            });

            var table = $('#student').DataTable({
                data: response,
                autoWidth: false,
                columns: [
                    {data: 'first_name', width: '20%'},
                    {data: 'last_name', width: '20%'},
                    {data: 'grade_level', width: '20%'},
                    {data: 'student_num', width: '20%'},
                    {data: 'action', width: '20%'}
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
                        element['action'] = '<div"><a href="'+ BASE_URI + '/update/edit/student/' + element.id + '"><button class="btn btn-primary">Edit</button></a><button data-id="' + element.id + '" class="btn btn-primary" style="margin-left: 2%;" id="deleteStudent">Delete</button></div>';
                    });

                    table.clear();
                    table.rows.add(response);
                    table.draw(false);
                }
            )
        )
    });
});