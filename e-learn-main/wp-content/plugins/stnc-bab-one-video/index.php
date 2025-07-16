<?php
/*
Plugin Name:NEW STNC ENGLISH
Plugin URI:			
Description: video 
Version: 1.11.97
Author: Chrom Themes
Text Domain: chrom_video
Domain Path: /languages/





*/ 
include ('render.php');
include ('widget.php');

require_once 'codestar-framework/codestar-framework.php';
// require_once 'admin/inc/metabox-free.php';
// require_once 'admin/inc/import-meta.php';
require_once 'admin/inc/options.php';

function StncBabOneEng_admin_menu()
{
    add_submenu_page(
        'edit.php?post_type=stnc-babone-eng',
        __( 'About', 'menu-test' ),
        __( 'About', 'menu-test' ),
        'manage_options',
        'testsettings',
        'StncBabOneEng_About'
    );


}

add_action('admin_menu', 'StncBabOneEng_admin_menu');


function StncBabOneEng_About(){

    

    echo "hello";
}


add_action('pre_post_update', 'StncBabOneEng_post_updating_callback');
function StncBabOneEng_post_updating_callback($post_id)
{
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($post->post_status)){
        if ($post->post_status == "publish" && $post->post_type == "video") {
            $display_before_title_read = get_the_title($post_id);
            update_post_meta($post_id, 'wow_BeforeTitle', $display_before_title_read);

        }
    }

}




/*video image size */
if (function_exists('add_image_size')) {
    add_image_size('stnc-babOneTranslatePostSize', 320, 320, false);
}


/*video pagination fix*/
$scFW_videoLimit_posts = isset($StncBabOneEng_rdx_options['video_limit_posts']) ? $StncBabOneEng_rdx_options['video_limit_posts'] : 5;

function StncBabOneEng_mp_video_posts_per_page($query)
{
    global $scFW_videoLimit_posts;
    if (isset($query->query_vars['post_type'])) {
        if ($query->query_vars['post_type'] == 'stnc-babone-eng') {
            $query->query_vars['posts_per_page'] = $scFW_videoLimit_posts;
        }
    }

    return $query;
}

if (!is_admin()) {
    add_filter('pre_get_posts', 'StncBabOneEng_mp_video_posts_per_page');
}





add_filter('manage_video_posts_columns', 'StncBabOneEng_add_img_column');
add_filter('manage_video_posts_custom_column', 'StncBabOneEng_manage_img_column', 10, 2);

/*
add custom_colum
@use http://bit.ly/2zKE0k4
*/
function StncBabOneEng_add_img_column($columns)
{
    $columns['img'] = 'Featured Image';
    return $columns;
}

function StncBabOneEng_manage_img_column($column_name, $post_id)
{
    if ($column_name == 'img') {
        echo get_the_post_thumbnail($post_id, 'thumbnail');
    }

    return $column_name;
}


// /*------------------UPDATE video---------------------*/

// //add_action( 'publish_video', 'video_schedule_video_expiration_event_insert' );
// function StncBabOneEng_video_schedule_video_expiration_event_insert($post_id)
// {
//     // Schedule the actual event
//     //wp_schedule_single_event( 30 * DAY_IN_SECONDS, 'updateCategories_video_after_expiration_V1', array( $post_id ) );//insert
//     StncBabOneEng_updateCategories_video_after_expiration($post_id);
//     write_log("run");

// }


// add_action('StncBabOneEng_updateCategories_video_after_expiration', 'StncBabOneEng_updateCategories_video_after_expiration', 10, 1);
// // This function will run once the 'addCategories_video_after_expiration' is called


// function StncBabOneEng_updateCategories_video_after_expiration($post_id)
// {

//     global $wpdb;


//     if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
//         return;
//     }

//     if (wp_is_post_autosave($post_id)) {
//         return;
//     }

//     // Check if not a revision.
//     if (wp_is_post_revision($post_id)) {
//         return;
//     }


//     $post_title = get_the_title($post_id);

//     $display_before_title = get_post_meta($post_id, 'wow_BeforeTitle');

//     if (count($display_before_title) > 0) {
//         $display_before_title = $display_before_title[0];
//     } else {
//         $display_before_title = null;
//     }

// }


// //  runs when a Post is update
// add_action('publish_video', 'StncBabOneEng_video_schedule_video_expiration_event_update');
// function StncBabOneEng_video_schedule_video_expiration_event_update($post_id)
// {
//     // Schedule the actual event
//     //updateCategories_video_after_expiration( $post_id );
//     wp_schedule_single_event(strtotime("+2 seconds"), 'StncBabOneEng_updateCategories_video_after_expiration', array($post_id));
// }



// add_action('pre_delete_term', 'StncBabOneEng_prevent_terms_delete', 1, 2);
// function StncBabOneEng_prevent_terms_delete($term, $taxonomy)
// {
//     global $wpdb;
//     if (!current_user_can('manage_network')) {
//         $table = $wpdb->prefix . 'options';
//         $wpdb->delete($table, array('option_name' => 'booked_defaults_' . $term));
//     }
// }