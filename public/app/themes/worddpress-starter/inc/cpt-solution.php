<?php
/*
function dm_posts_per_page_solution( $query ) {
  if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'solution' ) ) {
    $query->set( 'posts_per_page', '-1' );
  }
}
add_action( 'pre_get_posts', 'dm_posts_per_page_solution' );

*/



function dm_post_type_solution() {
	$supports = array(
		'title',
		'thumbnail',
		'excerpt',
		'page-attributes',
	);

	$labels = array(
		'name' => 'solutions',
		'singular_name' => 'solution',
		'menu_name' => 'Solutions',
		'name_admin_bar' => 'Solutions',
		'add_new' => 'Add solution',
		'add_new_item' => 'Add solution',
		'new_item' => 'New solution',
		'edit_item' => 'Edit solution',
		'view_item' => __('View solution'),
		'all_items' => __('All solutions'),
		'search_items' => __('Search solutions'),
		'not_found' => __('No solution found.'),
		'archives' => 'solutions',
	);
	$args = array(
		'supports' => $supports,
		'labels' => $labels,
    	'public' => true,
    	'show_ui' => true,
    	'show_in_menu' => true,
		'capability_type'    => 'page',
		'query_var' => true,
    	'menu_position' => 21,
		'menu_icon' => 'dashicons-portfolio',
		'rewrite' => array('slug' => 'solutions','with_front' => true),
		'has_archive' => true,
    	'hierarchical' => true
	);
	register_post_type('solutions', $args);

}
add_action('init', 'dm_post_type_solution');
