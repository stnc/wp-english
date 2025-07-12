<?php


namespace Helix\Loader;

use Helix\Loader\Menu;

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

    const version = '2.0.1';

        /**
    * Define Plugin Constants
    * @since 2.0.0
    */
    public function plugin_constants() {
        define( 'HELIX_VERSION', self::version );
        define( 'HELIX_PLUGIN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
        define( 'HELIX_PLUGIN_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );
    }

  /**
     * @param int $payment_id The ID of the payment
     *
     * @return bool|string
     */
    public  function __construct()
    {
        $this->plugin_constants();
         $this->wpDefaultsApi();
         $this->registerMenu();

    }

    
    public  function databaseInstall()
    {

    }

 
    
    
    public  function registerMenu()
    {
        new Menu();
    }


    
    public  function wpDefaultsApi()
    {
        new Widgets();
        new Pages();
        new Posts();
        new CategoriesAndDepencyPost(); //TODO: not working - check it 
        new GeneralData();
        new WpMenu();
    }



}
