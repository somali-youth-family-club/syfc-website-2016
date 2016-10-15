<?php
/**
 * Custom Post Types
 */

// custom post type and taxonomy
add_action('init', 'event_post_type');
function event_post_type() {
  $labels = array(
    'name' => __('Events'),
    'singular_name' => __('Event'),
    'menu_name' => __('Events'),
    'all_items' => __('All Events'),
    'add_new_item' => __('Add New Event'),
    'search_items' => __('Search Events'),
    'not_found' => __('No Events found'),
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
    'menu_icon' => 'dashicons-calendar',
    'hierarchical' => false,
    'supports' => array(
      'title',
      'editor',
      'thumbnail'
    ),
    'has_archive' => true,
    'rewrite' => array(
      'slug' => 'events',
      'with_front' => false
    ),
  );
  register_post_type('event', $args);
}

// office content type
add_action('init', 'office_post_type');
function office_post_type() {
  $labels = array(
    'name' => __('Offices'),
    'singular_name' => __('Office'),
    'menu_name' => __('Offices'),
    'all_items' => __('All Offices'),
    'add_new_item' => __('Add New Office'),
    'search_items' => __('Search Offices'),
    'not_found' => __('No Offices found'),
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
    'menu_icon' => 'dashicons-admin-home',
    'hierarchical' => false,
    'supports' => array(
      'title'
    ),
    'has_archive' => true,
    'rewrite' => array(
      'slug' => 'events',
      'with_front' => false
    ),
  );
  register_post_type('office', $args);
}

//services taxonomy
add_action( 'init', 'create_service_taxonomy', 0 );
function create_service_taxonomy() {
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Services', 'taxonomy general name' ),
    'singular_name' => _x( 'Service', 'taxonomy singular name' ),
    'search_items' => __( 'Search Services' ),
    'popular_items' => __( 'Popular Services' ),
    'all_items' => __( 'All Services' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Service' ),
    'update_item' => __( 'Update Service' ),
    'add_new_item' => __( 'Add Service' ),
    'new_item_name' => __( 'New Service' ),
    'separate_items_with_commas' => __( 'Separate services with commas' ),
    'add_or_remove_items' => __( 'Add or remove service' ),
    'choose_from_most_used'      => __( 'Choose from the most used services' ),
    'not_found' => __( 'No services found.' ),
    'menu_name' => __( 'Services' ),
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'hierarchical' => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'service' ),
  );

  register_taxonomy( 'service', 'office', $args );
}
