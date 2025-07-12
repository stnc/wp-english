<?php
if (!defined('ABSPATH')) {
    exit;
}


 function getTurkishDate_uaCRM(){
  $locale = 'tr_TR'; // a canonicalized locale
  $format = 'dd-MMMM-YYYY-EEEE'; // ISO format codes, not the typical date ones
  $dt = new DateTime(); // a DateTime object
  $df = new IntlDateFormatter(
      $locale, // string locale
      IntlDateFormatter::NONE, // int date type
      IntlDateFormatter::NONE, // int time type
      'UTC', // string timezone
      IntlDateFormatter::GREGORIAN, // int cal type
      $format // string pattern
    );
  return $df->format($dt); //string 07-Ağustos-2018-Salı
} 


function validate_email_uaCRM($mail) {
  return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $mail)) ? FALSE : TRUE;
}


// used for tracking error messages
function plans_errors_uaCRM(){
    static $wp_error; // Will hold global variable safely
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}


// displays error messages from form submissions
function plans_show_error_messages_uaCRM() {
	if($codes = stncForm_errors()->get_error_codes()) {
		echo '<div class="stncForm_errors">';
		    // Loop error codes and display errors
		   foreach($codes as $code){
		        $message = stncForm_errors()->get_error_message($code);
		        echo '<span class="error"><strong>' . __('Hata') . '</strong>: ' . $message . '</span><br/>';
		    }
		echo '</div>';
		
	}	
}


/**
 * Helper array shuffle
 * @param array $list The request sent from WP REST API.
 * @return array random array list
 */
function plans_shuffle_assoc_uaCRM($list)
{
    if (!is_array($list)) {
        return $list;
    }

    $keys = array_keys($list);
    shuffle($keys);
    $random = array();
    foreach ($keys as $key) {
        $random[$key] = $list[$key];
    }
    return $random;
}

/**-********************-********************-********************-********************-********************-********************-******************
                                                                        Extra Optioons
**-********************-********************-********************-********************-********************-********************-********************-******************/



add_filter('manage_staff_posts_columns', 'CHfw_add_img_column');
add_filter('manage_staff_posts_custom_column', 'CHfw_manage_img_column', 10, 2);

if (isset( $_GET['page'] ) && 'stnc_map_homepage' === $_GET['page'] ){
  admin_notices_uaCRM();
} else if (isset( $_GET['page'] ) && 'stnc_map_view' === $_GET['page']){
  admin_notices_uaCRM();
}else if (isset( $_GET['page'] ) && 'stnc_building_company' === $_GET['page']){
  admin_notices_uaCRM();
}

function admin_body_class_uaCRM( $classes = '' ) {
    // $onboarding_class = isset( $_GET['page'] ) && 'stnc_map_homepage' === $_GET['page'] ? 'stnc-header-page' : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    // $classes .= ' ' . $onboarding_class . ' ';
$onboarding_class='';
    if (isset( $_GET['page'] ) && 'stnc_map_homepage' === $_GET['page']){
      $onboarding_class ='stnc-header-page'; 
    } else if (isset( $_GET['page'] ) && 'stnc_map_view' === $_GET['page']){
      $onboarding_class ='stnc-header-page'; 
    } else if (isset( $_GET['page'] ) && 'stnc_building_company' === $_GET['page']){
      $onboarding_class ='stnc-header-page'; 
    }
    else if (isset( $_GET['page'] ) && 'stnc_map_editor_building' === $_GET['page']){
      $onboarding_class ='stnc-header-page'; 
    }
  $classes .= ' ' . $onboarding_class . ' ';;
  return $classes ;
}
//https://deluxeblogtips.com/wordpress-admin-body-class/
add_action( 'admin_body_class',  'admin_body_class_uaCRM' );

function admin_notices_uaCRM(){
  add_action('admin_notices', function () {
  echo 'My notice';
});


function hide_notices_to_all_but_super_admin_uaCRM(){
    remove_all_actions( 'user_admin_notices' );
    remove_all_actions( 'admin_notices' );
 }
 add_action('in_admin_header', 'hide_notices_to_all_but_super_admin_uaCRM', 99);
}



// TODo: bakilacak 
// TODo: bakilacak 
// TODo: bakilacak 
// TODo: bakilacak 

// /* image size https://wpshout.com/wordpress-custom-image-sizes/*/
// if (function_exists('add_image_size')) {
//     add_image_size('stnc_wp_kiosk_size', 1815, 2550, false);
// }

// /*
// add custom_colum
// @use http://bit.ly/2zKE0k4
// */


//TODO: bunun daha gelismis versiyonu core icersinde bakilabilir 
add_filter('manage_branch_posts_columns', 'ua_add_img_column');
add_filter('manage_branch_posts_custom_column', 'ua_manage_img_column', 10, 2);


function ua_add_img_column($columns)
{
    $columns['img'] = 'Featured Image';
    return $columns;
}

function ua_manage_img_column($column_name, $post_id)
{
    if ($column_name == 'img') {
        echo get_the_post_thumbnail($post_id, 'thumbnail');
    }


    

    return $column_name;
}