// let windowSize;
// let header = document.getElementById("header");
// let footer = document.getElementById("footer");
// let main = document.getElementById("main");

// const defaultHeight = main.clientHeight;
// function getSize() {
//     // const width  = window.innerWidth || document.documentElement.clientWidth || 
//     // document.body.clientWidth;
//     // const height = window.innerHeight|| document.documentElement.clientHeight|| 
//     // document.body.clientHeight;

//     // return {width: width, height: height};
//     var body = document.body,
//     html = document.documentElement;

//     var height = Math.max( body.scrollHeight, body.offsetHeight, 
//                 html.clientHeight, html.scrollHeight, html.offsetHeight );
//     return height;
// }

// $(window).resize(function() {
//     windowSize = getSize();
//     headerHeight = header.clientHeight;
//     footerHeight = footer.clientHeight;
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


function getSize() {
    // const width  = window.innerWidth || document.documentElement.clientWidth || 
    // document.body.clientWidth;
    // const height = window.innerHeight|| document.documentElement.clientHeight|| 
    // document.body.clientHeight;

    // return {width: width, height: height};
    var body = document.body,
    html = document.documentElement;

    var height = Math.max( body.scrollHeight, body.offsetHeight, 
                html.clientHeight, html.scrollHeight, html.offsetHeight );
    return height;
}

let windowSize;
let header = document.getElementById("header");
let footer = document.getElementById("footer");

$(window).resize(function() {
    windowSize = getSize();
    headerHeight = header.clientHeight;
    footerHeight = footer.clientHeight;
    $('#sidebar').css("height", (windowSize - headerHeight - footerHeight) + "px");
    $('#main').css("height", (windowSize - headerHeight - footerHeight) + "px");
});

$(document).ready(function () {
    windowSize = getSize();
    headerHeight = header.clientHeight;
    footerHeight = footer.clientHeight;
    $('#sidebar').css("height", (windowSize - headerHeight - footerHeight) + "px");
    $('#main').css("height", (windowSize - headerHeight - footerHeight) + "px");

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});