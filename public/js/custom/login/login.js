$(function() {
    if ($('#eval_status').length === 0) {
        let timer = setInterval(function() {
            let time = $('.time').text();
    
            const times = time.split(':');
    
            let hours = parseInt(times[0]);
            let minutes = parseInt(times[1]);
            let seconds = parseInt(times[2]);
    
            if (seconds == 0) {
                if (minutes == 0) {
                    if (hours !== 0) {
                        hours -= 1;
    
                        minutes = 59;
                        seconds = 59;
                    } else {
                        clearInterval(timer);
                    }
                } else {
                    minutes -= 1;
                    seconds = 59;
                }
            } else {
                seconds -= 1;
            }
    
            seconds = (seconds < 10) ? ('0' + seconds.toString()) : seconds.toString();
            minutes = (minutes < 10) ? ('0' + minutes.toString()) : minutes.toString();
            hours = (hours < 10) ? ('0' + hours.toString()) : hours.toString();
    
            const newTime = hours + ':' + minutes + ':' + seconds;
    
            $('.time').text(newTime);
        }, 1000);
    }
});