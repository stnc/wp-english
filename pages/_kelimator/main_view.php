<?php


 $id =   isset($_GET['id']) ? sanitize_text_field($_GET['id']) : "";


// $title = "Add";
$form = '<form action="/wp-admin/admin.php?page=stnc_building_company&st_trigger=store" method="post">';

if ((isset($_GET['st_trigger'])) && ($_GET['st_trigger'] === 'edit')) {
    //$title = esc_html_e('Show', 'helix-lng');
    $form = '<form action="/wp-admin/admin.php?page=stnc_building_company&st_trigger=update&id=' . $id . '" method="post">';
}

include("_header-show.php");
?>





<main class="flex-shrink-0" style="">
    <div class="stnc-container-fluid">

        <?php
        if (isset($_SESSION['stnc_map_flash_msg'])) {
        ?>
            <p class="alert alert-success">
                <?php echo $_SESSION['stnc_map_flash_msg']; ?>
            </p>
            <?php unset($_SESSION['stnc_map_flash_msg']); ?>
        <?php } ?>

        <?php echo $form  ?>

        <input type="hidden" value="<?php echo $media_id ?>" name="media_id" id="media_id">
        <div class="stnc-row">

            <div class="stnc-col-8">
            <h5 class="card-title"> <?php esc_html_e('Language Add', 'helix-lng') ?></h5>
                <div class="card" style="max-width:100%">
                    <div class="card-body">

                  



                        <div class="form-group">
                            <span>Ne tur bir konusma metni? </span>
                        <?php if ((isset($_GET['st_trigger'])) && ($_GET['st_trigger'] === 'edit')) { ?>
                            <?php foreach ($categoriesSpeakLevelList as $categories) : 
                                   $checkControl=helix_searchArray(  $nlist,$categories->level_id );
                                ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" <?php if ($checkControl){echo 'checked';}  ?> name="speakLevelList[]" for="speakLevelList<?php echo $categories->level_id ?>" value="<?php echo $categories->level_id ?>">
                                        <label class="form-check-label" for="speakLevelList<?php echo $categories->level_id ?>"><?php echo $categories->name ?></label>
                                    </div>
                      
                            <?php endforeach ?>
                        <?php } else { ?>
                            <?php foreach ($categoriesSpeakLevelList as $categories) : ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" <?php if ($categories->level_id == $level) echo 'checked'; ?> name="speakLevelList[]" for="speakLevelList<?php echo $categories->id ?>" value="<?php echo $categories->level_id ?>">
                                    <label class="form-check-label" for="speakLevelList<?php echo $categories->level_id ?>"><?php echo $categories->name ?></label>
                                </div>
                            <?php endforeach ?>

                        <?php } ?>
                        </div>


                        <hr>

                        <div class="form-group">
                            <label  class="form-label" for="level_cat_id"> <strong><?php esc_html_e('Level', 'helix-lng') ?></strong> </label>
                            <select name="level_cat_id"  class="form-select">
                                <?php foreach ($categoriesList as $categories) : ?>
                                    <option <?php if ($categories->level_id == $level_cat_id) echo 'selected'; ?> for="level_cat_id" value="<?php echo $categories->level_id ?>"><?php echo $categories->name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <hr>

                        
                        <div class="form-group">
                            <label class="form-label" for="vocable_level"> <strong><?php esc_html_e('vocable level', 'helix-lng') ?></strong> </label>
                            <select class="form-select" name="vocable_level">
                                <?php foreach ($vocable_level_List as $value) : ?>
                                    <option <?php if ($value->vocable_level_id == $vocable_level) echo 'selected'; ?> for="level" value="<?php echo $value->vocable_level_id ?>"><?php echo $value->name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label class="form-label" for="tense_id"> <strong><?php esc_html_e('Tense', 'helix-lng') ?></strong> </label>
                            <select class="form-select" name="tense_id">
                                <?php foreach ($vocable_tense_list as $value) : ?>
                                    <option <?php if ($value->tense_id == $tense_id) echo 'selected'; ?> for="level" value="<?php echo $value->tense_id ?>"><?php echo $value->name_eng ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>


                        <hr>

                        <div class="form-group">
                            <label for="main_language"><strong><?php esc_html_e('main_language', 'helix-lng') ?></strong></label>

                            <textarea class="form-control" name="main_language" id="main_language" rows="3"><?php echo $main_language ?></textarea>
                        </div>


                        <div class="form-group">
                            <label for=""><strong><?php esc_html_e('Ceviri nin dil dosyasi url si ', 'helix-lng') ?></strong></label>
<span>input eklenecek ve db ye alan eklenecek </span>
                          
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="translate"><strong><?php esc_html_e('translate', 'helix-lng') ?></strong></label>

                            <textarea class="form-control" name="translate" id="translate" rows="3"><?php echo $translate ?></textarea>
                        </div>
                        <hr>


                        <div class="form-group">
                            <label for="source"><strong><?php esc_html_e('source', 'helix-lng') ?></strong></label>

                            <textarea class="form-control" name="source" id="source" rows="3"><?php echo $source ?></textarea>
                        </div>



                    </div>
                </div>

            </div>

            <!-- <div class="stnc-col-4">
                <div class="card">
                    <div class="card-body">



                    </div>
                </div>
            </div> -->


            <div class="stnc-col-2">

                <br>
                <br>

                <div class="form-group">

                    <input id="stnc_wp_kiosk_Metabox_video_extra"
                        class="page_upload_trigger_element button btn btn-warning"
                        name="stnc_wp_kiosk_Metabox_video_extra" type="button" value="<?php esc_html_e('Upload / Select Image', 'helix-lng') ?>" style="">

                    <?php  //if ((isset($_GET['st_trigger'])) && ($_GET['st_trigger'] === 'show')) : 
                    // $image = wp_get_attachment_image_src(    $media_id  ,'full' );

                    ?>
                    <div class="background_attachment_metabox_container"> <img class="img-fluid" src=" <?php //echo $image[0]; 
                                                                                                        ?> " alt=""> </div>
                    <?php //else : 
                    ?>
                    <div class="background_attachment_metabox_container"> </div>
                    <?php // endif ; 
                    ?>
                </div>
  
                <div class="form-group">
                    <button type="submit" value="Kaydet" id="savebtn-stncMap" class="btn btn-success"> <?php esc_html_e('Save', 'helix-lng') ?></button>
                    <?php if ((isset($_GET['st_trigger'])) && ($_GET['st_trigger'] === 'edit')) : 
                        		$delete_nonce = wp_create_nonce('sp_delete_stncMapFloors'); ?>

                 <?php if ($is_json == 1) :  ?>
                   <a  href="/wp-admin/admin.php?page=helix_explode&st_trigger=edit&id=<?php echo  $id ;?>&_wpnonce=<?php echo  $delete_nonce ;?>" id="savebtn-stncMap2" class="btn btn-primary">Parcalanmis Kelimeyi Duzenle</a>
                 <?php endif; ?> 
                 
                 <?php if ($is_json == 0) :  ?>
                   <a  href="/wp-admin/admin.php?page=helix_explode&st_trigger=new&id=<?php echo  $id ;?>&_wpnonce=<?php echo  $delete_nonce ;?>" id="savebtn-stncMap2" class="btn btn-primary">Kelimeyi Parcala</a>
                 <?php endif; ?> 
                 
                   <?php endif ?>
                </div>
            </div>
        </div>

        <?php echo   '</form>' ?>
    </div>


</main>