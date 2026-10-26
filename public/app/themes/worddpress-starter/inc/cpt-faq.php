<?php

function dm_post_type_faq() {
	$supports = array(
		'title',
		'page-attributes',
	);

	$labels = array(
		'name' => 'FAQs',
		'singular_name' => 'FAQ',
		'menu_name' => 'FAQs',
		'name_admin_bar' => 'FAQs',
		'add_new' => 'Add FAQ',
		'add_new_item' => 'Add FAQ',
		'new_item' => 'New FAQ',
		'edit_item' => 'Edit FAQ',
		'view_item' => __('View FAQ'),
		'all_items' => __('All FAQs'),
		'search_items' => __('Search FAQs'),
		'not_found' => __('No FAQ found.'),
		'item_published' => __('FAQ published'),
		'item_updated' => __('FAQ updated')
	);
	$args = array(
		'supports' => $supports,
		'labels' => $labels,
		'public' => false,
	  'show_ui' => true,
		'capability_type'    => 'post',
		'query_var' => true,
		'menu_icon' => 'dashicons-format-chat',
		'rewrite' => false,
		'has_archive' => false,
    'hierarchical' => false,
	);
	register_post_type('faq', $args);
}

add_action('init', 'dm_post_type_faq');
