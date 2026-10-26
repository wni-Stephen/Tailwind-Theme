<?php


function dm_post_type_testimonial() {
	$supports = array(
		'title',
		'thumbnail',
	);

	$labels = array(
		'name' => 'Testimonials',
		'singular_name' => 'Testimonial',
		'menu_name' => 'Testimonials',
		'name_admin_bar' => 'Testimonials',
		'add_new' => 'Add Testimonial',
		'add_new_item' => 'Add Testimonial',
		'new_item' => 'New Testimonial',
		'edit_item' => 'Edit Testimonial',
		'view_item' => __('View Testimonial'),
		'all_items' => __('All Testimonials'),
		'search_items' => __('Search Testimonials'),
		'not_found' => __('No Testimonial found.'),
	);
	$args = array(
		'supports' => $supports,
		'labels' => $labels,
		'public' => false,
	  	'show_ui' => true,
		'capability_type'    => 'post',
		'query_var' => true,
		'menu_icon' => 'dashicons-format-quote',
		'has_archive' => false,
    	'hierarchical' => false,
	);
	register_post_type('testimonial', $args);
}



add_action('init', 'dm_post_type_testimonial');
