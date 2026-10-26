<?php 
function dm_post_type_brochure() {
    $supports = array(
        'title',
        'thumbnail',
        'excerpt',
        'page-attributes',
        'custom-fields'
    );

    $labels = array(
        'name' => 'brochure',
        'singular_name' => 'brochure',
        'menu_name' => 'Brochures',
        'name_admin_bar' => 'Brochures',
        'add_new' => 'Add Brochure',
        'add_new_item' => 'Add Brochure',
        'new_item' => 'New Brochure',
        'edit_item' => 'Edit Brochure',
        'view_item' => __('View Brochures'),
        'all_items' => __('All Brochures'),
        'search_items' => __('Search Brochures'),
        'not_found' => __('No Brochures found.'),
    );

    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'query_var' => true,
        'menu_icon' => 'dashicons-media-document',
        'rewrite' => array( 'slug' => 'brochure', 'with_front' => false ),
        'has_archive' => true,
        'hierarchical' => true, 
    );

    register_post_type('brochure', $args);
}
add_action('init', 'dm_post_type_brochure');
?>