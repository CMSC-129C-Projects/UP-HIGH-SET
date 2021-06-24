$(function() {
    $("#datepickerStart, #datepickerEnd").datepicker({
        showAnim: 'show',
        dateFormat: 'yy-mm-dd'
    });
    // $("#datepickerStart").datepicker( "option", "showAnim", "show");
    // $("#datepickerEnd").datepicker( "option", "showAnim", "show");

    $('#startDate').click(function () {
        $("#datepickerStart").datepicker("show");
    });

    $('#endDate').click(function () {
        console.log('here');
        $("#datepickerEnd").datepicker("show");
    });
});