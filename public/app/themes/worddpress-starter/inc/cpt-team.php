<?php

function dm_post_type_team() {
	$supports = array(
		'title',
		'thumbnail',
		'custom-fields'
	);

	$labels = array(
		'name' => 'Team',
		'singular_name' => 'Team Member',
		'menu_name' => 'Team',
		'name_admin_bar' => 'Team',
		'add_new' => 'Add Team Member',
		'add_new_item' => 'Add Team Member',
		'new_item' => 'New Team Member',
		'edit_item' => 'Edit Team Member',
		'view_item' => __('View Team Member'),
		'all_items' => __('All Team Members'),
		'search_items' => __('Search Team Members'),
		'not_found' => __('No Team Member found.'),
	);
	$args = array(
		'supports' => $supports,
		'labels' => $labels,
		'public' => false,
	  'show_ui' => true,
		'capability_type' => 'page',
		'query_var' => true,
		'menu_icon' => 'dashicons-businessman',
		'has_archive' => false,
    'hierarchical' => false,
	);
	register_post_type('team', $args);
}
add_action('init', 'dm_post_type_team');
