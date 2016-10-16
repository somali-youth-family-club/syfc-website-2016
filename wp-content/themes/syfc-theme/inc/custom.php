<?php
/**
 * Custom functions
 */

/**
* Event filter ajax functions
*/
add_action("wp_ajax_filter_events", "filter_events");
add_action("wp_ajax_nopriv_filter_events", "filter_events");

// add meta information to event query
function add_event_extras( $posts ) {
  foreach ( $posts as $key => $post ) {
		$event_date = rwmb_meta('syafc_event_date', array(), $post->ID);
    $event_date = new DateTime($event_date);
		$event_type = rwmb_meta('syafc_event_type', array(), $post->ID);
		$event_volunteers = rwmb_meta('syafc_event_volunteers', array(), $post->ID);

    $posts[ $key ]->event_date = array(
      'month' => $event_date->format('M'),
      'day' => $event_date->format('d')
    );
    $posts[ $key ]->event_type = $event_type;
		$posts[ $key ]->need_volunteers = $event_volunteers;
    $posts[ $key ]->permalink = get_permalink($post->ID);
  }
  return $posts;
}

function filter_events() {
	if ( !wp_verify_nonce( $_REQUEST['nonce'], "event_nonce")) {
    exit("Request not verified.");
  }

	//add metadata filter for custom values
	add_filter( 'the_posts', 'add_event_extras', 10 );

	// get request params
	$event_type = json_decode(stripslashes($_REQUEST['event_type']));
	$today = date('Y-m-d');
	$event_args = array(
		'post_type' => 'event',
		'orderby' => 'meta_value',
		'order' => 'ASC',
		'meta_query' => array(
			array(
				'meta_key' => 'syafc_event_date',
				'meta_value' => $today,
				'meta_compare' => '>=',
			)
		),
		'posts_per_page' => -1,
		'post_status' => 'publish'
	);
	if (!empty($event_type)) {
		$event_args['meta_query']['relation'] = 'AND';
		array_push($event_args['meta_query'], array(
			'meta_key' => 'syafc_event_type',
			'meta_value' => $event_type,
			'meta_compare' => '='
		));
	}
	$events = new WP_Query($event_args);

	$result['type'] = "success";
  $result['events'] = $events->posts;
	$result = json_encode($result);
	print_r($result);

  die();
}
