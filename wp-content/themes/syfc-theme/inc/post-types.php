<?php
/**
 * Custom Post Types
 */

// custom post type and taxonomy
add_action('init', 'custom_post_type');
function custom_post_type() {
  $labels = array(
    'name' => __('Post Type'),
    'singular_name' => __('Post Type'),
    'menu_name' => __('Post Type'),
    'all_items' => __('All Post Types'),
    'search_items' => __('Search Post Types'),
    'not_found' => __('No Post Types found'),
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'rewrite' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'show_in_nav_menus' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-analytics',
    'hierarchical' => false,
    'supports' => array(
      'title',
      'editor',
      'thumbnail'
    ),
    'taxonomies' => array( 'custom_tax' ),
    'has_archive' => true,
    'rewrite' => array(
      'slug' => 'custom',
      'with_front' => false
    ),
  );
  register_post_type('custom', $args);
}
//resource cat taxonomy
add_action( 'init', 'create_custom_taxonomy', 0 );
function create_custom_taxonomy() {
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Custom Taxonomy', 'taxonomy general name' ),
    'singular_name' => _x( 'Custom Taxonomy', 'taxonomy singular name' ),
    'search_items' => __( 'SearchCustom Taxonomy' ),
    'popular_items' => __( 'Popular Custom Taxonomies' ),
    'all_items' => __( 'All Custom Taxonomies' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Custom Taxonomy' ),
    'update_item' => __( 'Update Custom Taxonomy' ),
    'add_new_item' => __( 'Add New Custom Taxonomy' ),
    'new_item_name' => __( 'New Custom Taxonomy Name' ),
    'separate_items_with_commas' => __( 'Separate Custom Taxonomies with commas' ),
    'add_or_remove_items' => __( 'Add or remove custom_tax' ),
    'choose_from_most_used'      => __( 'Choose from the most used custom_taxes' ),
    'not_found' => __( 'No Custom Taxonomies found.' ),
    'menu_name' => __( 'Custom Taxonomy' ),
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'hierarchical' => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'custom_tax' ),
  );

  register_taxonomy( 'custom_tax', 'custom', $args );
}
