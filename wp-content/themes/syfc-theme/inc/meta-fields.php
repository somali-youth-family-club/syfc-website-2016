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
          'community-cafe' => 'Community Cafe',
          'fundraising' => 'Fundraising',
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


  // Home page
  $page_array = array();
  $query_args = array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'post_status' => 'publish'
  );
  $page_query = get_pages($query_args);
  if( !empty($page_query) && !is_wp_error($page_query) ) {
    foreach( $page_query as $page ) {
      $page_array[$page->ID] = $page->post_title;
    }
  }
  $meta_boxes[] = array(
    'id'       => 'home_meta',
    'title'    => 'Homepage Diamond Menu',
    'pages'    => array( 'page' ),
    'only_on'    => array(
      'template' => array( 'templates/page-home.php'),
    ),
    'context'  => 'normal',
    'priority' => 'high',
    'fields' => array(
      array(
        'name' => 'First Page',
        'desc' => '',
        'id' => $prefix . 'home_subpage1',
        'type' => 'select',
        'options'  => $page_array,
        'multiple'    => false,
        'placeholder' => 'Select a page',
      ),
      array(
        'name' => 'Second Page',
        'desc' => '',
        'id' => $prefix . 'home_subpage2',
        'type' => 'select',
        'options'  => $page_array,
        'multiple'    => false,
        'placeholder' => 'Select a page',
      ),
      array(
        'name' => 'Third Page',
        'desc' => '',
        'id' => $prefix . 'home_subpage3',
        'type' => 'select',
        'options'  => $page_array,
        'multiple'    => false,
        'placeholder' => 'Select a page',
      ),
    ),
  );

  // featured check for blog posts
  $meta_boxes[] = array(
    'id'       => 'blog_post_meta',
    'title'    => 'Post Options',
    'pages'    => array( 'post' ),
    'context'  => 'normal',
    'priority' => 'high',
    'fields' => array(
      array(
        'name' => 'Feature on Home Page?',
        'id'   => $prefix . 'post_featured',
        'type' => 'checkbox',
        'std'  => 1,
      )
    ),
  );

  // volunteers
  $meta_boxes[] = array(
    'id'       => 'volunteer_meta',
    'title'    => 'Volunteer Info',
    'pages'    => array( 'volunteer' ),
    'context'  => 'normal',
    'priority' => 'high',
    'fields' => array(
      array(
        'type' => 'heading',
        'name' => 'Basic Info',
        'id'   => 'fake_id',
      ),
      array(
        'name' => 'Full Name',
        'id' => $prefix . 'vol_name',
        'type' => 'text'
      ),
      array(
        'name' => 'Dates at SECMOL',
        'id' => $prefix . 'vol_dates',
        'type' => 'textarea'
      ),
      array(
        'name' => 'Age',
        'id' => $prefix . 'vol_age',
        'type' => 'number'
      ),
      array(
        'name' => 'From',
        'id' => $prefix . 'vol_from',
        'type' => 'text'
      ),
      array(
        'name' => 'Citizenship',
        'id' => $prefix . 'vol_citizenship',
        'type' => 'text'
      ),
      array(
        'name' => 'Email',
        'id' => $prefix . 'vol_email',
        'type' => 'email'
      ),
      array(
        'name' => 'Permanent Email',
        'id' => $prefix . 'vol_email2',
        'type' => 'email'
      ),
      array(
        'name' => 'Phone Number',
        'id' => $prefix . 'vol_phone',
        'type' => 'text'
      ),
      array(
        'name' => 'Emergency Contact',
        'id' => $prefix . 'vol_emergency',
        'type' => 'text'
      ),
      array(
        'type' => 'heading',
        'name' => 'Volunteering Info',
        'id'   => 'fake_id',
      ),
      array(
        'name' => 'Occupation',
        'id' => $prefix . 'vol_job',
        'type' => 'text'
      ),
      array(
        'name' => 'Volunteer role',
        'id' => $prefix . 'vol_role',
        'type' => 'text'
      ),
      array(
        'name' => 'Other Skills and Ideas',
        'id' => $prefix . 'vol_skills',
        'type' => 'textarea'
      ),
      array(
        'name' => 'Volunteer Comments',
        'id' => $prefix . 'vol_self_notes',
        'type' => 'textarea'
      ),
      array(
        'name' => 'Staff Notes',
        'id' => $prefix . 'vol_staff_notes',
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
