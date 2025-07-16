<?php


namespace Helix\Loader\Assets;

class Admin
{


    public function __construct()
    {
        if (isset($_GET["page"]) && $_GET["page"] === "helix_admin_homepage") {
            $this->helix_admin_scritps();
        }
       if (isset($_GET["page"]) && $_GET["page"] === "helix_test") {
            $this->helix_admin_scritps();
        }

        if (isset($_GET["page"]) && $_GET["page"] === "helix_language_editor") {
      
            $this->helix_admin_scritps();
        }


        if (isset($_GET["page"]) && $_GET["page"] === "helix_language_editor_explode") {
            $this->helix_admin_scritps();
        }






    }


    public function helix_main_enqueue_style()
    {
        wp_enqueue_style("helix-admin-css", HELIX_PLUGIN_DIR_URL ."assets/admin/css/helix-admin.css", "", HELIX_VERSION);
        wp_enqueue_style("helix-bootstrap-css", HELIX_PLUGIN_DIR_URL ."assets/admin/css/bootstrap.min.css", "", HELIX_VERSION);
        wp_enqueue_style("helix-common2-css", HELIX_PLUGIN_DIR_URL ."assets/common/css/helix.css", "", HELIX_VERSION);


        //  wp_enqueue_style( "helix-tooltipstercss", HELIX_PLUGIN_DIR_URL ."assets/admin/css/tooltipster.bundle.min.css" ,"",HELIX_VERSION);
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
