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