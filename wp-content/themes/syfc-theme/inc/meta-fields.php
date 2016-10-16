<?php
// custom meta boxes, using metabox.io plugin

add_filter( 'admin_init', 'bamboo_register_meta_boxes' );

function bamboo_register_meta_boxes( $meta_boxes ) {
  if ( !class_exists( 'RW_Meta_Box' ) )
    return;

  $prefix = 'syafc_';

  // event meta box
  $meta_boxes[] = array(
    'id'       => 'event_meta',
    'title'    => 'Event Information',
    'pages'    => array( 'event' ),
    'context'  => 'normal',
    'priority' => 'high',
    'fields' => array(
      array(
        'name' => 'Event Type',
        'desc' => 'Is it an Outreach, Workshop, or Community Cafe event?',
        'id' => $prefix . 'event_type',
        'type' => 'select',
        'options'  => array(
          'workshop' => 'Workshop',
          'outreach' => 'Outreach',
          'cafe' => 'Community Cafe',
          'other' => 'Other'
        ),
        'multiple'    => false,
        'placeholder' => 'Select type',
      ),
      array(
        'name' => 'Date',
        'desc' => 'Choose a date for this event (required)',
        'id' => $prefix . 'event_date',
        'type' => 'date',
        'js_options' => array(
          'dateFormat' => 'yy-mm-dd',
          'altFormat' => 'M dd, yy',
          'changeMonth' => true,
          'changeYear' => true,
          'showButtonPanel' => true,
        ),
      ),
      array(
        'name' => 'Time',
        'desc' => 'Choose a starting time',
        'id' => $prefix . 'event_time',
        'type' => 'time',
        'js_options' => array(
          'timeFormat' => 'h:mm TT',
          'showButtonPanel' => true,
        ),
      )
    ),
    'validation' => array(
      'rules'    => array(
        $prefix . 'event_date' => array(
          'required'  => true,
        ),
        $prefix . 'event_type' => array(
          'required'  => true,
        ),
      ),
      'messages' => array(
        $prefix . 'event_date' => array(
          'required'  => 'An event date is required',
        ),
        $prefix . 'event_type' => array(
          'required'  => 'Select an event type, or choose other',
        ),
      )
    )
  );

  // office meta box
  $service_array = array();
  $service_query = get_terms('service', array('hide_empty' => false));
  if( !empty($service_query) && !is_wp_error($service_query) ) {
   foreach( $service_query as $service ) {
     $service_array[$service->term_id] = $service->name;
   }
  }
  $meta_boxes[] = array(
    'id'       => 'office_meta',
    'title'    => 'Office Information',
    'pages'    => array( 'office' ),
    'context'  => 'normal',
    'priority' => 'high',
    'fields' => array(
      array(
        'name' => 'Office Address',
        'desc' => 'Where is this office located?',
        'id' => $prefix . 'office_address',
        'type' => 'text'
      ),
      array(
        'name' => 'Phone Number',
        'desc' => 'Phone number for this office',
        'id' => $prefix . 'office_phone',
        'type' => 'text'
      ),
      array(
        'name' => 'Hours',
        'desc' => 'Describe the hours of operation, e.g. 9 AM - 5 PM Monday-Friday',
        'id' => $prefix . 'office_hours',
        'type' => 'text'
      ),
      array(
        'name' => 'Services',
        'desc' => 'Check all services offered at this office',
        'id' => $prefix . 'office_services',
        'type' => 'checkbox_list',
        'options' => $service_array
      ),
      array(
        'name' => 'More Information',
        'desc' => 'Any other office-specific information, e.g. service-specific hours',
        'id' => $prefix . 'office_extras',
        'type' => 'textarea'
      ),
    ),
  );

  foreach ( $meta_boxes as $meta_box ) {
    // Register meta boxes only for some posts/pages
    if ( isset( $meta_box['only_on'] ) && ! bamboo_check_include( $meta_box['only_on'] ) ) {
      continue;
    }
    new RW_Meta_Box( $meta_box );
  }

}

function bamboo_check_include( $conditions ) {
  // Include in back-end only
  if ( ! defined( 'WP_ADMIN' ) || ! WP_ADMIN )
    return false;

  // Always include for ajax
  if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
    return true;

  if ( isset( $_GET['post'] ) )
    $post_id = $_GET['post'];
  elseif ( isset( $_POST['post_ID'] ) )
    $post_id = $_POST['post_ID'];
  else
    $post_id = false;

  $post_id = (int) $post_id;
  $post = get_post( $post_id );
  $post_type = get_post_type( $post );

  foreach ( $conditions as $cond => $v ) {
    // Catch non-arrays too
    if ( ! is_array( $v ) ) {
      $v = array( $v );
    }

    switch ( $cond ) {
      case 'id':
        if ( in_array( $post_id, $v ) ) {
          return true;
        }
      break;
      case 'parent':
        $post_parent = $post->post_parent;
        if ( in_array( $post_parent, $v ) ) {
          return true;
        }
      break;
      case 'slug':
        $post_slug = $post->post_name;
        if ( in_array( $post_slug, $v ) ) {
          return true;
        }
      break;
      case 'template':
        $template = get_post_meta( $post_id, '_wp_page_template', true );
        // if post type other than page is specified, don't return true
        if ( in_array( $template, $v ) || in_array($post_type, $v)  ) {
          return true;
        }
      break;
      case 'exclude_template':
        $template = get_post_meta( $post_id, '_wp_page_template', true );

        if ( !in_array( $template, $v )  ) {
          return true;
        }
      break;
    }
  }

  // If no condition matched
  return false;
}
