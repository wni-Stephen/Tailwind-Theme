<?php
new App\Boot();


add_action('pre_get_posts', function($query) {
  if (!is_admin() && $query->is_main_query() && is_post_type_archive('projects')) {
      // Show all projects by default
      $query->set('posts_per_page', -1);

      // Filter by solution if URL param exists
      if (!empty($_GET['solution'])) {
          $solution = sanitize_text_field($_GET['solution']);
          $query->set('tax_query', [
              [
                  'taxonomy' => 'solution',
                  'field'    => 'slug',
                  'terms'    => $solution,
              ]
          ]);
      }
  }
});

require_once('inc/vite.php');
require_once('inc/backend.php');
// require_once('inc/cpt-solution.php');
// require_once('inc/cpt-project.php');
// require_once('inc/cpt-resources.php');
// require_once('inc/cpt-team.php');
require_once('inc/cpt-testimonial.php');
// require_once('inc/cpt-location.php');
require_once('inc/cpt-career.php');
// require_once('inc/cpt-brochure.php');

require_once('inc/pagination.php');

remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('template_redirect', 'rest_output_link_header', 11);
remove_action('template_redirect', 'wp_shortlink_header', 11);

// Remove the default editor for posts and pages
add_action('init', 'remove_editor_for_posts_and_pages', 20);
function remove_editor_for_posts_and_pages() {
    remove_post_type_support('post', 'editor');
    remove_post_type_support('page', 'editor');
}
/*

		function my_layout_title($title, $field, $layout, $i) {
			if (have_rows('blocks') && count(get_field('blocks'))) :
				if($value = get_sub_field('headline')) {
					return $title . ' - ' . $value;
				} else {
					foreach($layout['sub_fields'] as $sub) {
						if($sub['name'] == 'headline') {
							$key = $sub['key'];
							if(array_key_exists($i, $field['value']) && $value = $field['value'][$i][$key])
								return $title . ' - ' . $value;
						}
					}
				}
				return $title;
			endif;
		}

add_filter('acf/fields/flexible_content/layout_title', 'my_layout_title', 10, 4);
*/

function dm_setup_theme_supported_features()
{
  add_post_type_support('page', 'excerpt');
  add_theme_support('post-thumbnails');
  add_theme_support('disable-custom-font-sizes');
  add_theme_support('disable-custom-gradients');
  add_theme_support('custom-line-height');
  remove_theme_support('core-block-patterns');
  add_filter('use_block_editor_for_post', '__return_false', 10);
  add_image_size( 'small', 200, 200, true );


  //	add_filter('use_block_editor_for_post', '__return_false', 10);


  // This theme uses wp_nav_menu() in one location.
  register_nav_menus(array(
    'primary-menu'     => esc_html__('Primary', 'dm'),
    //	'mobile-menu' 	=> esc_html__( 'Mobile', 'dm' ),
    //  'footer-whatwedo-menu' 	=> esc_html__( 'Footer: What We Do', 'dm' ),
    //  'footer-approach-menu' 	=> esc_html__( 'Footer: Approach', 'dm' ),
    //  'footer-about-menu' 	=> esc_html__( 'Footer: About', 'dm' )
  ));

  add_filter('body_class', function ($classes) {
    return array_merge($classes, array(
      'text-black',
      'flex',
      'flex-col',
      'min-h-full',
      'relative',
    ));
  });
}
add_action('after_setup_theme', 'dm_setup_theme_supported_features');


/**
 * Enqueue scripts and styles.
 */
function dm_scripts()
{
  wp_dequeue_script('jquery');
  wp_deregister_script('jquery');
  wp_dequeue_style('classic-theme-styles');
  wp_dequeue_style('global-styles');
}
add_action('wp_enqueue_scripts', 'dm_scripts');

// Remove admin color scheme
remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');

// Disable Emojicons
add_action('init', 'disable_wp_emojicons');


function disable_emojicons_tinymce($plugins)
{
  if (is_array($plugins)) {
    return array_diff($plugins, array('wpemoji'));
  } else {
    return array();
  }
}


function disable_wp_emojicons()
{

  // all actions related to emojis
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');

  // filter to remove TinyMCE emojis
  add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
}


// Remove the REST API endpoint.
//remove_action('rest_api_init', 'wp_oembed_register_route' );

// Turn off oEmbed auto discovery.
add_filter('embed_oembed_discover', '__return_false');

// Don't filter oEmbed results.
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

// Remove oEmbed discovery links.
remove_action('wp_head', 'wp_oembed_add_discovery_links');

// Remove oEmbed-specific JavaScript from the front-end and back-end.
remove_action('wp_head', 'wp_oembed_add_host_js');

// Remove all embeds rewrite rules.
//add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );

function remove_wp_block_library()
{
  wp_dequeue_style('wp-block-library'); // Wordpress core
  //  wp_dequeue_style( 'wsi_blocks' );
  wp_dequeue_style('wp-block-library-theme'); // Wordpress core
}
add_action('wp_enqueue_scripts', 'remove_wp_block_library', 100);


// Remove WordPress Meta Generator
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'wp_resource_hints', 2);
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'index_rel_link'); // index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.



// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
  remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
  if (is_admin_bar_showing()) {
    remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
  }
});



// Add taxonomy filter dropdown in WordPress Admin
function add_resource_category_filter()
{
  // Check if we are on the 'resources' post type admin page
  global $typenow;
  if ($typenow == 'resources') {
    // Get all terms from the 'resource_category' taxonomy
    $taxonomy = 'resource_category';
    $terms = get_terms(array(
      'taxonomy' => $taxonomy,
      'orderby'  => 'name',
      'hide_empty' => false,
    ));

    // If there are terms in the taxonomy
    if ($terms) {
      echo '<select name="' . $taxonomy . '" id="' . $taxonomy . '" class="postform">';
      echo '<option value="">Filter by Resource Category</option>'; // Default option

      // Loop through terms and generate the dropdown options
      foreach ($terms as $term) {
        // Get current URL and add the selected term as a query parameter
        $selected = (isset($_GET[$taxonomy]) && $_GET[$taxonomy] == $term->slug) ? ' selected="selected"' : '';
        echo '<option value="' . $term->slug . '" ' . $selected . '>' . $term->name . '</option>';
      }
      echo '</select>';
    }
  }
}
add_action('restrict_manage_posts', 'add_resource_category_filter');

// Modify query to filter by taxonomy term in the admin list
function filter_resources_by_taxonomy($query)
{
  // Only apply the filter to the 'resources' post type
  global $pagenow;
  if ('edit.php' === $pagenow && isset($_GET['post_type']) && $_GET['post_type'] === 'resources') {

    // Check if we have a value selected for the 'resource_category' taxonomy
    if (isset($_GET['resource_category']) && $_GET['resource_category'] != '') {
      $query->set('tax_query', array(
        array(
          'taxonomy' => 'resource_category',
          'field'    => 'slug',
          'terms'    => $_GET['resource_category'],
          'operator' => 'IN',
        ),
      ));
    }
  }
}
add_action('pre_get_posts', 'filter_resources_by_taxonomy');

function add_slug_body_class($classes)
{
  global $post;
  if (isset($post)) {
    $classes[] = $post->post_type . '-' . $post->post_name;
  }
  return $classes;
}
add_filter('body_class', 'add_slug_body_class');

function force_fix_news_slugs() {
  $news_posts = get_posts(array(
      'post_type' => 'news',
      'posts_per_page' => -1,
      'post_status' => 'publish',
      'post_parent' => 0, // explicitly query top-level
  ));

  foreach ($news_posts as $post) {
      // Recalculate slug ignoring hierarchical cache
      global $wpdb;
      $new_slug = sanitize_title($post->post_title);
      $wpdb->update(
          $wpdb->posts,
          array('post_name' => $new_slug, 'post_parent' => 0),
          array('ID' => $post->ID)
      );
      clean_post_cache($post->ID);
  }
}
add_action('init', 'force_fix_news_slugs');

add_action( 'pre_get_posts', function( $query ) {
    if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'projects' ) ) {
        $query->set( 'posts_per_page', 6 ); // Change 12 to whatever you want
    }
});


