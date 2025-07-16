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
  
  } else if (isset($_GET['page']) && 'helix_language_editor' === $_GET['page']) {
    $onboarding_class = 'helix-header-page';
  }  else if (isset($_GET['page']) && 'helix_language_editor' === $_GET['page']) {
    $onboarding_class = 'helix-header-page';
  
  }else if (isset($_GET['page']) && 'helix_explode' === $_GET['page']) {
    $onboarding_class = 'helix-header-page';
  }
  $classes .= ' ' . $onboarding_class . ' ';;
  return $classes;
}
//https://deluxeblogtips.com/wordpress-admin-body-class/
add_action('admin_body_class',  'helix_admin_body_class');

function helix_is_check_shortcode($word)
{
    $firstLetter = substr($word, 0, 1); // İlk karakter
    $lastLetter = substr($word, -1);   // Son karakter
    return $firstLetter . $lastLetter;
}



function button_html($value, $no)
{
    $no++;

    $output = '<p class="symbol"> ' . $value . '</p>';
    $sho = helix_is_check_shortcode($value);
    
    if ($sho == '[]') {
        $output = do_shortcode($value);
    } 

    return ' <div  class="helix-element-item helixColor' . $no . '">
        ' . $output . '
    <p class="number">' . $no . '</p>
    </div>';
}



    function helix_conjunction_shortcode($atts)
    {
        $default = array(
            'value' => '#',
        );
    
        $a = shortcode_atts($default, $atts);
    
        return '
         <h3 class="name">conjunction</h3>
       <p class="symbol"> <a style="color: black;" href="' . $a['value'] . '">' . $a['value'] . '</a></p>
       
       
       ';
    }
    
    
    add_shortcode('helix_conjunction_sc', 'helix_conjunction_shortcode');