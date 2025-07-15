<?php
/*
Plugin Name:  Helix Learning
Plugin URI:	https://github.com/helix/hlearn	
Description: language learning system
Version: 1.5.5
Author: helix team 
Text Domain: helix_lng
Domain Path: /languages/
*/

require_once __DIR__ . '/vendor/autoload.php'; // Autoload files using Composer autoload

require_once ('helper_temp.php');



// use Helix\Loader\Menu as LoadMenu; // new LoadMenu();
use Helix\Loader\Loading;
new Loading();


include ('pages/homepage/homepage.php');
include ('pages/_kelimator/main_actions.php');
include ('pages/_kelimator/explode_actions.php');
require_once "pages/word_list_data_table/word_list.php";
require_once "pages/about/helixForm-adminMenu_About.php";
require_once "test.php";


//TODO: database install 
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