<?php



$stnc_wp_floor_plans_postID = isset($_GET['post']) ? $_GET['post'] : null;//post  id  for edit
$stnc_wp_floor_post_type = get_post_type($stnc_wp_floor_plans_postID);//get type
$stnc_wp_floor_post_type_post = isset($_REQUEST['post_type']) ? $_REQUEST['post_type'] : 'post';//for new

function helix_is_check_shortcode($word)
{
    $firstLetter = substr($word, 0, 1); // İlk karakter
    $lastLetter = substr($word, -1);   // Son karakter
    return $firstLetter . $lastLetter;
}



function button_html($value, $no)
{
    $no++;

    $output = '<p class="symbol"> ' . $value . '</p>';
    $sho = helix_is_check_shortcode($value);
    
    if ($sho == '[]') {
        $output = do_shortcode($value);
    } 

    return ' <div  class="helix-element-item helixColor' . $no . '">
        ' . $output . '
    <p class="number">' . $no . '</p>
    </div>';
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






add_action('init', 'do_output_buffer');
function do_output_buffer() {
        ob_start();
}

include ('register-menus.php');
include ('loader_css_js.php');
// include ('installTable.php');

require_once "helper.php";

include ('pages/homepage/homepage.php');





include ('pages/_kelimator/main_actions.php');
include ('pages/_kelimator/explode_actions.php');








require_once "pages/word_list_data_table/word_list.php";
require_once "pages/about/stncForm-adminMenu_About.php";
// // require_once "pages/update/update_pack.php";



require_once "pages/shortcut-minimal/helix_shortcut.php";




// Load plugin text-domain https://daext.com/blog/how-to-make-a-wordpress-plugin-translatable/
function stnc_wp_floor_initialize_plugin_lang() {
	// Retrieve the directory for the internationalization files
    load_plugin_textdomain('the-stnc-map', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}
add_action( 'plugins_loaded', 'stnc_wp_floor_initialize_plugin_lang' );


/*
// load css into the login page
function mytheme_enqueue_login_style() {
    wp_enqueue_style( 'mytheme-options-style', get_template_directory_uri() . '/css/login.css' ); 
}
add_action( 'login_enqueue_scripts', 'mytheme_enqueue_login_style' );

*/