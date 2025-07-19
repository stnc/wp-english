<?php

/*
<script>
    //https://jsfiddle.net/5p8k4vno/
function copyData(containerid) {
  var range = document.createRange();
  range.selectNode(containerid); //changed here
  window.getSelection().removeAllRanges(); 
  window.getSelection().addRange(range); 
  document.execCommand("copy");
  window.getSelection().removeAllRanges();
}

</script>

*/


// https://codepen.io/desandro/pen/YzPMBx

//http://education.test/test-2/ 

use Helix\Lib\EditorExplodeLib;





add_shortcode("helix_wordTL_sc", "helix_word_translate_shortcode");

/**
 * Output the form.
 *
 * @param      array  $atts   User defined attributes in shortcode tag
 */
function helix_word_translate_shortcode($attr)
{
    // ob_start(); 
    global $wpdb;

    $lib = new EditorExplodeLib();
    $helixForm_tableNameMain = $wpdb->prefix . 'helix_words';

    $attr = shortcode_atts(
        [
            "trlang" => "off",
            "id" => "0",
        ],
        $attr
    );

    $editId = sanitize_text_field($attr['id']);
    $data = $wpdb->get_row($wpdb->prepare("SELECT translate_json, id  FROM " . $helixForm_tableNameMain . "  WHERE id = %d", $editId));

    $translate_json = $data->translate_json;

    $main_language_decode = json_decode($translate_json, false, 512, JSON_BIGINT_AS_STRING);
    $button_html_json = '<div class="row">';
    foreach ($main_language_decode as $key => $value) {
        $button_html_json .= $lib->helix_button_html_bootsrap($value, $key);
    }
    $button_html_json .= '</div>';
    return $button_html_json;
    ?>



    <?php



}


add_shortcode("helix_wordML_sc", "helix_word_main_language_shortcode");

/**
 * Output the form.
 *
 * @param      array  $atts   User defined attributes in shortcode tag
 */
function helix_word_main_language_shortcode($attr)
{
    global $wpdb;
    $lib = new EditorExplodeLib();
    $helixForm_tableNameMain = $wpdb->prefix . 'helix_words';

    $attr = shortcode_atts(
        [
            "trlang" => "off",
            "id" => "0",
        ],
        $attr
    );



    $editId = sanitize_text_field($attr['id']);
    $data = $wpdb->get_row($wpdb->prepare("SELECT main_language_json , id   FROM " . $helixForm_tableNameMain . "  WHERE id = %d", $editId));

    $main_language_data = $data->main_language_json;

    //  print_r($main_language_data);

    $main_language_decode = json_decode($main_language_data, false, 512, JSON_BIGINT_AS_STRING);
    $button_html_json = '<div class="row">';

    foreach ($main_language_decode as $key => $value) {
        $button_html_json .= $lib->helix_button_html_bootsrap($value, $key);
    }
    $button_html_json .= '</div>';
    return $button_html_json;
}


function helix_conjunction_shortcode($atts)
{
    $default = array(
        'value' => '#',
    );

    $a = shortcode_atts($default, $atts);

    return '
    <h3 class="name">conjunction</h3>
    <p class="symbol"> <a style="color: black;" href="' . $a['value'] . '">' . $a['value'] . '</a></p>
';
}

add_shortcode('helix_conjunction_sc', 'helix_conjunction_shortcode');





