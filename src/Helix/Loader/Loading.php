<?php


namespace Helix\Loader;

use \Loader\Api\Menus\Menus;
// use WPRAH\API\Pages\Pages;
// use WPRAH\API\Posts\Posts;
// use WPRAH\API\General\General;
// use WPRAH\API\Widgets\Widgets;

class Loading
{

    /**
     * @var string
     */
    public $name = 'Easy Digital Downloads';



        /**
    * Define Plugin Constants
    * @since 2.0.0
    */
    public function plugin_constants() {
        define( 'WPRAH_VERSION', self::version );
        define( 'WPRAH_PLUGIN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
        define( 'WPRAH_PLUGIN_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );
    }

  /**
     * @param int $payment_id The ID of the payment
     *
     * @return bool|string
     */
    public  function __construct()
    {
        add_action('init', array($this, 'registerMenu'));
         add_action( 'plugins_loaded',array($this,  'loadLanguage' ));
        
        
    }

    
    public  function database()
    {
        // add_action('init', array($this, 'MainMenu'));

        
    }
    public  function api()
    {
        new Posts();
        new Pages();
        new Menus();
        new Widgets();
        new General();

        
    }


    function loadLanguage() {
        // echo dirname( plugin_basename( __FILE__ ) ) . '/../../languages';
        // die;
        // Retrieve the directory for the internationalization files
        load_plugin_textdomain( 'helix-lng', false, dirname( plugin_basename( __FILE__ ) ) . '/../../languages' );
    }





    /**
     * Throws an unauthorized exception.
     *
     * @param  string|null  $message
     * @param  mixed|null  $code
     * @return \Illuminate\Auth\Access\Response
     */
    // protected function deny($message = null, $code = null)
    // {
    //     return Response::deny($message, $code);
    // }




    public function registerMenu()
    {


        add_menu_page('Helix English', __('Kelimator', 'helix-lng'), 'manage_options', 'stnc_map_homepage', 'stnc_wp_floor_adminMenu_stnc_map_homepage', 'dashicons-networking', 67); //main menu 
        add_submenu_page("stnc_map_homepage", 'Build', __('Word List', 'helix-lng'), 'manage_options', 'stnc_building_list', 'stnc_wp_floor_render_list_page', null); 
        add_submenu_page("stnc_map_homepage", 'Build', __('About', 'helix-lng'), 'manage_options', 'stnc_map_about', 'stnc_wp_floor_plans_adminMenu_About_contents', null); //submenu


        add_submenu_page(null, 'Build', __('temporary', 'helix-lng'), 'manage_options', 'stnc_map_view', 'stnc_wp_floor_adminMenu_stnc_map_view', null);  //submenu

        //admin.php?page=settings62
        add_submenu_page(null, 'Build', __('temporary', 'helix-lng'), 'manage_options', 'stnc_building_company', 'stnc_wp_floor_adminMenu_stnc_building_company', null);  //submenu
        add_submenu_page(null, 'Build', __('temporary', 'helix-lng'), 'manage_options', 'helix_explode', 'stnc_wp_floor_adminMenu_explode', null);  //submenu

        add_submenu_page(null, 'Build', __('temporary', 'helix-lng'), 'manage_options', 'stnc_map_editor_building', 'stnc_wp_floor_adminMenu_stnc_map_editor_stnc', null); //edit 
        add_submenu_page(null, 'Build', __('temporary', 'helix-lng'), 'manage_options', 'stnc_map_update', 'stnc_wp_floor_plans_adminMenu_update', null); //edit



    }
}
