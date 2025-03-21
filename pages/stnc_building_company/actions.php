<?php
function stnc_wp_floor_adminMenu_stnc_building_company()
{
    // session_start();
    //  stnc_building_company
    global $wpdb;
    $stncForm_tableNameMain = $wpdb->prefix . 'hisar_words';

    date_default_timezone_set('Europe/Istanbul');
    $date = date('Y-m-d h:i:s');


    if ((isset($_GET['st_trigger'])) && ($_GET['st_trigger'] === 'edit')) {
        // session_start();
        $editId = sanitize_text_field($_GET['id']);
        $data = $wpdb->get_row($wpdb->prepare("SELECT *  FROM " . $stncForm_tableNameMain . "  WHERE id = %d", $editId));

        $id =  $data->id;
        $level =  $data->level;
        $main_language =  $data->main_language;
        $translate =  $data->translate;
        // $data =  str_replace([" ", '\\'], "", $web_permission);
        // $web_permission =  json_decode($data, true, JSON_UNESCAPED_SLASHES);

        $table = $wpdb->prefix . 'hisar_level_categories';
        $sql_company_list = 'SELECT * FROM ' . $table . '  WHERE status=1';
        $categoriesList = $wpdb->get_results($sql_company_list);

        $table = $wpdb->prefix . 'hisar_speak_level_categories';
        $sql_SpeakLevelList = 'SELECT * FROM ' . $table . '  WHERE status=1';
        $categoriesSpeakLevelList = $wpdb->get_results($sql_SpeakLevelList);

        $table = $wpdb->prefix . 'hisar_level_categories_record';
        $sql_level_categories_record = 'SELECT level_id FROM ' . $table . '  WHERE word_id=' . $editId;
        $level_categories_record = $wpdb->get_results($sql_level_categories_record, 'ARRAY_A');

        // echo "<pre>";

        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        $nlist = array();
        foreach ($level_categories_record as $value) {
            $nlist[] = $value["level_id"];
        }



        // // print_r(    $categoriesSpeakLevelList);
        // print_r($level_categories_record);
     








        include('add_edit.php');
    }

    if ((isset($_GET['st_trigger'])) && ($_GET['st_trigger'] === 'update')) {
        // session_start();
        // print_r("gelir");
    
        $id1 = sanitize_text_field($_GET['id']);
        // print_r(  $id1);
     
        $translate = isset($_POST["translate"]) ? sanitize_text_field($_POST["translate"]) : " ";
        $main_language = isset($_POST["main_language"]) ? sanitize_text_field($_POST["main_language"]) : " ";
        $level = isset($_POST["level"]) ? sanitize_text_field($_POST["level"]) : 1;
//         echo "<pre>";
//         print_r(  $translate);
//         echo "<br>";
//         print_r(  $main_language);
// //   die;



        $success1 = $wpdb->update(
            $stncForm_tableNameMain,
            array(
                'level' =>  $level,
                'translate' =>   $translate,
                'main_language' =>   $main_language,
            ),
            array('id' =>  $id1)
        );

        var_dump( $success1);



        if (isset($_POST['speakLevelList'])) {
            // print_r("gelir3");
            $wpdb->delete("{$wpdb->prefix}hisar_level_categories_record", array('word_id' =>  $id1));
            foreach ($_POST['speakLevelList'] as $key => $value) {
                // print_r("gelir4");
                $wpdb->insert(
                    $wpdb->prefix . "hisar_level_categories_record",
                    array(
                        'word_id' =>   sanitize_text_field($id1),
                        'level_id' =>  sanitize_text_field($value),
                    ),
                );
            }
        }


        // if ($success1) {
            print_r("gelir last");
            $_SESSION['stnc_map_flash_msg'] =  __('Record Updated', 'the-stnc-map');
            wp_redirect('/wp-admin/admin.php?page=stnc_building_company&st_trigger=edit&id=' .  $id1, 302);
            die;
        // }
    }


    if ((isset($_GET['st_trigger'])) && ($_GET['st_trigger'] === 'new')) {
        // session_start();
        $level = isset($_POST["level"]) ? sanitize_text_field($_POST["level"]) : 1;
        $main_language = isset($_POST["main_language"]) ? sanitize_text_field($_POST["main_language"]) : " ";
        $translate = isset($_POST["translate"]) ? sanitize_text_field($_POST["translate"]) : " ";
        // $web_permission = '[{\"door_number_permission\":false,\"square_meters_permission\":false,\"email_permission\":false,\"phone_permission\":false,\"mobile_phone_permission\":false,\"web_site_permission\":false,\"translate_permission\":false,\"main_language_permission\":false}]';
        // $data =  str_replace([" ", '\\'], "", $web_permission);
        // $web_permission =  json_decode($data, true, JSON_UNESCAPED_SLASHES);
        $table = $wpdb->prefix . 'hisar_level_categories';
        $sql_company_list = 'SELECT * FROM ' . $table . '  WHERE status=1';
        $categoriesList = $wpdb->get_results($sql_company_list);


        $table = $wpdb->prefix . 'hisar_speak_level_categories';
        $sql_SpeakLevelList = 'SELECT * FROM ' . $table . '  WHERE status=1';
        $categoriesSpeakLevelList = $wpdb->get_results($sql_SpeakLevelList);



        include('add_edit.php');
    }

    if ((isset($_GET['st_trigger'])) && ($_GET['st_trigger'] === 'store')) {
        // session_start();
        $level = isset($_POST["level"]) ? sanitize_text_field($_POST["level"]) : 1;
        $building_id = isset($_GET["building_id"]) ? sanitize_text_field($_GET["building_id"]) : " ";

        $translate = isset($_POST["translate"]) ? sanitize_text_field($_POST["translate"]) : " ";

        $main_language = isset($_POST["main_language"]) ? sanitize_text_field($_POST["main_language"]) : " ";

        $success =   $wpdb->insert(
            $stncForm_tableNameMain,
            array(
                'level' =>   $level,
                'translate' =>   $translate,
                'main_language' =>   $main_language,
            ),
        );

        if ($success) {

            $lastid = $wpdb->insert_id;
            if (isset($_POST['speakLevelList'])) {
                foreach ($_POST['speakLevelList'] as $key => $value) {
                    $wpdb->insert(
                        $wpdb->prefix . "hisar_level_categories_record",
                        array(
                            'word_id' =>   sanitize_text_field($lastid),
                            'level_id' =>  sanitize_text_field($value),
                        ),
                    );
                }
            }

            $_SESSION['stnc_map_flash_msg'] =  __('Record Save', 'the-stnc-map');
            wp_redirect('/wp-admin/admin.php?page=stnc_building_company&st_trigger=edit&id=' . $lastid, 302);
            die;
        }
    }
}

function hisar_searchArray($arr, $value)
{

    if (in_array($value, $arr)) {
        return true;
    } else {
        return false;
    }
}
