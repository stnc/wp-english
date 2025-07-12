<?php
/*
Plugin Name:  Kelimator 3
Plugin URI:	https://github.com/stnc/wp-kat-planlari		
Description: Kelimator ; kelime islemci 
Version: 0.60
Author: Selman TUNC
Text Domain: the-stnc-map
Domain Path: /languages/
*/

require_once __DIR__ . '/vendor/autoload.php'; // Autoload files using Composer autoload


// use Helix\Loader\Menu as LoadMenu; // new LoadMenu();
use Helix\Loader\Loading;
new Loading();


/*
use Helix\Api\Wordpress\WpMenu;
use Helix\Api\General\GeneralData;
use Helix\Api\Wordpress\Widget\Widgets;
use Helix\Api\Wordpress\Posts\Posts;
new Widgets();
new Posts();
new GeneralData();
new WpMenu();
*/