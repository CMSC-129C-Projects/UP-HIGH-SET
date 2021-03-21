$(function (){
    // Bind to the submit event of our form
    $("#student-form").submit(function(event){
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
    
        var request;
        // Abort any pending request
        if (request) {
            request.abort();
        }
        // setup some local variables
        var $form = $(this);
    
        // Let's select and cache all the fields
        var $inputs = $form.find("input, select, button, textarea");
    
        // Serialize the data in the form
        var serializedData = $form.serialize();
    
        // Let's disable the inputs for the duration of the Ajax request.
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        $inputs.prop("disabled", true);
    
        // Send request to controller
        if($(this).attr('data-type') == 'add') {
            request = $.ajax({
            url: BASE_URI + "update/add/1",
            type: 'POST',
            data: serializedData
            });
        } else {
            request = $.ajax({
                url: BASE_URI + "update/edit/1/1",
                type: 'POST',
                data: serializedData
            });
        }
    
        // Callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR){
            window.location.href = BASE_URI + 'home';
        });
    
        // Callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown){
            // Log the error to the console
            console.log(
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });
    
        // Callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(function () {
            // Reenable the inputs
            $inputs.prop("disabled", false);
        });
    });
    
    // $("#student-form").submit(function(event){
    //     // Prevent default posting of form - put here to work in case of errors
    //     event.preventDefault();
    
    //     var request;
    //     // Abort any pending request
    //     if (request) {
    //         request.abort();
    //     }
    //     // setup some local variables
    //     var $form = $(this);
    
    //     // Let's select and cache all the fields
    //     var $inputs = $form.find("input, select, button, textarea");
    
    //     // Serialize the data in the form
    //     var serializedData = $form.serialize();
    
    //     // Let's disable the inputs for the duration of the Ajax request.
    //     // Note: we disable elements AFTER the form data has been serialized.
    //     // Disabled form elements will not be serialized.
    //     $inputs.prop("disabled", true);
    
    //     // Send request to controller
    //     if($(this).attr('data-type') == 'add') {
    //         request = $.ajax({
    //         url: BASE_URI + "update/add/1",
    //         type: 'POST',
    //         data: serializedData
    //         });
    //     } else {
    //         request = $.ajax({
    //             url: BASE_URI + "update/edit/1/1",
    //             type: 'POST',
    //             data: serializedData
    //         });
    //     }
    
    //     // Callback handler that will be called on success
    //     request.done(function (response, textStatus, jqXHR){
    //         window.location.href = BASE_URI + 'home';
    //     });
    
    //     // Callback handler that will be called on failure
    //     request.fail(function (jqXHR, textStatus, errorThrown){
    //       // Log the error to the console
    //       console.log(
    //           "The following error occurred: "+
    //           textStatus, errorThrown
    //       );
    //     });
    
    //     // Callback handler that will be called regardless
    //     // if the request failed or succeeded
    //     request.always(function () {
    //       // Reenable the inputs
    //       $inputs.prop("disabled", false);
    //     });
    // });
})