<?php
define('StncBabOneEng_video_PATH', plugin_dir_path(__FILE__) . 'includes/');




function StncBabOneEng_register_post_type_video()
{
    $singular = 'stnc-babOne-Eng';
    $plural = __('English Learn', 'stnc-babOneTranslate');
    $slug = str_replace(' ', '_', strtolower($singular));
    $labels = array(
        'name' => $plural,
        'singular_name' => $singular,
        'add_new' => __('Add New', 'stnc-babOneTranslate'),
        'add_new_item' => __('Add New video ', 'stnc-babOneTranslate'),
        'edit' => __('Edit', 'stnc-babOneTranslate'),
        'edit_item' => __('Edit video ', 'stnc-babOneTranslate'),
        'new_item' => __('New video ', 'stnc-babOneTranslate'),
        'view' => __('View video ', 'stnc-babOneTranslate'),
        'view_item' => __('View video ', 'stnc-babOneTranslate'),
        'search_term' => __('Search video ', 'stnc-babOneTranslate'),
        'parent' => __('Parent video ', 'stnc-babOneTranslate'),
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
            'slug' => 'stncbabOneEng',
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

add_action('init', 'StncBabOneEng_register_post_type_video');


require(StncBabOneEng_video_PATH . "engine.php");


$StncBabOneEng_video_ch_postID = isset($_GET['post']) ? $_GET['post'] : null;//post  id  for edit

$StncBabOneEng_video_post_type = get_post_type($StncBabOneEng_video_ch_postID);//get type

$StncBabOneEng_video_post_type_post = isset($_REQUEST['post_type']) ? $_REQUEST['post_type'] : 'post';//for new

// if ($StncBabOneEng_video_post_type_post == 'stnc-babone-eng' or $StncBabOneEng_video_post_type == 'stnc-babone-eng') {
//     if (is_admin()) {
//         add_action('load-post.php', 'StncBabOneEng_video_init_metabox');
//         add_action('load-post-new.php', 'StncBabOneEng_video_init_metabox');
//     }
// }

/*
 * video Categories Support add 09-09-2017
 * */
function StncBabOneEng_create_Categories_taxonomies()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => __('Categories', 'stnc-babOneTranslate'),
        'singular_name' => __('Categories', 'stnc-babOneTranslate'),
        'add_new_item' => __('Add New Categories ', 'stnc-babOneTranslate'),
        'search_items' => __('Search Categories', 'stnc-babOneTranslate'),
        'popular_items' => __('Popular Categories', 'stnc-babOneTranslate'),
        'all_items' => __('All Categories', 'stnc-babOneTranslate'),
        'parent_item' => __('Parent Categories', 'stnc-babOneTranslate'),
        'parent_item_colon' => __('Parent Categories:', 'stnc-babOneTranslate'),
        'edit_item' => __('Edit Categories', 'stnc-babOneTranslate'),
        'update_item' => __('Update Categories', 'stnc-babOneTranslate'),

        'new_item_name' => __('New Categories Name', 'stnc-babOneTranslate'),
    );
    register_taxonomy('stnc_babone_eng_cat', array('stnc-babone-eng'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,

        'rewrite' => array('slug' => 'stnc_babone_eng_cat'),
    ));
}

add_action('init', 'StncBabOneEng_create_Categories_taxonomies', 0);



