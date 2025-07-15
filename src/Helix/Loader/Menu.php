<?php


namespace Helix\Loader;

class Menu
{


    public function __construct()
    {
        // add_action('init', array($this, 'registerMenu'));
        add_action('admin_menu', array($this, 'registerMenu'));

    }









    public function registerMenu()
    {

        add_menu_page('HELIX LANGUAGE',__( 'Kelimator', 'helix-lng' ) , 'manage_options', 'helix_homepage', 'helix_admin_homepage','dashicons-networking',67); // top 
        add_submenu_page( "helix_homepage", 'Build',  __( 'Kelimeler', 'helix-lng' ) , 'manage_options', 'helix_word_list', 'helix_wp__render_list_page',null ); //sub 
        add_submenu_page( "helix_homepage", 'Build',  __( 'test page', 'helix-lng' ) , 'manage_options', 'helix_test', 'helix_admin_test_page',null ); //sub 
       //  add_submenu_page( "helix_homepage", 'Build', __( 'Shortcut', 'helix-lng' ), 'manage_options', 'helix_map_shortcut', 'helix_wp__shortcut_page' ,null); //sub 
        add_submenu_page( "helix_homepage", 'Build', __( 'About', 'helix-lng' ), 'manage_options', 'helix_about', 'helix_wp__plans_adminMenu_About_contents',null ); //sub 
        
        
        add_submenu_page( null, 'Build', __( 'fixed map', 'helix-lng' ), 'manage_options', 'helix_map_view', 'helix_wp__adminMenu_helix_map_view',null ); //sub 
       
       //admin.php?page=settings62
        add_submenu_page( null, 'Build', __( 'fixed map', 'helix-lng' ), 'manage_options', 'helix_building_company', 'helix_wp__adminMenu_helix_building_company',null ); //sub 
        add_submenu_page( null, 'Build', __( 'fixed map', 'helix-lng' ), 'manage_options', 'helix_explode', 'helix_wp__adminMenu_explode',null ); //sub 
       
        add_submenu_page( null, 'Build', __( 'fixed map', 'helix-lng' ), 'manage_options', 'helix_map_editor_building', 'helix_wp__adminMenu_helix_map_editor_helix',null ); //sub 
       // add_submenu_page( null, 'Build', __( 'fixed map', 'helix-lng' ), 'manage_options', 'helix_map_update', 'helix_wp__plans_adminMenu_update',null ); //sub 
       
    }
}
