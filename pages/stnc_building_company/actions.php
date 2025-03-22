<?php
function stnc_wp_floor_adminMenu_stnc_building_company()
{
    // session_start();
    //  stnc_building_company
    global $wpdb;
    $stncForm_tableNameMain = $wpdb->prefix . 'hisar_words';

    date_default_timezone_set('Europe/Istanbul');
    $date = date('Y-m-d h:i:s');





    if ((isset($_GET['st_trigger'])) && ($_GET['st_trigger'] === 'new')) {
        // session_start();
        $level_cat_id = isset($_POST["level_cat_id"]) ? sanitize_text_field($_POST["level_cat_id"]) : 1;
        $tense_id = isset($_POST["tense_id"]) ? sanitize_text_field($_POST["tense_id"]) : 1;
        $vocable_level = isset($_POST["vocable_level_id"]) ? sanitize_text_field($_POST["vocable_level_id"]) : 1;
        $main_language = isset($_POST["main_language"]) ? sanitize_text_field($_POST["main_language"]) : " ";
        $translate = isset($_POST["translate"]) ? sanitize_text_field($_POST["translate"]) : " ";
        // $web_permission = '[{\"door_number_permission\":false,\"square_meters_permission\":false,\"email_permission\":false,\"phone_permission\":false,\"mobile_phone_permission\":false,\"web_site_permission\":false,\"translate_permission\":false,\"main_language_permission\":false}]';
        // $data =  str_replace([" ", '\\'], "", $web_permission);
        // $web_permission =  json_decode($data, true, JSON_UNESCAPED_SLASHES);
        $table = $wpdb->prefix . 'hisar_level_categories';
        $sql_company_list = 'SELECT * FROM ' . $table . '  WHERE status=1';
        $categoriesList = $wpdb->get_results($sql_company_list);


        $table_vocable_level_List = $wpdb->prefix . 'hisar_vocable_level';
        $sql_vocable_level_List = 'SELECT * FROM ' . $table_vocable_level_List . '  WHERE status=1';
        $vocable_level_List = $wpdb->get_results($sql_vocable_level_List);



        $table = $wpdb->prefix . 'hisar_speak_level_categories';
        $sql_SpeakLevelList = 'SELECT * FROM ' . $table . '  WHERE status=1';
        $categoriesSpeakLevelList = $wpdb->get_results($sql_SpeakLevelList);

        $table_tense_list = $wpdb->prefix . 'hisar_tense';
        $sql_tense_List = 'SELECT * FROM ' . $table_tense_list . '  WHERE status=1';
        $vocable_tense_list = $wpdb->get_results($sql_tense_List);

        include('add_edit.php');
    }

    if ((isset($_GET['st_trigger'])) && ($_GET['st_trigger'] === 'store')) {
        // session_start();
        $level_cat_id = isset($_POST["level_cat_id"]) ? sanitize_text_field($_POST["level_cat_id"]) : 1;
        $tense_id = isset($_POST["tense_id"]) ? sanitize_text_field($_POST["tense_id"]) : 1;
        $vocable_level = isset($_POST["vocable_level"]) ? sanitize_text_field($_POST["vocable_level"]) : 1;
        $building_id = isset($_GET["building_id"]) ? sanitize_text_field($_GET["building_id"]) : " ";

        $translate = isset($_POST["translate"]) ? sanitize_text_field($_POST["translate"]) : " ";

        $main_language = isset($_POST["main_language"]) ? sanitize_text_field($_POST["main_language"]) : " ";

        $success =   $wpdb->insert(
            $stncForm_tableNameMain,
            array(
                'level_cat_id' =>   $level_cat_id,
                'vocable_level_id' =>   $vocable_level,
                'tense_id' =>  $tense_id,
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



    if ((isset($_GET['st_trigger'])) && ($_GET['st_trigger'] === 'edit')) {
        // session_start();
        $editId = sanitize_text_field($_GET['id']);
        $data = $wpdb->get_row($wpdb->prepare("SELECT *  FROM " . $stncForm_tableNameMain . "  WHERE id = %d", $editId));

        $id =  $data->id;
        $level_cat_id =  $data->level_cat_id;
        $tense_id =  $data->tense_id;
        $vocable_level =  $data->vocable_level_id;
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



        $table_tense_list = $wpdb->prefix . 'hisar_tense';
        $sql_tense_List = 'SELECT * FROM ' . $table_tense_list . '  WHERE status=1';
        $vocable_tense_list = $wpdb->get_results($sql_tense_List);



        $table_vocable_level_List = $wpdb->prefix . 'hisar_vocable_level';
        $sql_vocable_level_List = 'SELECT * FROM ' . $table_vocable_level_List . '  WHERE status=1';
        $vocable_level_List = $wpdb->get_results($sql_vocable_level_List);



        $table = $wpdb->prefix . 'hisar_level_categories_record';
        $sql_level_categories_record = 'SELECT level_id FROM ' . $table . '  WHERE word_id=' . $editId;
        $level_categories_record = $wpdb->get_results($sql_level_categories_record, 'ARRAY_A');

        // echo "<pre>";
        $nlist = array();
        foreach ($level_categories_record as $value) {
            $nlist[] = $value["level_id"];
        }

        include('add_edit.php');
    }

    if ((isset($_GET['st_trigger'])) && ($_GET['st_trigger'] === 'update')) {
        // session_start();
        // print_r("gelir");

        $id1 = sanitize_text_field($_GET['id']);
        // print_r(  $id1);

        $translate = isset($_POST["translate"]) ? sanitize_text_field($_POST["translate"]) : " ";
        $main_language = isset($_POST["main_language"]) ? sanitize_text_field($_POST["main_language"]) : " ";
        $level_cat_id = isset($_POST["level_cat_id"]) ? sanitize_text_field($_POST["level_cat_id"]) : 1;
        $vocable_level = isset($_POST["vocable_level"]) ? sanitize_text_field($_POST["vocable_level"]) : 1;
        $tense_id = isset($_POST["tense_id"]) ? sanitize_text_field($_POST["tense_id"]) : 1;
        //         echo "<pre>";
        //         print_r(  $translate);
        //         echo "<br>";
        //         print_r(  $main_language);
        // //   die;



        $success1 = $wpdb->update(
            $stncForm_tableNameMain,
            array(
                'level_cat_id' =>  $level_cat_id,
                'vocable_level_id' =>  $vocable_level,
                'tense_id' =>  $tense_id,
                'translate' =>   $translate,
                'main_language' =>   $main_language,
            ),
            array('id' =>  $id1)
        );

        // var_dump($success1);



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
        } else {
            $wpdb->delete("{$wpdb->prefix}hisar_level_categories_record", array('word_id' =>  $id1));
        }


        // if ($success1) {
        //   print_r("gelir last");
        $_SESSION['stnc_map_flash_msg'] =  __('Record Updated', 'the-stnc-map');
        wp_redirect('/wp-admin/admin.php?page=stnc_building_company&st_trigger=edit&id=' .  $id1, 302);
        die;
        // }
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
