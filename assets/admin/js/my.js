
'use strict';
jQuery.noConflict();

jQuery(document).ready(function ($) {

    var maxField = 15; //Input fields increment limitation
    var addButton = jQuery('.add_button'); //Add button selector
    var wrapper = jQuery('.data_main_language'); //Input field wrapper
    var fieldHTML = '<div class="mb-3 col-md-3"><input type="text" class="form-control" name="main_language_json[]" value=""/><a href="javascript:void(0);"  class="remove_button "><img src="/wp-content/uploads/2025/03/remove-icon.png"/></a></div>'; //New input field html 
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
    var fieldHTML_translate = '<div class="mb-3 col-md-3"><input type="text" class="form-control" name="translate_language_json[]" value=""/><a href="javascript:void(0);"  class="remove_button "><img src="/wp-content/uploads/2025/03/remove-icon.png"/></a></div>'; //New input field html 
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

/**  DRAG AND DROP   */  

// create container
var redips = {};

// initialization
redips.init = function () {
    // set reference to the REDIPS.drag library
    var rd = REDIPS.drag;
    // REDIPS.drag initialization
    rd.init();
};

// read values from "data-" attributes of dataName
redips.getData = function (dataName) {
	// variables
  var tbl = document.getElementById('table1'),	// reference to the main table
  		div = tbl.getElementsByTagName('DIV'),		// collect all DIV elements from main table
      dataValue,
      arr = [],
      i;
      
  // loop through DIV collection
  for (i = 0; i < div.length; i++) {
  	// read data value from current DIV element
    dataValue = div[i].dataset[dataName];
    // add value to the array if dataValue exists in HTML attribute
  	// and array already doesnt contain that value
    if (dataValue !== undefined && arr.indexOf(dataValue) === -1) {
			arr.push(dataValue);
    }
  }
  // display uniq values from "data-" attributes
  alert(dataName + ' - ' + arr.toString());
};


// add onload event listener
if (window.addEventListener) {
    window.addEventListener('load', redips.init, false);
}
else if (window.attachEvent) {
    window.attachEvent('onload', redips.init);
}
