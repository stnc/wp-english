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

<?php
// https://codepen.io/desandro/pen/YzPMBx

//http://education.test/test-2/ 



// function helix_conjunction_shortcode($atts){
//     $default = array(
//         'value' => '#',
//     );

//     $a = shortcode_atts($default, $atts);

//     return '<a style="color: black;" href="'.$a['value'].'">'.$a['value'].'</a>' ;
// }


// add_shortcode('helix_conjunction', 'helix_conjunction_shortcode');






// function button_html($value, $no)
// {
// return '<div class="mb-2 col-md-2">

//     <span id="demo-default" class="tooltipstered   helixColor'.  $no .'">'.do_shortcode( $value ).' </span>
//     </div>';
// }




/**
 * Output the form.
 *
 * @param      array  $atts   User defined attributes in shortcode tag
 */
function helix_word_shortcode($attr)
{
    global $wpdb;
    $stncForm_tableNameMain = $wpdb->prefix . 'helix_words';

    $attr = shortcode_atts(
        [
            "trlang" => "off",
            "id" => "0",
        ],
        $attr
    );



    $editId = sanitize_text_field($attr['id']);
    $data = $wpdb->get_row($wpdb->prepare("SELECT *  FROM " . $stncForm_tableNameMain . "  WHERE id = %d", $editId));

    $main_language_data =  $data->main_language_json;

// print_r($main_language_data);

    $main_language_decode = json_decode($main_language_data,  false, 512, JSON_BIGINT_AS_STRING);
    $button_html_json = "";



    foreach ($main_language_decode as $key => $value) {
      
        $button_html_json .=  button_html($value, $key);
    }
echo     $button_html_json ;
    ?>
<style>


<?php

add_shortcode( "helix_word",  "helix_word_shortcode");

}