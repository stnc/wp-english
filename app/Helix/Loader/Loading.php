<?php


namespace Helix\Loader;

use Helix\Loader\Menu;
use Helix\Loader\I18n;
use Helix\Loader\Assets\Admin;
use Helix\Loader\Assets\Frontend;

use Helix\Api\Wordpress\WpMenu;
use Helix\Api\General\CategoriesAndDepencyPost;
use Helix\Api\General\GeneralData;
use Helix\Api\Wordpress\Widget\Widgets;
use Helix\Api\Wordpress\Pages\Pages;
use Helix\Api\Wordpress\Posts\Posts;

class Loading
{

    /**
     * @var string
     */
    public $name = 'HELIX ENGLISH';

    const class_version = '2.0.2';
    const version = '2.0.2';

    /**
     * Define Plugin Constants
     * @since 2.0.0
     */
    public function plugin_constants()
    {
        // define('HELIX_VERSION', self::version);
        // define('HELIX_PLUGIN_PATH', trailingslashit(plugin_dir_path(__FILE__)));
        // define('HELIX_PLUGIN_URL', trailingslashit(plugins_url( __FILE__)));
        define('HELIX_VERSION', helix_default_setting()["version"]);
        define('HELIX_PLUGIN_PATH', helix_default_setting()["helixPluginPath"]);
        define('HELIX_PLUGIN_URL', helix_default_setting()["helixPluginUrl"]);
        define('HELIX_PLUGIN_DIR_URL', helix_default_setting()["helixPluginDirUrl"]);
        
    }




    /**
     * @param int $payment_id The ID of the payment
     *
     * @return bool|string
     */
    public function __construct()
    {
        $this->plugin_constants();
        new I18n();
        $this->registerMenu();
        $this->registerAssets();
        $this->wpDefaultsApi();
//require_once "helper.php";  // TODO: look at the old version
    }


    public function databaseInstall()
    {

    }

    public function registerMenu()
    {
        new Menu();
    }
    public function registerAssets()
    {
        new Admin();
        new Frontend();
    }



    public function wpDefaultsApi()
    {
        new Widgets();
        new Pages();
        new Posts();
        new CategoriesAndDepencyPost(); //TODO: not working - check it 
        new GeneralData();
        new WpMenu();
    }





}
