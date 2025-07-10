<?php
namespace Loader;
class Loading
{



    public  function load()
    {
        add_action('init', array($this, 'MainMenu'));

        
    }

    // public function registerPostType() {
    //     register_post_type($this->postType, $this->args);
    // }

    public function MainMenu()
    {


        add_menu_page('STNC Building', __('Kelimator', 'the-stnc-map'), 'manage_options', 'stnc_map_homepage', 'stnc_wp_floor_adminMenu_stnc_map_homepage', 'dashicons-networking', 67); ////burası main menuyu ekler yani üst ksıım 
        add_submenu_page("stnc_map_homepage", 'Build', __('Kelimeler', 'the-stnc-map'), 'manage_options', 'stnc_building_list', 'stnc_wp_floor_render_list_page', null); ////burası alt kısım onun altında olacak olan bolum için 
        //  add_submenu_page( "stnc_map_homepage", 'Build', __( 'Shortcut', 'the-stnc-map' ), 'manage_options', 'stnc_map_shortcut', 'stnc_wp_floor_shortcut_page' ,null); ////burası alt kısım onun altında olacak olan bolum için 
        add_submenu_page("stnc_map_homepage", 'Build', __('About', 'the-stnc-map'), 'manage_options', 'stnc_map_about', 'stnc_wp_floor_plans_adminMenu_About_contents', null); ////burası alt kısım onun altında olacak olan bolum için 


        add_submenu_page(null, 'Build', __('fixed map', 'the-stnc-map'), 'manage_options', 'stnc_map_view', 'stnc_wp_floor_adminMenu_stnc_map_view', null); ////burası alt kısım onun altında olacak olan bolum için 

        //admin.php?page=settings62
        add_submenu_page(null, 'Build', __('fixed map', 'the-stnc-map'), 'manage_options', 'stnc_building_company', 'stnc_wp_floor_adminMenu_stnc_building_company', null); ////burası alt kısım onun altında olacak olan bolum için 
        add_submenu_page(null, 'Build', __('fixed map', 'the-stnc-map'), 'manage_options', 'helix_explode', 'stnc_wp_floor_adminMenu_explode', null); ////burası alt kısım onun altında olacak olan bolum için 

        add_submenu_page(null, 'Build', __('fixed map', 'the-stnc-map'), 'manage_options', 'stnc_map_editor_building', 'stnc_wp_floor_adminMenu_stnc_map_editor_stnc', null); ////binannın Build planı haritası ekleme düzenleme yeri
        add_submenu_page(null, 'Build', __('fixed map', 'the-stnc-map'), 'manage_options', 'stnc_map_update', 'stnc_wp_floor_plans_adminMenu_update', null); ////binannın Build planı haritası ekleme düzenleme yeri



    }
}
