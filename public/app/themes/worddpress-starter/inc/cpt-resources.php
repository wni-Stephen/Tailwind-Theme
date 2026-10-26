<?php
function dm_posts_per_page_news($query)
{
	if (!is_admin() && $query->is_main_query() && is_post_type_archive('resource')) {
		$query->set('posts_per_page', '6');
	}
}
add_action('pre_get_posts', 'dm_posts_per_page_news');


function dm_post_type_news()
{
	$supports = array(
		'title',
		'thumbnail',
		'excerpt',
		'page-attributes',
		'custom-fields'
	);

	$labels = array(
		'name' => 'news',
		'singular_name' => 'news',
		'menu_name' => 'News',
		'name_admin_bar' => 'News',
		'add_new' => 'Add News Item',
		'add_new_item' => 'Add News Item',
		'new_item' => 'New News Item',
		'edit_item' => 'Edit News Item',
		'view_item' => __('View News Item'),
		'all_items' => __('All news'),
		'search_items' => __('Search news'),
		'not_found' => __('No news found.'),
	);
	$args = array(
		'supports' => $supports,
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type'    => 'page',
		'query_var' => true,
		'menu_icon' => 'dashicons-format-chat',
		'rewrite' => array('slug' => 'news', 'with_front' => false),
		'has_archive' => true,
		'hierarchical' => false,
	);
	register_post_type('news', $args);
}
add_action('init', 'dm_post_type_news');

// ================================= Custom Post Type Taxonomies =================================
function dm_create_news_taxonomy()
{
    register_taxonomy('news_category', 'news', array(
			'label'        => 'News Categories',
        	'public'       => true,
        	'hierarchical' => true,
        	'rewrite'      => array(
            	'slug' => 'news', // Match CPT archive slug
            	'with_front' => false
	   )
    ));
}
add_action('init', 'dm_create_news_taxonomy');


// function filter_news_post_link($post_link, $post) {
//     if ($post->post_type === 'news') {
//         $terms = get_the_terms($post->ID, 'news_category');
//         if ($terms && !is_wp_error($terms)) {
//             $term_slug = $terms[0]->slug; // Use the first category
//         } else {
//             $term_slug = ''; // Fallback if no category is assigned
//         }
//         return str_replace('%news_category%', $term_slug, $post_link);
//     }
//     return $post_link;
// }
// add_filter('post_type_link', 'filter_news_post_link', 10, 2);


// function news_rewrite_rules($rules) {
//     $new_rules = array();

//     // Allow archive to work (example.com/portfolio/)
//     $new_rules['news/?$'] = 'index.php?post_type=news';

//     // Allow taxonomy page (example.com/portfolio/category-name/)
//     $new_rules['news/([^/]+)/?$'] = 'index.php?news_category=$matches[1]';

//     // Allow single posts with taxonomy (example.com/portfolio/category-name/post-name/)
//     $new_rules['news/([^/]+)/([^/]+)/?$'] = 'index.php?news=$matches[2]';

//     return $new_rules + $rules;
// }
// add_filter('rewrite_rules_array', 'news_rewrite_rules');

// SAFE
// function custom_news_rewrites($wp_rewrite) {
//     $rules = [];

//     // Get all portfolio categories
//     $terms = get_terms([
//         'taxonomy'   => 'news_category',
//         'hide_empty' => false,
//     ]);

//     if ($terms) {
//         foreach ($terms as $term) {
//             $rules['news/' . $term->slug . '/?$'] = 'index.php?news_category=' . $term->slug;
//         }
//     }

//     $wp_rewrite->rules = $rules + $wp_rewrite->rules;
// }
// add_filter('generate_rewrite_rules', 'custom_news_rewrites');