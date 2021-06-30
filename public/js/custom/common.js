$(window).on('load', function(){
	// Animate loader off screen
	$(".bg-loader").fadeOut("slow");
});

function capitalize(str) {
    if (str.length == 0) {
        return false
    } else if (str.length > 1) {
        return str[0].toUpperCase() + str.substring(1);
    } else {
        return str.toUpperCase();
    }
}

function updateVerification(value) {
    return $.ajax({
        url: BASE_URI + '/update/update_2fverification/' + value,
        type: 'POST',
        dataType: 'json'
    });
}

function getTime() {
    return $.ajax({
        url: BASE_URI + '/monitoring/check_time/',
        type: 'POST',
        dataType: 'json'
    });
}

function runTimeChecker() {
    $.when(getTime()).then(function(response) {
        if (!response.is_close && response.almost_close) {
            setInterval(function() {
                console.log('here');
                $.when(getTime()).then(function(response) {
                    if (response.is_close) {
                        window.location.href = BASE_URI + '/dashboard/logout';
                    }
                });
            }, 300000);
        }
    });
}

let header = document.getElementById("header");
let footer = document.getElementById("footer");

new ResizeSensor(main, function() {
    let sidebarHeight = document.documentElement.clientHeight
    $('#sidebar').css("height", (document.body.scrollHeight - header.clientHeight - footer.clientHeight) + 'px');
});

$(function () {
    runTimeChecker();

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    $('input[name="allow_verification"]').change(function() {
        let value = $(this).prop('checked');
        $.when(updateVerification(value)).then(function(response) {
            if (response.message === 'success') {
                let message = 'Two-step verification has been turned ' + (value === true ? 'on' : 'off') + ' successfully.'
                
                alertify.alert('Notification', message);
            } else {
                alertify.alert('Notification', 'An error has occurred. Please try again.');
            }

            $('.bi-x-circle').remove();
            $('.alertify .btn-primary').prepend('<i class="bi bi-x-circle"></i>');
        });
    });


    $('.button-sub').click(function(){
        let id = $('select[name="subjects"]').val();

        window.location.href = BASE_URI + '/reports/report_per_subject/' + id;
    });

    $('.button-prof').click(function() {
        let id = $('select[name="professors"]').val();

        window.location.href = BASE_URI + '/reports/report_per_faculty/' + id;
    });
});