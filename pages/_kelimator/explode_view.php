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

<script src="https://cdn.jsdelivr.net/gh/dbunic/REDIPS_drag@master/redips-drag-min.js"></script>
  
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


<table>
<colgroup>
            <col width="50">
            <col width="50">
            <col width="50">
            <col width="50">
            
            
            
           
        </colgroup>
        <tbody>
  <?php


$colors = array("red1", "green1", "blue1", "yellow1","red2", "green2", "blue2", "yellow2", "red3", "green3", "blue3", "yellow3", "red4", "green4", "blue4", "yellow4");
echo count($colors) . "<br>";




// 4 elemanlı gruplara ayır
$gruplar = array_chunk($colors, 4);

// Grupları yazdır
foreach ($gruplar as $index => $grup) {
    echo "<tr>";


            foreach ($grup as $index2 => $val) {
                echo " <td>$val </td> ";
            } 

echo "</tr>";
}



  ?>
     </tbody>
</table>



--------


<table>
<colgroup>
            <col width="50">
            <col width="50">
            <col width="50">
            <col width="50">
            
            
            
           
        </colgroup>
        <tbody>
  <?php


$colors = array("red1", "green1", "blue1", "yellow1","red2", "green2", "blue2", "yellow2", "red3", "green3", "blue3", "yellow3", "red4", "green4", "blue4", "yellow4");
echo count($colors) . "<br>";


foreach ($colors as $key => $value) {
  $i= $key + 1;
//   echo "<tr>";
      if ($i % 5 == 0) {

       
        echo "<tr>
        <td>$value </td>

      </tr>";
      } 
        echo "
        <td>$value . $i</td>

      ";
      
    // echo "</tr>";
  }
  ?>
     </tbody>
</table>






<div id="redips-drag">
<table id="table2">
        <colgroup>
            <col width="50">
            <col width="50">
            <col width="50">
            <col width="50">
            
            
            
           
        </colgroup>
        <tbody>
            <tr>
                <td><div id="a1" class="redips-drag orange" data-border="border1.jpg" data-division="division1.jpg" style="border-style: solid; cursor: move;">a1</div></td>
                <td><div id="a2" class="redips-drag orange" data-border="border2.jpg" data-division="division1.jpg" style="border-style: solid; cursor: move;">a2</div></td>
                <td style=""><div id="a3" class="redips-drag orange" data-border="border2.jpg" data-division="division2.jpg" style="border-style: solid; cursor: move;">a3</div></td>
                <td style=""><div id="a3" class="redips-drag orange" data-border="border2.jpg" data-division="division2.jpg" style="border-style: solid; cursor: move;">a4</div></td>
                
                
            </tr>
            
            
            <tr>
                <td></td><td></td><td style=""></td><td style=""></td>
            </tr>
            <tr>
                <td></td><td></td><td style=""></td><td style=""></td>
            </tr>
            <tr>
                <td></td><td></td><td style=""></td><td style=""></td>
            </tr>   
             <tr>
                <td></td><td></td><td style=""></td><td style=""></td>
            </tr>
        </tbody>
    </table>
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
                            <div class="row g-2 data_main_language "  id="data_main_language">
                        
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
                          
                            <div class="row g-2 data_translate_language redips-drag2">
        
                            <?php echo $translate_language_json ?>















                           

                            </div>



                            <table id="table1">
        <colgroup>
        <?php echo $colon ?>
          
            

           
        </colgroup>
        <tbody>
            <tr>

        
                
            </tr>
            
            

        </tbody>
    </table>



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