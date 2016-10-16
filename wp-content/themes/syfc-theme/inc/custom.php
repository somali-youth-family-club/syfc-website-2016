<?php
/**
 * Custom functions
 */

/**
* Event filter ajax functions
*/
add_action("wp_ajax_filter_events", "filter_events");
add_action("wp_ajax_nopriv_filter_events", "filter_events");

function filter_events() {
	if ( !wp_verify_nonce( $_REQUEST['nonce'], "event_nonce")) {
    exit("Request not verified.");
  }

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
