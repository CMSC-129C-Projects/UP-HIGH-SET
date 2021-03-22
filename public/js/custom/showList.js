$(function() {
    'use strict';

    function getStudents() {
        return $.ajax({
            url: BASE_URI + '/update/studentList',
            type: 'POST',
            dataType: 'json',
        });
    }

    $.when(getStudents()).then(
        function(response) {
            response.forEach(element => {
                element['action'] = '<div><a href="'+ BASE_URI + '/update/edit/student/' + element.id + '"><button class="btn btn-primary">Edit</button></a><a href="'+ BASE_URI + '/update/delete/' + element.id + '"><button class="btn btn-primary" style="margin-left: 2%;" id="deleteStudent">Delete</button></a></div>';
            });

            $('#student').DataTable({
                data: response,
                columns: [
                    {data: 'first_name'},
                    {data: 'last_name'},
                    {data: 'grade_level'},
                    {data: 'student_num'},
                    {data: 'action'}
                ]
            });
        },
        function(jqXHR) {
            var response = JSON.parse(jqXHR.responseText);
            alertify.error(response.message);
        }
    )
});