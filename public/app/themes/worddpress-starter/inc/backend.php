<?php

// Disable Custom Fields Editing on a Live Site
if(WP_ENV !== 'development'):
	add_filter('acf/settings/show_admin', '__return_false');


  function remove_welcome_panel() {
      remove_action( 'welcome_panel', 'wp_welcome_panel' );
  }

  //Run above function on admin_init
  add_action( 'admin_init', 'remove_welcome_panel' );

  function remove_dashboard_meta() {
          remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
          remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
          remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
          remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
          remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
          remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
          remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
          remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
          remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
          remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
          remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal');

  }
  add_action( 'admin_init', 'remove_dashboard_meta' );

  function dm_remove_admin_menus() {

    //  $return = $_SERVER['QUERY_STRING'] ? $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['QUERY_STRING'] : $_SERVER['SCRIPT_NAME'];
    //  remove_submenu_page( 'themes.php', 'customize.php?return=' . urlencode($return) );
      remove_submenu_page( 'themes.php', 'themes.php' );

      remove_submenu_page( 'options-general.php', 'options-discussion.php' );
      remove_submenu_page( 'options-general.php', 'options-reading.php' );
      remove_submenu_page( 'options-general.php', 'options-media.php' );
      remove_submenu_page( 'options-general.php', 'options-permalink.php' );
      remove_submenu_page( 'options-general.php', 'options-writing.php' );
      remove_submenu_page( 'options-general.php', 'options-general.php' );
      remove_submenu_page( 'options-general.php', 'options-privacy.php' );

      remove_menu_page( 'edit-comments.php' );
      remove_menu_page( 'options-general.php' );
      remove_menu_page( 'plugins.php' );
      remove_menu_page( 'tools.php' );

  }
  add_action('admin_menu', 'dm_remove_admin_menus' ,999);

  /* comments */
  // Removes from post and pages
  add_action('init', 'remove_comment_support', 100);

  function remove_comment_support() {
      remove_post_type_support( 'post', 'comments' );
      remove_post_type_support( 'page', 'comments' );
  }


  // Removes from admin bar

  function dm_admin_bar_remove() {
      global $wp_admin_bar;
      $wp_admin_bar->remove_menu( 'wp-logo' );
      $wp_admin_bar->remove_menu('comments');
  }
  add_action( 'wp_before_admin_bar_render', 'dm_admin_bar_remove', 0 );


endif;




add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
 if (!current_user_can('administrator') && !is_admin()) {
     show_admin_bar(false);
 }
}
