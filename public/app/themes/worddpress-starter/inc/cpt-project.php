<?php
// Register Projects CPT
function dm_post_type_project() {
    $supports = array(
        'title',
        'thumbnail',
        'excerpt',
    );

    $labels = array(
        'name' => 'Projects',
        'singular_name' => 'Project',
        'menu_name' => 'Projects',
        'name_admin_bar' => 'Projects',
        'add_new' => 'Add Project',
        'add_new_item' => 'Add Project',
        'new_item' => 'New Project',
        'edit_item' => 'Edit Project',
        'view_item' => 'View Project',
        'all_items' => 'All Projects',
        'search_items' => 'Search Projects',
        'not_found' => 'No project found.',
        'archives' => 'Projects',
    );

    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'menu_position' => 21,
        'menu_icon' => 'dashicons-hammer',
        'rewrite' => array('slug' => 'projects', 'with_front' => true),
        'has_archive' => true,
        'hierarchical' => true,
        'taxonomies' => array('solution'), // attach taxonomy
    );

    register_post_type('projects', $args);
}
add_action('init', 'dm_post_type_project');

// Register Solution Taxonomy
function dm_taxonomy_solution() {
    $labels = array(
        'name' => 'Solutions',
        'singular_name' => 'Solution',
        'menu_name' => 'Solutions',
        'all_items' => 'All Solutions',
        'edit_item' => 'Edit Solution',
        'add_new_item' => 'Add New Solution',
        'new_item_name' => 'New Solution Name',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'hierarchical' => true, // like categories
        'show_ui' => true,
        'show_in_menu' => true,
        'rewrite' => array('slug' => 'solution'),
    );

    register_taxonomy('solution', 'projects', $args);
}
add_action('init', 'dm_taxonomy_solution');
