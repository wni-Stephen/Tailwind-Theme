<?php
/*
function dm_posts_per_page_Service( $query ) {
  if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'Service' ) ) {
    $query->set( 'posts_per_page', '-1' );
  }
}
add_action( 'pre_get_posts', 'dm_posts_per_page_Service' );

*/



function dm_post_type_Service() {
	$supports = array(
		'title',
		'thumbnail',
		'excerpt',
	);

	$labels = array(
		'name' => 'Services',
		'singular_name' => 'Service',
		'menu_name' => 'Services',
		'name_admin_bar' => 'Services',
		'add_new' => 'Add Service',
		'add_new_item' => 'Add Service',
		'new_item' => 'New Service',
		'edit_item' => 'Edit Service',
		'view_item' => __('View Service'),
		'all_items' => __('All Services'),
		'search_items' => __('Search Services'),
		'not_found' => __('No Service found.'),
		'archives' => 'Services',
	);
	$args = array(
		'supports' => $supports,
		'labels' => $labels,
    	'public' => false,
    	'show_ui' => true,
    	'show_in_menu' => true,
		'capability_type'    => 'page',
		'query_var' => true,
    	'menu_position' => 21,
		'menu_icon' => 'dashicons-media-interactive',
		'rewrite' => array('slug' => 'services','with_front' => false),
		'has_archive' => false,
    	'hierarchical' => false
	);
	register_post_type('services', $args);

}
add_action('init', 'dm_post_type_service');
