<?php 
function dm_post_type_news() {
    $supports = array(
        'title',
        'thumbnail',
        'excerpt',
        'page-attributes',
        'custom-fields'
    );

    $labels = array(
        'name' => 'News',
        'singular_name' => 'News Item',
        'menu_name' => 'News',
        'name_admin_bar' => 'News',
        'add_new' => 'Add News Item',
        'add_new_item' => 'Add News Item',
        'new_item' => 'New News Item',
        'edit_item' => 'Edit News Item',
        'view_item' => __('View News Item'),
        'all_items' => __('All News'),
        'search_items' => __('Search News'),
        'not_found' => __('No News found.'),
    );

    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'query_var' => true,
        'menu_icon' => 'dashicons-media-document',
        'rewrite' => array( 'slug' => 'news', 'with_front' => false ),
        'has_archive' => true,
        'hierarchical' => true, 
    );

    register_post_type('news', $args);
}
add_action('init', 'dm_post_type_news');



?>