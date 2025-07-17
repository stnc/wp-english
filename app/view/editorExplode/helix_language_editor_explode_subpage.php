<?php


$id =   isset($_GET['id']) ? sanitize_text_field($_GET['id']) : "";


// $title = "Add"; 
$form = '<form action="/wp-admin/admin.php?page=helix_language_editor_explode&trigger=store" method="post">';

if ((isset($_GET['trigger'])) && ($_GET['trigger'] === 'edit')) {
    // $title = esc_html_e('Show', 'helix-lng');
    $form = '<form action="/wp-admin/admin.php?page=helix_language_editor_explode&trigger=update&id=' . $id . '" method="post">';
}

include("common_header.php");



if (isset($_SESSION['helix_map_flash_msg'])) {
?>
    <p class="alert alert-success">
        <?php echo $_SESSION['helix_map_flash_msg']; ?>
    </p>
    <?php unset($_SESSION['helix_map_flash_msg']); ?>
<?php } ?>





<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css"
    integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
table {
  border-collapse: collapse;
  margin: 20px;
  font-family: sans-serif;
}
th, td {
  border: 1px solid #ccc;
  padding: 8px 12px;
  text-align: center;
}
th {
  background-color: #007BFF;
  color: white;
}
tr:nth-child(even) {
  background-color: #f2f2f2;
}
</style>







<form action="/wp-admin/admin.php?page=helix_language_editor_explode&trigger=store&id=<?php echo  $id ?>" method="post">
    <main class="flex-shrink-0" style="">
        <section class="container" id="dracula">

            <div class="row">
                <div class="col-lg-10">
                    <div class="card" style="max-width: 100%;">
                        <div class="card-header">Main Language</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo  $main_language  ?></h5>
                            <div class="row g-2 data_main_language"  id="data_main_language1">
                                <?php echo $main_language_json ?>

                            </div>
                        </div>
                    </div>


                    <div class="card" id="kelimatorButton" style="max-width: 100%;">
                        <div class="card-header">card olarak</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo  $main_language  ?></h5>
                            <div class="row2 g-2 data_main_language "  id="data_main_language ">
                        
                                <?php echo $button_html_json ?>

                            </div>
                        </div>
                    </div>


                </div>


                <div class="col-lg-2">
                    <div class="card" style="max-width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Ekle</h5>
                            <div class="row g-2">
                            <a href="javascript:void(0);" class="add_button" title="Add field"><img src="/wp-content/uploads/2025/03/add-icon.png"></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-10">
                    <div class="card" style="max-width: 100%;">
                        <div class="card-header">Translate</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo  $translate  ?> </h5>
                          
                            <div id="redips-drag" class="row g-2 data_translate_language">
        
                         





                            <table id="table11">
        <colgroup>
        <col width="50">
            <col width="50">
            <col width="50">
            <col width="50">
            
          
            

           
        </colgroup>
        <tbody>
        <?php echo $translate_language_json ?>
            
            

        </tbody>
    </table>










                           

                            </div>




                        </div>
                    </div>
                </div>


                <div class="col-lg-2">
                    <div class="card" style="max-width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Ekle</h5>
                            <div class="row g-2">
                            <a href="javascript:void(0);" class="add_button_translate" title="add_button_translate"><img src="/wp-content/uploads/2025/03/add-icon.png"></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>



            </div>
        </section>

        <section class="container">
            <div class="row">

            <div class="col-lg-10">
                    <div class="card" style="max-width: 100%;">
                        <div class="card-body">
                            <div class="row g-2">
                                <label for="">Aciklama</label>
                                <textarea name="comment" id=""><?php echo $comment ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="card" style="max-width: 100%;">
                        <div class="card-body">
                            <div class="row g-2">
                                <input type="submit" name="submit" value="SUBMIT" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
</form>

</main>



<script src="https://cdn.jsdelivr.net/gh/dbunic/REDIPS_drag@master/redips-drag-min.js"></script>
  
<script>
    /**  DRAG AND DROP   */  
//https://jsfiddle.net/v4qhdmzL/83/


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
  var tbl = document.getElementById('table11'),	// reference to the main table
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


redips.droppedBefore = function (targetCell) {
        // test if target cell is occupied and set reference to the dragged DIV element
        var empty = redips.emptyCell(targetCell, 'test'),
            obj = redips.obj;
        // if target cell is not empty
        if (!empty) {
            // confirm question should be wrapped in setTimeout because of
            // removeChild and return false below
            setTimeout(function () {
                // ask user if he wants to overwrite TD (cell is already occupied)
                if (confirm('Overwrite content?')) {
                    redips.emptyCell(targetCell);
                }
                // append previously removed DIV to the target cell
                targetCell.appendChild(obj);
            }, 50);
            // remove dragged DIV from from DOM (node still exists in memory)
            obj.parentNode.removeChild(obj);
            // return false (deleted DIV will not be returned to source cell)
            return false;
        }
    };


// add onload event listener
if (window.addEventListener) {
    window.addEventListener('load', redips.init, false);
}
else if (window.attachEvent) {
    window.attachEvent('onload', redips.init);
}

</script>