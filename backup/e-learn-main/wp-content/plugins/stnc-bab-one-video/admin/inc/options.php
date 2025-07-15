<?php
  /** Option page */
  $prefix = 'stnc_option';
  
  CSF::createOptions( $prefix, array(
    'framework_title' => esc_html__('selmna Settings', 'h5vp'),
    'menu_title'  => esc_html__('Settings', 'h5vp'),
    'menu_slug'   => 'settings2',
    'menu_type'   => 'submenu',
    'menu_parent' => 'edit.php?post_type=stnc-babone-eng',
    'theme' => 'light',
    'show_bar_menu' => false,
  ) );

    CSF::createSection($prefix, array(
        'title' => 'Shortcode',
        'fields' => array(
            array(
                'id' => 'stnc_gutenberg_enable',
                'type' => 'switcher',
                'title' => esc_html__('Enable Gutenberg shortcode generator', 'h5vp'),
                'default' => true
            ),
            array(
                'id' => 'stnc_disable_video_shortcode',
                'type' => 'switcher',
                'title' => "Disable `[video id='id']` shortcode for this plugin",
                'default' => false
            ),
            array(
              'id' => 'stnc_pause_other_player',
              'type' => 'switcher',
              'title' => esc_html__('Play one player at a time', 'h5vp'),
              'default' => false,
            ),
        )
    ));
