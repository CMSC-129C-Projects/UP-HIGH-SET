$(function() {
    $("#datepickerStart, #datepickerEnd").datepicker({
        showAnim: 'show',
        dateFormat: 'yy-mm-dd'
    });

    $('#startDate').click(function () {
        $("#datepickerStart").datepicker("show");
    });

    $('#endDate').click(function () {
        console.log('here');
        $("#datepickerEnd").datepicker("show");
    });

    $('#drpdwn1').change(function() {
        $('#drpdwn2').empty();
        $('#drpdwn2').append(getOptions($(this).val()));
    });
});


function getOptions(type) {
    let deflt = '<option value="1" selected>1</option>' + '<option value="2">2</option>';
    if (type === 'grading') {
        deflt += '<option value="3" selected>3</option>' + '<option value="4">4</option>';
    }
    return deflt;
}