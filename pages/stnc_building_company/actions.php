<?php
function stnc_wp_floor_adminMenu_stnc_building_company()
{
    // session_start();
    //  stnc_building_company
    global $wpdb;
    $stncForm_tableNameMain =$wpdb->prefix .'hisar_words' ;

    date_default_timezone_set('Europe/Istanbul');
    $date = date('Y-m-d h:i:s');

        //others build
        $building_id = $_GET['building_id'];



    if ((isset($_GET['st_trigger'])) && ($_GET['st_trigger'] === 'show')) {
        // session_start();
        $floorInfoData = $wpdb->get_row($wpdb->prepare("SELECT *  FROM " . $stncForm_tableNameMain . "  WHERE id = %d", $_GET['id']));

        $id =  $floorInfoData->id;
        $level =  $floorInfoData->level;
        $main_language =  $floorInfoData->main_language;
        $translate =  $floorInfoData->translate;
        // $data =  str_replace([" ", '\\'], "", $web_permission);
        // $web_permission =  json_decode($data, true, JSON_UNESCAPED_SLASHES);



        $table=$wpdb->prefix.'hisar_level_categories';
        $sql_company_list = 'SELECT * FROM ' . $table .'  WHERE status=1' ;
        $categoriesList = $wpdb->get_results($sql_company_list);
    //   echo '<pre>';
    //   print_r(  $categoriesList);
    //   die;
        include ('add_edit.php');
    }

    if ((isset($_GET['st_trigger'])) && ($_GET['st_trigger'] === 'update')) {
        // session_start();
        $translate = isset($_POST["translate"]) ? sanitize_text_field($_POST["translate"]) : " ";
        $main_language = isset($_POST["main_language"]) ? sanitize_text_field($_POST["main_language"]) : " ";
        $level = isset($_POST["level"]) ? sanitize_text_field($_POST["level"]) :16;


        $success =   $wpdb->update(
            $stncForm_tableNameMain,
            array(
                'level' =>  $level,
                'translate' =>   $translate,
                'main_language' =>   $main_language,
            ),
            array('id' => $_GET['id'])
        );

        if ($success) {

        $_SESSION['stnc_map_flash_msg'] =  __( 'Record Updated', 'the-stnc-map' );
        wp_redirect('/wp-admin/admin.php?page=stnc_building_company&st_trigger=show&building_id='.$building_id.'&floor_id='. $floor_id.'&id='.$_GET['id'], 302);
        die;
        }
        // include ('add_edit.php');
    }


    if ((isset($_GET['st_trigger'])) && ($_GET['st_trigger'] === 'new')) {
        // session_start();
        $level = isset($_POST["level"]) ? sanitize_text_field($_POST["level"]) : 1;
        $main_language = isset($_POST["main_language"]) ? sanitize_text_field($_POST["main_language"]) : " ";
        $translate = isset($_POST["translate"]) ? sanitize_text_field($_POST["translate"]) : " ";
        // $web_permission = '[{\"door_number_permission\":false,\"square_meters_permission\":false,\"email_permission\":false,\"phone_permission\":false,\"mobile_phone_permission\":false,\"web_site_permission\":false,\"translate_permission\":false,\"main_language_permission\":false}]';
        // $data =  str_replace([" ", '\\'], "", $web_permission);
        // $web_permission =  json_decode($data, true, JSON_UNESCAPED_SLASHES);
        $table=$wpdb->prefix.'hisar_level_categories';
        $sql_company_list = 'SELECT * FROM ' . $table .'  WHERE status=1' ;
        $categoriesList = $wpdb->get_results($sql_company_list);
        include ('add_edit.php');
    }

    if ((isset($_GET['st_trigger'])) && ($_GET['st_trigger'] === 'store')) {
        // session_start();
        $level = isset($_POST["level"]) ? sanitize_text_field($_POST["level"]) : 1;
        $building_id = isset($_GET["building_id"]) ? sanitize_text_field($_GET["building_id"]) : " ";

        $translate = isset($_POST["translate"]) ? sanitize_text_field($_POST["translate"]) : " ";

        $main_language = isset($_POST["main_language"]) ? sanitize_text_field($_POST["main_language"]) : " ";

        // $media_id = isset($_POST["media_id"]) ? sanitize_text_field($_POST["media_id"]) : 0;
      
        $success =   $wpdb->insert(
            $stncForm_tableNameMain,
            array(
                'level' =>   $level,
                'translate' =>   $translate,
                'main_language' =>   $main_language,
            ),
        );

        if ($success) {
            $_SESSION['stnc_map_flash_msg'] =  __( 'Record Save', 'the-stnc-map' );
            $lastid = $wpdb->insert_id;
            wp_redirect('/wp-admin/admin.php?page=stnc_building_company&building_id='.$building_id.'&floor_id='. $floor_id.'&st_trigger=show&id='. $lastid, 302);
            die;
        }

    }

}