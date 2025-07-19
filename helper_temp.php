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

  }  else if (isset($_GET['page']) && 'editor_explodeH' === $_GET['page']) {
    $onboarding_class = 'helix-header-page';
  }
  
  $classes .= ' ' . $onboarding_class . ' ';;
  return $classes;
}
//https://deluxeblogtips.com/wordpress-admin-body-class/
add_action('admin_body_class',  'helix_admin_body_class');



add_shortcode( 'cta_button', 'salcodes_cta' );

function salcodes_cta( $atts ) {
 $a = shortcode_atts( array(
 'link' => '#',
 'id' => 'salcodes',
 'color' => 'blue',
 'size' => '',
 'label' => 'Button',
 'target' => '_self'
 ), $atts );
 $output = '<p><a href="' . esc_url( $a['link'] ) . '" id="' . esc_attr( $a['id'] ) . '" class="button ' . esc_attr( $a['color'] ) . ' ' . esc_attr( $a['size'] ) . '" target="' . esc_attr($a['target']) . '">' . esc_attr( $a['label'] ) . '</a></p>';
 return $output;
}

/*
 <div class="container 44">
[cta_button]

[helix_wordTL_sc id="94"] 5
<div class="row mb-2">bunun ingilzcesi 6666</div>
[helix_wordML_sc id="94"] 

[cta_button]


</div>
 */