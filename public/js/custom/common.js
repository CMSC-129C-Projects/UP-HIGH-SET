function getSize() {
    const width  = window.innerWidth || document.documentElement.clientWidth || 
    document.body.clientWidth;
    const height = window.innerHeight|| document.documentElement.clientHeight|| 
    document.body.clientHeight;

    return {width: width, height: height};
}

let footer = document.getElementById('footer');
let header = document.getElementById('header');
let fHeight = footer.offsetHeight;
let hHeight = header.offsetHeight;
let windowSize = getSize();

$(window).resize(function() {
    // Do something more useful
    $('#sidebar').css("height", windowSize.height);
// conso
});

$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});