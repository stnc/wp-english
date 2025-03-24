
'use strict';
jQuery.noConflict();

jQuery(document).ready(function ($) {

    var maxField = 15; //Input fields increment limitation
    var addButton = jQuery('.add_button'); //Add button selector
    var wrapper = jQuery('.data_main_language'); //Input field wrapper
    var fieldHTML = '<div class="mb-3 col-md-4"><input type="text" class="form-control" name="main_language_json[]" value=""/><a href="javascript:void(0);"  class="remove_button "><img src="/wp-content/uploads/2025/03/remove-icon.png"/></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1

    // Once add button is clicked
        jQuery(addButton).on("click", function(event) {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increase field counter
            jQuery(wrapper).append(fieldHTML); //Add field html
        } else {
            alert('A maximum of ' + maxField + ' fields are allowed to be added. ');
        }
    });

    // Once remove button is clicked
    jQuery(wrapper).on('click', '.remove_button', function (e) {

        e.preventDefault();
        jQuery(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });



////////////////////////////////////



    var addButton_translate= jQuery('.add_button_translate'); //Add button selector
    var wrapper_translate = jQuery('.data_translate_language'); //Input field wrapper
    var fieldHTML_translate = '<div class="mb-3 col-md-4"><input type="text" class="form-control" name="translate_language_json[]" value=""/><a href="javascript:void(0);"  class="remove_button "><img src="/wp-content/uploads/2025/03/remove-icon.png"/></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1

    // Once add button is clicked
        jQuery(addButton_translate).on("click", function(event) {   

        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increase field counter
            jQuery(wrapper_translate).append(fieldHTML_translate); //Add field html
        } else {
            alert('A maximum of ' + maxField + ' fields are allowed to be added. ');
        }
    });

    // Once remove button is clicked
    jQuery(wrapper_translate).on('click', '.remove_button', function (e) {
        e.preventDefault();
        jQuery(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });




});