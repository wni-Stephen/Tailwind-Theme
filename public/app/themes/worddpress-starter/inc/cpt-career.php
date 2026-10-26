<?php

function dm_post_type_career()
{
	$supports = array(
		'title',
		'excerpt',
	);

	$labels = array(
		'name' => 'Careers',
		'singular_name' => 'Career',
		'menu_name' => 'Careers',
		'all_items' => 'All Careers',
		'edit_item' => 'Edit Career',
		'view_item' => 'View Career',
		'view_items' => 'View Careers',
		'add_new_item' => 'Add New Career',
		'new_item' => 'New Career',
		'parent_item_colon' => 'Parent Career:',
		'search_items' => 'Search Careers',
		'not_found' => 'No careers found',
		'not_found_in_trash' => 'No careers found in the bin',
		'archives' => 'Careers',
		'attributes' => 'Career Attributes',
		'insert_into_item' => 'Insert into career',
		'uploaded_to_this_item' => 'Uploaded to this career',
		'filter_items_list' => 'Filter careers list',
		'filter_by_date' => 'Filter careers by date',
		'items_list_navigation' => 'Careers list navigation',
		'items_list' => 'Careers list',
		'item_published' => 'Career published.',
		'item_published_privately' => 'Career published privately.',
		'item_reverted_to_draft' => 'Career reverted to draft.',
		'item_scheduled' => 'Career scheduled.',
		'item_updated' => 'Career updated.',
		'item_link' => 'Career Link',
		'item_link_description' => 'A link to a career.',
	);
	$args = array(
		'supports' => $supports,
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'capability_type'    => 'post',
		'query_var' => true,
		'menu_icon' => 'dashicons-megaphone',
		'rewrite' => array('slug' => 'about-us/careers/current-vacancies'),
		'has_archive' => false,
		'hierarchical' => false,
		'delete_with_user' => false,
	);
	register_post_type('career', $args);
}
add_action('init', 'dm_post_type_career');
