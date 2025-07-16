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


include ('view/homepage/homepage.php');
include ('pages/_kelimator/helix_language_editor_page.php');
include ('pages/_kelimator/helix_language_editor_explode_page.php');
require_once "view/DattaTaable/db_list.php";
require_once "view/about/helixForm-adminMenu_About.php";
require_once "oop.php";
require_once "shortcut/helix_shortcut.php";

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