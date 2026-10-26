<?php
function dm_posts_per_page_case_study( $query ) {
  if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'case-study' ) ) {
    $query->set( 'posts_per_page', '6' );
  }
}
add_action( 'pre_get_posts', 'dm_posts_per_page_case_study' );


function dm_post_type_case_study() {
	$supports = array(
		'title',
		'thumbnail',
		'excerpt',
		'page-attributes',
		'custom-fields'
	);

	$labels = array(
		'name' => 'Case Studies',
		'singular_name' => 'Case Study',
		'menu_name' => 'Case Studies',
		'name_admin_bar' => 'Case Studies',
		'add_new' => 'Add Case Study',
		'add_new_item' => 'Add Case Study',
		'new_item' => 'New Case Study',
		'edit_item' => 'Edit Case Study',
		'view_item' => __('View Case Study'),
		'all_items' => __('All Case Studies'),
		'search_items' => __('Search Case Studies'),
		'not_found' => __('No Case Studies found.'),
	);
	$args = array(
		'supports' => $supports,
		'labels' => $labels,
		'public' => true,
    	'show_ui' => true,
    	'show_in_menu' => true,
		'capability_type'    => 'page',
		'query_var' => true,
		'menu_icon' => 'dashicons-slides',
		'rewrite' => array( 'slug' => 'case-studies'),
		'has_archive' => true,
    	'hierarchical' => false,
	);
	register_post_type('case-study', $args);
}
add_action('init', 'dm_post_type_case_study');

// ================================= Custom Post Type Taxonomies =================================
// function dm_create_case_study_taxonomy() {
//     register_taxonomy(
//         'solution',
//         'case-study',  //post type name
//         array(
//             'hierarchical' => false,
//             'label' => 'Solutions',
//             'query_var' => true,
// 						//'has_archive' => true,
// 					//	'rewrite' => 'sector'
//         )
//     );
// }
// add_action( 'init', 'dm_create_case_study_taxonomy');


/*
function case_study_category_rewrite_rule() {

    $parent_terms = get_terms('sector');

    foreach( $parent_terms as $parent_term ) {
      add_rewrite_rule( '^sectors/' . $parent_term->slug. ' /([a-z0-9-]+)[/]?$', 'index.php?case-study=$matches[1]', 'top' );
    }
}
 add_action( 'init', 'case_study_category_rewrite_rule');

 */
