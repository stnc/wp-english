<?php

// session_start();
//  stnc_building_company
use Nette\Utils\Arrays;
use Nette\Utils\Strings;

function stnc_wp_floor_adminMenu_explode()
{

    include('eng_library.php');

    if (file_exists('../vendor/autoload.php')) {
        require '../vendor/autoload.php';
    } else {
        echo "<h1>Lütfen composer.json ı yükleyin </h1>";
        echo "<p>Örnekler <a href='https://getcomposer.org/doc/00-intro.md#globally'>https://getcomposer.org/doc/00-intro.md#globally</a></p>";
        echo "<p> terminal yada cmd yi açarak  'composer install' yazınız</p>";
        echo "<p> eğer yuklü ise terminal yada cmd yi açarak  'composer update' yazınız</p>";
        exit();
    }

    global $wpdb;
    $stncForm_tableNameMain = $wpdb->prefix . 'helix_words';

    date_default_timezone_set('Europe/Istanbul');
    $date = date('Y-m-d h:i:s');

    if ((isset($_GET['st_trigger'])) && ($_GET['st_trigger'] === 'edit')) {

        $editId = sanitize_text_field($_GET['id']);
        $data = $wpdb->get_row($wpdb->prepare("SELECT *  FROM " . $stncForm_tableNameMain . "  WHERE id = %d", $editId));

        $id =  $data->id;
        // $level_cat_id =  $data->level_cat_id;
        // $tense_id =  $data->tense_id;
        // $vocable_level =  $data->vocable_level_id;
        $main_language =  $data->main_language;

        $translate =  $data->translate;

        $comment =  $data->comment;

        $piecesENG =  Strings::split($main_language, '~ \s*~');

        $main_language_json = "";
        $translate_language_json = "";

        foreach ($piecesENG as $key => $value) {
            $value = Strings::trim($value);
            $value = Strings::lower($value);
            $value = modal_verbs($value);
            $value = conjunctions($value);
            $value = prepositions($value);
            $value = ComplexPrepositions($value);
            $value = prepositionsOfTime($value);

            $main_language_json .= html($value);
        }

        $piecesTR =  Strings::split($translate, '~ \s*~');


        foreach ($piecesTR as $key => $value) {
            $value = Strings::trim($value);
            $value = Strings::lower($value);

            $translate_language_json .=  html_translate($value);
        }

        // echo "<pre>";
        include('explode_view.php');
    }

    if ((isset($_GET['st_trigger'])) && ($_GET['st_trigger'] === 'update')) {

        $editId = sanitize_text_field($_GET['id']);

        $main_language = ($_POST['main_language_json']);

        $comment = ($_POST['comment']);

         $main_language_json = json_encode($main_language, JSON_FORCE_OBJECT);   
         
         
         $translate = ($_POST['translate_language_json']);

         $translate_json = json_encode($translate, JSON_FORCE_OBJECT);

        //  $a = json_decode($b, false, 512, JSON_BIGINT_AS_STRING);
        // echo "<pre>";
        // print_r($a);

       $wpdb->update(
            $stncForm_tableNameMain,
            array(
                'main_language_json' =>  $main_language_json,
                'translate_json' =>  $translate_json,
                'comment' =>  $comment,
            ),
            array('id' =>  $editId)
        );


        wp_redirect('/wp-admin/admin.php?page=helix_explode&st_trigger=edit&id=' .  $editId, 302);
        die;

    }
}
