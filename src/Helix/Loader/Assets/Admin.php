<?php


namespace Helix\Loader\Assets;

class Admin
{


    public function __construct()
    {
        if (isset($_GET["page"]) && $_GET["page"] === "helix_homepage") {
            $this->helix_admin_scritps();
        }

        if (isset($_GET["page"]) && $_GET["page"] === "helix_building_company") {
            $this->helix_admin_scritps();
        }


        if (isset($_GET["page"]) && $_GET["page"] === "helix_explode") {
            $this->helix_admin_scritps();
        }

        if (isset($_GET["page"]) && $_GET["page"] === "helix_map_view") {
            // helix_wp_floor_front() ;
            $this->helix_admin_scritps();
        }

        if (isset($_GET["page"]) && $_GET["page"] === "helix_map_editor_building") {
            $this->helix_admin_scritps();
        }



    }


    public function helix_main_enqueue_style()
    {
        wp_enqueue_style("helix-admin-css", HELIX_PLUGIN_DIR_URL ."assets/admin/css/helix-admin.css", "", HELIX_VERSION);
        wp_enqueue_style("helix-common2-css", HELIX_PLUGIN_DIR_URL ."assets/common/css/helix.css", "", HELIX_VERSION);


        // wp_enqueue_style( "helix-tooltipstercss", plugins_url("assets/admin/css/tooltipster.bundle.min.css", __FILE__) ,"",$ver);
    }

    public function helix_script_in_admin($hook)
    {

        wp_register_script("helix-bootstrap", HELIX_PLUGIN_DIR_URL . "assets/admin/js/bootstrap.bundle.min.js", "", HELIX_VERSION, true);
        wp_enqueue_script("helix-bootstrap");

        // wp_register_script( "helix-tooltipster", plugin_dir_url(__FILE__) . "assets/admin/js/tooltipster.bundle.min.js", "",$ver,true);
        // wp_enqueue_script("helix-tooltipster");
        wp_register_script("helix-my", HELIX_PLUGIN_DIR_URL . "assets/admin/js/my.js", ["jquery"], HELIX_VERSION, true);
        wp_enqueue_script("helix-my");
        wp_enqueue_media();
    }




    public function helix_admin_scritps()
    {
        add_action('admin_enqueue_scripts', array($this, 'helix_main_enqueue_style'));
        add_action('admin_enqueue_scripts', array($this, 'helix_script_in_admin'));

    }



}
