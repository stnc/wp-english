<?php 
function app_output_buffer() {
  ob_start();
} // soi_output_buffer
add_action('init', 'app_output_buffer');


function helix_default_setting(){
    $version = '1.0.5';
    $helix_plugin_path= trailingslashit(plugin_dir_path(__FILE__));
    $helix_plugin_url= trailingslashit(plugins_url( __FILE__));
    $helix_plugin_dir_url= trailingslashit(plugin_dir_url( __FILE__));

     return  array( 
       "version" =>  $version,
       "helixPluginPath" =>  $helix_plugin_path, 
      "helixPluginUrl" =>   $helix_plugin_url,
      "helixPluginDirUrl" => $helix_plugin_dir_url,
     );
}


function helix_admin_body_class($classes = '')
{
  // $onboarding_class = isset( $_GET['page'] ) && 'helix_homepage' === $_GET['page'] ? 'helix-header-page' : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
  // $classes .= ' ' . $onboarding_class . ' ';
  $onboarding_class = '';
  if (isset($_GET['page']) && 'helix_homepage' === $_GET['page']) {
    $onboarding_class = 'helix-header-page';
  
  } else if (isset($_GET['page']) && 'editorH' === $_GET['page']) {
    $onboarding_class = 'helix-header-page';

  }  else if (isset($_GET['page']) && 'editorH_explode' === $_GET['page']) {
    $onboarding_class = 'helix-header-page';
  }
  
  $classes .= ' ' . $onboarding_class . ' ';;
  return $classes;
}
//https://deluxeblogtips.com/wordpress-admin-body-class/
add_action('admin_body_class',  'helix_admin_body_class');
