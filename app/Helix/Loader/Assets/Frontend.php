<?php


namespace Helix\Loader\Assets;

class Frontend
{


    public function __construct()
    {
        add_action("wp_enqueue_scripts", array($this, 'helix_frontend'));
    }

    public function helix_frontend()
    {
        wp_enqueue_style("helix-common-css", HELIX_PLUGIN_DIR_URL ."assets/common/css/helix.css", "", HELIX_VERSION);
        // wp_enqueue_style("load-fa", "https://use.fontawesome.com/releases/v5.5.0/css/all.css");
    }

}