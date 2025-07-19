<?php


namespace Helix\Loader;

use Helix\Loader\Menu;
use Helix\Loader\Assets\Admin;
use Helix\Loader\Assets\Frontend;

use Helix\Api\Wordpress\WpMenu;
use Helix\Api\General\CategoriesAndDepencyPost;
use Helix\Api\General\GeneralData;
use Helix\Api\Wordpress\Widget\Widgets;
use Helix\Api\Wordpress\Pages\Pages;
use Helix\Api\Wordpress\Posts\Posts;

class I18n
{

    public function __construct()
    {
        add_action('plugins_loaded', array($this, 'loadLanguage'));
    }



    public function loadLanguage()
    {
        // echo dirname( plugin_basename( __FILE__ ) ) . '/../../languages';
        // die;
        // Retrieve the directory for the internationalization files
        load_plugin_textdomain('helix-lng', false, dirname(plugin_basename(__FILE__)) . '/../../languages');
    }

}
