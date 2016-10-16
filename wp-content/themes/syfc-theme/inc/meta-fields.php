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
      ),
      array(
        'name' => 'Volunteers needed?',
        'desc' => 'Check this box if you still need volunteers for this event. Remember to un-check it when there are enough volunteers.',
        'id'   => $prefix . 'event_volunteers',
        'type' => 'checkbox',
        'std'  => 0,
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
    'id'       => 'home_header',
    'title'    => 'Homepage Header Services',
    'pages'    => array( 'page' ),
    'only_on'    => array(
      'template' => array( 'templates/page-home.php'),
    ),
    'context'  => 'normal',
    'priority' => 'high',
    'fields' => array(
      array(
        'name' => 'Services Page',
        'desc' => 'Choose the page with the list of all services',
        'id' => $prefix . 'services_page',
        'type' => 'select',
        'options'  => $page_array,
        'multiple'    => false,
        'placeholder' => 'Select a page',
      ),
      array(
        'name' => 'Education Link',
        'desc' => 'Navigate to <a href="/wp-admin/edit-tags.php?taxonomy=service&post_type=office">Services</a> and copy the slug for Education',
        'id' => $prefix . 'education_service_slug',
        'type' => 'text'
      ),
      array(
        'name' => 'Education Service Name',
        'desc' => 'Probably just "Education"',
        'id' => $prefix . 'education_service_name',
        'type' => 'text'
      ),
      array(
        'name' => 'Social Services Link',
        'desc' => 'Navigate to <a href="/wp-admin/edit-tags.php?taxonomy=service&post_type=office">Services</a> and copy the slug for Social Services',
        'id' => $prefix . 'social_service_slug',
        'type' => 'text'
      ),
      array(
        'name' => 'Social Service Name',
        'desc' => 'Probably just "Social Services"',
        'id' => $prefix . 'social_service_name',
        'type' => 'text'
      ),
      array(
        'name' => 'Family Link',
        'desc' => 'Navigate to <a href="/wp-admin/edit-tags.php?taxonomy=service&post_type=office">Services</a> and copy the slug for Family',
        'id' => $prefix . 'family_service_slug',
        'type' => 'text'
      ),
      array(
        'name' => 'Family Service Name',
        'desc' => 'Probably just "Family"',
        'id' => $prefix . 'family_service_name',
        'type' => 'text'
      ),
      array(
        'name' => 'Immigration Link',
        'desc' => 'Navigate to <a href="/wp-admin/edit-tags.php?taxonomy=service&post_type=office">Services</a> and copy the slug for Immigration',
        'id' => $prefix . 'immigration_service_slug',
        'type' => 'text'
      ),
      array(
        'name' => 'Immigration Service Name',
        'desc' => 'Probably just "Immigration"',
        'id' => $prefix . 'immigration_service_name',
        'type' => 'text'
      ),
    ),
  );
  $meta_boxes[] = array(
    'id'       => 'home_meta_about',
    'title'    => 'About Us Section',
    'pages'    => array( 'page' ),
    'only_on'    => array(
      'template' => array( 'templates/page-home.php'),
    ),
    'context'  => 'normal',
    'priority' => 'high',
    'fields' => array(
      array(
        'name' => 'Tagline',
        'desc' => 'Short statement of purpose (about one sentence)',
        'id' => $prefix . 'home_about_tagline',
        'type' => 'textarea'
      ),
      array(
        'name' => 'About Blurb',
        'desc' => 'Short excerpt from the About Us page or mission statement',
        'id' => $prefix . 'home_about_blurb',
        'type' => 'textarea'
      ),
      array(
        'name' => 'About Us link',
        'desc' => 'Choose the About Us page',
        'id' => $prefix . 'home_about_link',
        'type' => 'select',
        'options'  => $page_array,
        'multiple'    => false,
        'placeholder' => 'Select a page',
      ),
    ),
  );
  $meta_boxes[] = array(
    'id'       => 'home_meta_history',
    'title'    => 'History Section',
    'pages'    => array( 'page' ),
    'only_on'    => array(
      'template' => array( 'templates/page-home.php'),
    ),
    'context'  => 'normal',
    'priority' => 'high',
    'fields' => array(
      array(
        'name' => 'Section Title',
        'desc' => 'What should the title of this section be? (e.g. "History")',
        'id' => $prefix . 'home_history_title',
        'type' => 'text'
      ),
      array(
        'name' => 'History Blurb',
        'desc' => 'A short summary of your organization\'s history (one short paragraph)',
        'id' => $prefix . 'home_history_blurb',
        'type' => 'textarea'
      ),
      array(
        'name' => 'Section Image',
        'desc' => 'Choose or upload an image to display with this section',
        'id' => $prefix . 'home_history_image',
        'type' => 'image_advanced',
        'max_file_uploads' => 1,
      ),
    ),
  );
  $meta_boxes[] = array(
    'id'       => 'home_meta_callouts',
    'title'    => 'Donate/Volunteer/Services',
    'pages'    => array( 'page' ),
    'only_on'    => array(
      'template' => array( 'templates/page-home.php'),
    ),
    'context'  => 'normal',
    'priority' => 'high',
    'fields' => array(
      array(
        'name' => 'Donate description',
        'desc' => 'A short (one sentence) callout for people to donate',
        'id' => $prefix . 'home_donate_desc',
        'type' => 'textarea'
      ),
      array(
        'name' => 'Donate link',
        'desc' => 'Choose the Donate page',
        'id' => $prefix . 'home_donate_link',
        'type' => 'select',
        'options'  => $page_array,
        'multiple'    => false,
        'placeholder' => 'Select a page',
      ),
      array(
        'name' => 'Divider',
        'id' => 'fake_id',
        'type' => 'divider'
      ),
      array(
        'name' => 'Volunteer description',
        'desc' => 'A short (one sentence) callout for people to volunteer',
        'id' => $prefix . 'home_volunteer_desc',
        'type' => 'textarea'
      ),
      array(
        'name' => 'Volunteer link',
        'desc' => 'Choose the Volunteer page',
        'id' => $prefix . 'home_volunteer_link',
        'type' => 'select',
        'options'  => $page_array,
        'multiple'    => false,
        'placeholder' => 'Select a page',
      ),
      array(
        'name' => 'Divider',
        'id' => 'fake_id',
        'type' => 'divider'
      ),
      array(
        'name' => 'Services description',
        'desc' => 'A short (one sentence) description of the services page',
        'id' => $prefix . 'home_services_desc',
        'type' => 'textarea'
      ),
      array(
        'name' => 'Service Page link',
        'desc' => 'Choose the Services page',
        'id' => $prefix . 'home_services_link',
        'type' => 'select',
        'options'  => $page_array,
        'multiple'    => false,
        'placeholder' => 'Select a page',
      )
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
