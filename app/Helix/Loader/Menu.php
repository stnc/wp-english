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
        add_submenu_page( "helix_homepage", 'Build',  __( 'Kelimeler', 'helix-lng' ) , 'manage_options', 'helix_word_list', 'helix_DataTABLE_page',null ); // list page 
        add_submenu_page( "helix_homepage", 'Build',  __( 'Test page', 'helix-lng' ) , 'manage_options', 'helix_test', 'helix_admin_test_page',null ); // test 

        add_submenu_page( "helix_homepage", 'Build', __( 'About', 'helix-lng' ), 'manage_options', 'helix_about', 'helix_about_page',null );//  -- ABOUT 
        
        
   

        add_submenu_page( null, 'Build', __( 'fixed map', 'helix-lng' ), 'manage_options', 'helix_language_editor', 'helix_language_editor_page',null ); //sub 
        add_submenu_page( null, 'Build', __( 'fixed map', 'helix-lng' ), 'manage_options', 'helix_language_editor_explode', 'helix_language_editor_explode_page',null ); //sub 
       
       
    }
}
