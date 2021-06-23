// let windowSize;
// let header = document.getElementById("header");
// let footer = document.getElementById("footer");

// $(window).resize(function() {
//     windowSize = getSize();
//     headerHeight = header.clientHeight;
//     footerHeight = footer.clientHeight;
//     $('#sidebar').css("height", (windowSize - headerHeight - footerHeight) + "px");
//     $('#main').css("height", (windowSize - headerHeight - footerHeight) + "px");
// });

// function resize() {
//     // windowSize = getSize();
//     headerHeight = header.clientHeight;
//     // footerHeight = footer.clientHeight;
//     if (main.clientHeight < defaultHeight) {
//         $('#sidebar').css("height", (defaultHeight) + "px");    
//         $('#main').css("height", (defaultHeight) + "px");
//     } else {
//         $('#sidebar').css("height", (main.clientHeight) + "px");
//     }    
//     // $('#main').css("height", (windowSize - headerHeight) + "px");
// }

// $(function() {
//     $('#sidebarCollapse').on('click', function () {
//         $('#sidebar').toggleClass('active');
//     });
//     // resize();
// });
//paste this code under the head tag or in a separate js file.
// Wait for window load
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

let header = document.getElementById("header");
let footer = document.getElementById("footer");

new ResizeSensor(main, function() {
    let sidebarHeight = document.documentElement.clientHeight
    $('#sidebar').css("height", (document.body.scrollHeight - header.clientHeight - footer.clientHeight) + 'px');
});

$(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});