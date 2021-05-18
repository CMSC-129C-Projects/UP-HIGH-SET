function openQuestionnaire(evt, type) {
    // Declare all variables
    var i, tabcontent, tablinks;
  
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(type).style.display = "block";
    evt.currentTarget.className += " active";

    resize();
}

$(function() {
  $('.clear').click(function() {
    const id = $(this).attr('data-id');
    $('input[name="choices_'+ id +'"]:checked').prop('checked', false);
  });
});