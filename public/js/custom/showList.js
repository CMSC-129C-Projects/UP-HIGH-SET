$(function() {
    'use strict';

    function getStudents() {
        return $.ajax({
            url: BASE_URI + 'update/studentList',
            type: 'POST',
            dataType: 'json',
        });
    }

    $.when(getStudents()).then(
        function(response) {
            $('#student').DataTable({
                data: response,
                columns: [
                    {data: 'first_name'},
                    {data: 'last_name'},
                    {data: 'grade_level'},
                    {data: 'student_num'}
                ]
            });
        },
        function(jqXHR) {
            var response = JSON.parse(jqXHR.responseText);
            alertify.error(response.message);
        }
    )
});