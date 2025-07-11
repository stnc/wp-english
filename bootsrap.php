<?php
/*
Plugin Name:  Kelimator 2
Plugin URI:	https://github.com/stnc/wp-kat-planlari		
Description: Kelimator ; kelime islemci 
Version: 0.58
Author: Selman TUNC
Text Domain: the-stnc-map
Domain Path: /languages/


*/



// if (file_exists(__DIR__.'/../../vendor/autoload.php')) {
//     require __DIR__.'/../../vendor/autoload.php';
// } else {
//     echo "<h1>Lütfen composer.json ı yükleyin </h1>";
//     echo "<p>Örnekler <a href='https://getcomposer.org/doc/00-intro.md#globally'>https://getcomposer.org/doc/00-intro.md#globally</a></p>";
//     echo "<p> terminal yada cmd yi açarak  'composer install' yazınız</p>";
//     echo "<p> eğer yuklü ise terminal yada cmd yi açarak  'composer update' yazınız</p>";
//     exit();
// }



// if (! is_readable('vendor/stnc/framework/src/Core/Config.php')) {
//     die('config.php bulunamadı, config.example.php dosyasının ismini değiştirip config.php yapınız ve  app/core. içine atınız ');
// }




 require_once __DIR__ . '/vendor/autoload.php'; // Autoload files using Composer autoload


// use Nette\Utils\Arrays;


//   use HelloWorld\SayHello;
//  echo SayHello::world();


use Loader\Loading;
use Api\Menus\Menus;
$load = new Loading();
echo $load->database();

$m = new Menum();
$m->get_registered_menus();
