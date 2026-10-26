<?php
namespace App;

use function Env\env;

class Boot
{

  public function __construct() {

    add_action('rest_api_init', array( $this, 'routes' ));
    add_action('phpmailer_init', array( $this,'set_smtp' ));

    // Remove Script Version
  //  add_filter( 'script_loader_src', array( $this,'remove_script_version'), 15, 1 );
  //  add_filter( 'style_loader_src',   array( $this,'remove_script_version'), 15, 1 );


    // all actions related to emojis
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );



    // Turn off oEmbed auto discovery.
    add_filter('embed_oembed_discover', '__return_false' );

    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10 );

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');


    // Remove all embeds rewrite rules.
    //add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
/*
    function remove_wp_block_library() {
      wp_dequeue_style( 'wp-block-library' ); // Wordpress core
    //  wp_dequeue_style( 'wsi_blocks' );
      wp_dequeue_style( 'wp-block-library-theme' ); // Wordpress core
    }
    add_action( 'wp_enqueue_scripts', 'remove_wp_block_library', 100 );
*/


    // Remove WordPress Meta Generator
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'wp_resource_hints', 2);
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
    remove_action('wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
    remove_action('wp_head', 'index_rel_link' ); // index link
    remove_action('wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
    remove_action('wp_head', 'start_post_rel_link', 10, 0 ); // start link
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.


  }


  function disable_emojicons_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
      return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
      return array();
    }
  }


  function disable_wp_emojicons() {

    // all actions related to emojis
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

    // filter to remove TinyMCE emojis
    add_filter( 'tiny_mce_plugins', array( $this,'disable_emojicons_tinymce') );
  }



  /*
  public function api_slug( $slug ) {
      return 'api';
  }
  */

  function set_smtp( $phpmailer ) {
      $phpmailer->isSMTP();
      $phpmailer->Host       = env('SMTP_HOST');
      $phpmailer->SMTPAuth   = env('SMTP_AUTH');
      $phpmailer->Port       = env('SMTP_PORT');
      $phpmailer->SMTPSecure = env('SMTP_SECURE');
      $phpmailer->Username   = env('SMTP_USER');
      $phpmailer->Password   = env('SMTP_PASS');
      $phpmailer->From       = env('SMTP_FROM');
      $phpmailer->FromName   = env('SMTP_NAME');
      $phpmailer->SMTPDebug  = env('SMTP_DEBUG');
      $phpmailer->isHTML(true);
  }

  public function remove_script_version( $src ){
    if( is_admin() || $GLOBALS['pagenow'] === 'wp-login.php') {
      return $src;
    }else{
      $url = str_replace( site_url().'', '', $src );
      $parts = explode( '?ver', $url );
      return $parts[0];
    }
  }

  public function routes(){

    $api = __DIR__ . '/../routes/api.php';
    if (file_exists($api)) {
      require_once $api;
    }

  }


}
