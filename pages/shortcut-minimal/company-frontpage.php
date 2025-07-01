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
// uses
// [stnc_building_for_company]




add_shortcode( "helix_word",  "helix_word_shortcode");


/**
 * Output the form.
 *
 * @param      array  $atts   User defined attributes in shortcode tag
 */
function helix_word_shortcode($attr)
{
    global $wpdb;

    $attr = shortcode_atts(
        [
            "trlang" => "off",
            "id" => "0",
        ],
        $attr
    );


    $table = $wpdb->prefix . "helix_words";
    $sql = "SELECT * FROM " . $table . " where id=".  $attr["id"]." ";
    $buildingsList = $wpdb->get_results($sql);


    ?>
<style>



<?php
}