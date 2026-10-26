<?php
function dm_posts_per_page_location( $query ) {
  if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'locations' ) ) {
    $query->set( 'posts_per_page', '6' );
  }
}
add_action( 'pre_get_posts', 'dm_posts_per_page_location' );


function dm_post_type_locations() {
	$supports = array(
		'title',
		'thumbnail',
		'excerpt',
		'page-attributes',
		'custom-fields'
	);

	$labels = array(
		'name' => 'Location',
		'singular_name' => 'Location',
		'menu_name' => 'Locations',
		'name_admin_bar' => 'Locations',
		'add_new' => 'Add Location',
		'add_new_item' => 'Add Location',
		'new_item' => 'New Location',
		'edit_item' => 'Edit Location',
		'view_item' => __('View Location'),
		'all_items' => __('All Locations'),
		'search_items' => __('Search Locations'),
		'not_found' => __('No Locations found.'),
	);
	$args = array(
		'supports' => $supports,
		'labels' => $labels,
		'public' => false,
    	'show_ui' => true,
    	'show_in_menu' => true,
		'capability_type'    => 'page',
		'query_var' => true,
		'menu_icon' => 'dashicons-location',
		'rewrite' => array( 'slug' => 'site-locations'),
		'has_archive' => false,
    	'hierarchical' => false,
	);
	register_post_type('locations', $args);
}
add_action('init', 'dm_post_type_locations');

// ================================= Custom Post Type Taxonomies =================================
function dm_create_location_taxonomy() {
    register_taxonomy(
        'locations',
        'locations',  //post type name
        array(
            'hierarchical' => false,
            'label' => 'Tags',
            'query_var' => true,
						//'has_archive' => true,
					//	'rewrite' => 'sector'
        )
    );
}
add_action( 'init', 'dm_create_location_taxonomy');


/*
function news_category_rewrite_rule() {

    $parent_terms = get_terms('sector');

    foreach( $parent_terms as $parent_term ) {
      add_rewrite_rule( '^sectors/' . $parent_term->slug. ' /([a-z0-9-]+)[/]?$', 'index.php?case-study=$matches[1]', 'top' );
    }
}
 add_action( 'init', 'news_category_rewrite_rule');

 */
