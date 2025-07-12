<?php
namespace Helix\Api\Wordpress;
class Menu {

    /**
    * Construct Function
    * @since 2.0.0
    */
    public function __construct() {
        add_action( 'rest_api_init', [ $this, 'add_endpoint' ] );
    }

    /**
    * Add Custom Endpoint ( Menus )
    * @since 2.0.0
    */
    public function add_endpoint() {
        register_rest_route( 'wp/v2', 'wpmenu', [
            'methods' => 'GET',
            'callback' => [ $this, 'get_general_info' ],
                    'permission_callback' => '__return_true'
        ]);
    }

    /**
    * add_endpoint Callback Function
    * @since 2.0.0
    */
    public function get_general_info() {
        $general = [
            'site_title'    => get_bloginfo('name'),
            'site_tag_line' => get_bloginfo('description'),
            'home_url'      => home_url('/'),
            'ajax_url'      => admin_url('admin-ajax.php'),
            'admin_url'     => get_bloginfo('admin_email'),
            'wp_version'    => get_bloginfo('version'),
            'language'      => get_bloginfo('language'),
            'posts_per_page' => get_option('posts_per_page'),
        ];

        return $general;
    }


}


