<?php
define('CHfw_video_PATH', plugin_dir_path(__FILE__) . 'includes/');

// Load plugin text-domain

$locale = apply_filters('plugin_locale', get_locale(), 'CHfw-video');

load_textdomain('CHfw-video', WP_LANG_DIR . 'CHfw-video/CHfw-video-' . $locale . '.mo');
load_plugin_textdomain('CHfw-video', false, plugin_basename(dirname(__FILE__)) . '/languages');


function CHfw_register_post_type_video()
{
    $singular = 'video';
    $plural = __('video', 'CHfw-video');
    $slug = str_replace(' ', '_', strtolower($singular));
    $labels = array(
        'name' => $plural,
        'singular_name' => $singular,
        'add_new' => __('Add New', 'CHfw-video'),
        'add_new_item' => __('Add New video ', 'CHfw-video'),
        'edit' => __('Edit', 'CHfw-video'),
        'edit_item' => __('Edit video ', 'CHfw-video'),
        'new_item' => __('New video ', 'CHfw-video'),
        'view' => __('View video ', 'CHfw-video'),
        'view_item' => __('View video ', 'CHfw-video'),
        'search_term' => __('Search video ', 'CHfw-video'),
        'parent' => __('Parent video ', 'CHfw-video'),
        'not_found' => 'No video  found',
        'not_found_in_trash' => 'No video in Trash',

    );
    $args = array(
        'label' => 'STNC VIDEO',
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 10,
        'menu_icon' => 'dashicons-businessman',
        'can_export' => true,
        'delete_with_user' => false,
        'hierarchical' => true,
        'show_in_nav_menus' => false,
        'has_archive' => true,
        'query_var' => true,
        'map_meta_cap' => true,
        'rewrite' => array(
            'slug' => 'video',
        ),

        'supports' => array(
            'title',
            'excerpt',
            'editor',
            'thumbnail',
        )
    );

    register_post_type($slug, $args);

}

add_action('init', 'CHfw_register_post_type_video');


require(CHfw_video_PATH . "class-video-member.php");


$CHfw_video_ch_postID = isset($_GET['post']) ? $_GET['post'] : null;//post  id  for edit

$CHfw_video_post_type_ch = get_post_type($CHfw_video_ch_postID);//get type

$CHfw_video_post_type_post = isset($_REQUEST['post_type']) ? $_REQUEST['post_type'] : 'post';//for new

if ($CHfw_video_post_type_post == 'video' or $CHfw_video_post_type_ch == 'video') {
    if (is_admin()) {
        add_action('load-post.php', 'CHfw_video_init_metabox');
        add_action('load-post-new.php', 'CHfw_video_init_metabox');
    }
}

/*
 * video Categories Support add 09-09-2017
 * */
function CHfw_create_Categories_taxonomies()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => __('Categories', 'CHfw-video'),
        'singular_name' => __('Categories', 'CHfw-video'),
        'add_new_item' => __('Add New Categories ', 'CHfw-video'),
        'search_items' => __('Search Categories', 'CHfw-video'),
        'popular_items' => __('Popular Categories', 'CHfw-video'),
        'all_items' => __('All Categories', 'CHfw-video'),
        'parent_item' => __('Parent Categories', 'CHfw-video'),
        'parent_item_colon' => __('Parent Categories:', 'CHfw-video'),
        'edit_item' => __('Edit Categories', 'CHfw-video'),
        'update_item' => __('Update Categories', 'CHfw-video'),

        'new_item_name' => __('New Categories Name', 'CHfw-video'),
    );
    register_taxonomy('video_cat', array('video'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,

        'rewrite' => array('slug' => 'video_cat'),
    ));
}

add_action('init', 'CHfw_create_Categories_taxonomies', 0);



/*------------------UPDATE video---------------------*/

//add_action( 'publish_video', 'video_schedule_video_expiration_event_insert' );
function CHfw_video_schedule_video_expiration_event_insert($post_id)
{
    // Schedule the actual event
    //wp_schedule_single_event( 30 * DAY_IN_SECONDS, 'updateCategories_video_after_expiration_V1', array( $post_id ) );//insert
    CHfw_updateCategories_video_after_expiration($post_id);
    write_log("run");

}


add_action('CHfw_updateCategories_video_after_expiration', 'CHfw_updateCategories_video_after_expiration', 10, 1);
// This function will run once the 'addCategories_video_after_expiration' is called


function CHfw_updateCategories_video_after_expiration($post_id)
{

    global $wpdb;


    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (wp_is_post_autosave($post_id)) {
        return;
    }

    // Check if not a revision.
    if (wp_is_post_revision($post_id)) {
        return;
    }

    $term_cal = term_exists('Auto Draft', 'booked_custom_calendars');
    if ($term_cal !== 0 && $term_cal !== null) {
        wp_delete_term($term_cal['term_id'], 'booked_custom_calendars');
    }


    $post_title = get_the_title($post_id);

    $display_before_title = get_post_meta($post_id, 'wow_BeforeTitle');

    if (count($display_before_title) > 0) {
        $display_before_title = $display_before_title[0];
    } else {
        $display_before_title = null;
    }

        //the purpose of this place looks at If the period has already occurred, if it has occurred does not
    $booked_custom_calendars_term = term_exists($post_title, 'booked_custom_calendars');
    $added_booked_custom_calendars_term = 0;
    if ($booked_custom_calendars_term !== 0 && $booked_custom_calendars_term !== "") {
        $added_booked_custom_calendars_term = isset($booked_custom_calendars_term['term_id']) ? $booked_custom_calendars_term['term_id'] : 0;
    }

        // is the savebefore value where the first insertion also does not occur with wow_befortitle, meaning it has not been added before
    if (empty($display_before_title)) {

        $args = array(
            'description' => "video plugin ; Automatic Value: " . $post_title . "",
            'slug' => $post_title,
        );
        //the purpose of this place is to see if the term is more formed if it is formed does not
        $booked_custom_calendars_term = wp_insert_term($post_title, "booked_custom_calendars", $args);
        $added_booked_custom_calendars_term = isset($booked_custom_calendars_term['term_id']) ? $booked_custom_calendars_term['term_id'] : 0;
    }
    //the event will break here here will make insert, so this place will be the first insert event get
    else {



// if you enter here the title has changed post title is the value of changing the old ($display_before_title) to make the term_exist
        if ($display_before_title != $post_title) {
            //booked_custom_calendars taxonomy change
            $term_control_booked_custom_calendars = term_exists($display_before_title, 'booked_custom_calendars');
            wp_update_term($term_control_booked_custom_calendars['term_id'], 'booked_custom_calendars', array(
                'name' => $post_title,
                'slug' => $post_title
            ));
        }
    }


    $selected_departman_id = CHfw_get_meta($post_id, 'display_doctor_department', 'CHfw_DoctorAndDepartmant_ForSinglevideoPage');
    if ($selected_departman_id != false) {//so I used wp_schedule_single_event() so if the value is not empty,
        $selected_departman_id = (int)$selected_departman_id;
    }


// events is also using the metabase (doctor selected) )
    $previously_added_values = get_post_meta($selected_departman_id, 'CHfw_mpevent_departmentForSingleEventPage');
    $dilimler = explode(",", $previously_added_values[0]);
    array_push($dilimler, $added_booked_custom_calendars_term);
    $previously_added_values = implode(",", $dilimler);
    update_post_meta($selected_departman_id, 'CHfw_mpevent_departmentForSingleEventPage', $previously_added_values);
}


//  runs when a Post is update
add_action('publish_video', 'CHfw_video_schedule_video_expiration_event_update');
function CHfw_video_schedule_video_expiration_event_update($post_id)
{
    // Schedule the actual event
    //updateCategories_video_after_expiration( $post_id );
    wp_schedule_single_event(strtotime("+2 seconds"), 'CHfw_updateCategories_video_after_expiration', array($post_id));
}


add_action('pre_post_update', 'CHfw_post_updating_callback');
function CHfw_post_updating_callback($post_id)
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


add_action('pre_delete_term', 'CHfw_prevent_terms_delete', 1, 2);
function CHfw_prevent_terms_delete($term, $taxonomy)
{
    global $wpdb;
    if (!current_user_can('manage_network')) {
        $table = $wpdb->prefix . 'options';
        $wpdb->delete($table, array('option_name' => 'booked_defaults_' . $term));
    }
}


require("includes/CHfw-video-metabox-options.php");

/*video image size */
if (function_exists('add_image_size')) {
    add_image_size('CHfw-videoPostSize', 320, 320, false);
}


/*video pagination fix*/
$scFW_videoLimit_posts = isset($CHfw_rdx_options['video_limit_posts']) ? $CHfw_rdx_options['video_limit_posts'] : 5;

function CHfw_mp_video_posts_per_page($query)
{
    global $scFW_videoLimit_posts;
    if (isset($query->query_vars['post_type'])) {
        if ($query->query_vars['post_type'] == 'video') {
            $query->query_vars['posts_per_page'] = $scFW_videoLimit_posts;
        }
    }

    return $query;
}

if (!is_admin()) {
    add_filter('pre_get_posts', 'CHfw_mp_video_posts_per_page');
}


// function CHfw_admin_menu()
// {
//     add_submenu_page("edit.php?post_type=video", __("Locations", 'mp-timetable'), __("Locations", 'mp-timetable'), "edit_posts", "edit.php?post_type=locations");//chfw condi
//     add_submenu_page("edit.php?post_type=video", __("Add Locations", 'mp-timetable'), __("Add Locations", 'mp-timetable'), "edit_posts", "post-new.php?post_type=locations");//chfw add treatmens
// }

// add_action('admin_menu', 'CHfw_admin_menu');


add_filter('manage_video_posts_columns', 'CHfw_add_img_column');
add_filter('manage_video_posts_custom_column', 'CHfw_manage_img_column', 10, 2);

/*
add custom_colum
@use http://bit.ly/2zKE0k4
*/
function CHfw_add_img_column($columns)
{
    $columns['img'] = 'Featured Image';
    return $columns;
}

function CHfw_manage_img_column($column_name, $post_id)
{
    if ($column_name == 'img') {
        echo get_the_post_thumbnail($post_id, 'thumbnail');
    }

    return $column_name;
}


