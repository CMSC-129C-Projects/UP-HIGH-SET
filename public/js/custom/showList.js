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

    function getAdmins() {
        return $.ajax({
            url: BASE_URI + '/update/adminList/',
            type: 'POST',
            dataType: 'json'
        });
    }

    function getClerks() {
        return $.ajax({
            url: BASE_URI + '/update/clerkList/',
            type: 'POST',
            dataType: 'json'
        });
    }

    function setTable(initTable) {
        table = initTable;
    }

    $.when(getStudents('7').then(
        function(response) {
            response.forEach(element => {
                element['action'] = '<div><a href="'+ BASE_URI + '/update/edit/student/' + element.id + '"><button class="button" style="width: 6rem; border-radius: 0px; margin-bottom:0px;">Edit</button></a><button data-id="' + element.id + '" data-role="' + element.role + '" class="button" style=" width:6rem; border-radius: 0px; margin-bottom:0px;" id="deleteStudent">Delete</button></div>';
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
            // var response = JSON.parse(jqXHR.responseText);
            console.log(jqXHR.responseText);
            // alertify.error(jqXHR.responseText);
        }
    ));

    $('#gl').on('change', function() {
        $.when(getStudents($(this).val()).then(
                function(response) {
                    response.forEach(element => {
                        element['action'] = '<div"><a href="'+ BASE_URI + '/update/edit/student/' + element.id + '"><button class="button" style="width:6rem; border-radius:0px; margin-bottom:0px;">Edit</button></a><button data-id="' + element.id + '" data-role="' + element.role + '" class="button" style="width:6rem;  border-radius:0px; margin-bottom:0.8px;" id="deleteStudent">Delete</button></div>';
                    });

                    table.clear();
                    table.rows.add(response);
                    table.draw(false);
                }
            )
        )
    });

    if (CURRENT_URI.includes('update/admin')) {
        $.when(getAdmins().then(
            function(response) {
                response.forEach(element => {
                    element['action'] = '<div"><a href="'+ BASE_URI + '/update/edit/admin/' + element.id + '"><button class="button" style="width:6rem; border-radius:0px; margin-bottom:0px;">Edit</button></a><button data-id="' + element.id + '" data-role="' + element.role + '" class="button" style="width:6rem;  border-radius:0px; margin-bottom:0.8%;" id="deleteStudent">Delete</button></div>';
                });
                
                $('#admin').DataTable({
                    data: response,
                    autoWidth: false,
                    columns: [
                        {data: 'first_name', width: '20%'},
                        {data: 'last_name', width: '20%'},
                        {data: 'contact_num', width: '20%'},
                        {data: 'email', width: '20%'},
                        {data: 'action', width: '20%'}
                    ],
                    searching: false,
                    ordering: false
                });
            }
        ));
    }


    if (CURRENT_URI.includes('update/clerk')) {
        $.when(getClerks().then(
            function(response) {
                response.forEach(element => {
                    element['action'] = '<div"><a href="'+ BASE_URI + '/update/edit/clerk/' + element.id + '"><button class="button" style="width:6rem; border-radius:0px; margin-bottom:0px;">Edit</button></a><button data-id="' + element.id + '" data-role="' + element.role + '" class="button" style="width:6rem;  border-radius:0px; margin-bottom:0.8%;" id="deleteStudent">Delete</button></div>';
                });
                
                $('#admin').DataTable({
                    data: response,
                    autoWidth: false,
                    columns: [
                        {data: 'first_name', width: '20%'},
                        {data: 'last_name', width: '20%'},
                        {data: 'contact_num', width: '20%'},
                        {data: 'email', width: '20%'},
                        {data: 'action', width: '20%'}
                    ],
                    searching: false,
                    ordering: false
                });
            }
        ));
    }
});