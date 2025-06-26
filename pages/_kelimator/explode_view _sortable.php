<?php


$id =   isset($_GET['id']) ? sanitize_text_field($_GET['id']) : "";


// $title = "Add"; 
$form = '<form action="/wp-admin/admin.php?page=stnc_building_company&st_trigger=store" method="post">';

if ((isset($_GET['st_trigger'])) && ($_GET['st_trigger'] === 'edit')) {
    // $title = esc_html_e('Show', 'the-stnc-map');
    $form = '<form action="/wp-admin/admin.php?page=stnc_building_company&st_trigger=update&id=' . $id . '" method="post">';
}

include("_header-show.php");



if (isset($_SESSION['stnc_map_flash_msg'])) {
?>
    <p class="alert alert-success">
        <?php echo $_SESSION['stnc_map_flash_msg']; ?>
    </p>
    <?php unset($_SESSION['stnc_map_flash_msg']); ?>
<?php } ?>





<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css"
    integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="https://sortablejs.github.io/Sortable/Sortable.js"></script>

<script>



var gridDemo = document.getElementById('gridDemo');

new Sortable(gridDemo, {
	animation: 150,
	ghostClass: 'blue-background-class'
});


var listName = document.getElementById('grid').value;
var wrapper = document.createElement('div');
wrapper.setAttribute("id", listName);
Sortable.create(listName, options);


</script>
<style>
    .glyphicon-move {
  cursor: move;
  cursor: -webkit-grabbing;
}

.grid-square {
	width: 100px;
	height: 100px;
	display: inline-block;
	background-color: #fff;
	border: solid 1px rgb(0,0,0,0.2);
	padding: 10px;
	margin: 12px;
}



</style>


<div id="grid" class="row">
			<h4 class="col-12">Grid Example</h4>
			<div id="gridDemo" class="col">
				<div class="grid-square">Item 1</div><!--
			 --><div class="grid-square">Item 2</div><!--
			 --><div class="grid-square">Item 3</div><!--
			 --><div class="grid-square">Item 4</div><!--
			 --><div class="grid-square">Item 5</div><!--
			 --><div class="grid-square">Item 6</div><!--
			 --><div class="grid-square">Item 7</div><!--
			 --><div class="grid-square">Item 8</div><!--
			 --><div class="grid-square">Item 9</div><!--
			 --><div class="grid-square">Item 10</div><!--
			 --><div class="grid-square">Item 11</div><!--
			 --><div class="grid-square">Item 12</div><!--
			 --><div class="grid-square">Item 13</div><!--
			 --><div class="grid-square">Item 14</div><!--
			 --><div class="grid-square">Item 15</div><!--
			 --><div class="grid-square">Item 16</div><!--
			 --><div class="grid-square">Item 17</div><!--
			 --><div class="grid-square">Item 18</div><!--
			 --><div class="grid-square">Item 19</div><!--
			 --><div class="grid-square">Item 20</div>
			</div>
		</div>

<form action="/wp-admin/admin.php?page=helix_explode&st_trigger=store&id=<?php echo  $id ?>" method="post">
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
                            <div class="row g-2 data_main_language"  id="data_main_language">
                        
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
                            <h5 class="card-title"><?php echo  $translate  ?></h5>
                            <div class="row g-2 data_translate_language" id="sortable">
                            <div class="grid-square" style="" draggable="false">Item 1</div>
                            <div class="grid-square">Item 2</div>
                                <?php echo $translate_language_json ?>

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