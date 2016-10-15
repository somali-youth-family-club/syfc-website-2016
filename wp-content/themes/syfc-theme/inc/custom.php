<?php
/**
 * Custom functions
 * Includes sample shortcodes
 */

//fix annoying shortcode/wpautop problems
add_filter('the_content', 'shortcode_empty_paragraph_fix');
function shortcode_empty_paragraph_fix($content) {
	$array = array (
		'<p>[' => '[',
		']</p>' => ']',
		']<br />' => ']'
	);

	$content = strtr($content, $array);
	return $content;
}

//columns
// column group/row: [col-group] [/col-group], no atts
function bamboo_colgroup_func( $atts, $content = null ) {
	extract( shortcode_atts( array(
	), $atts ) );

  return '<div class="nested row">'. do_shortcode($content) .'</div>';
}
add_shortcode( 'col-group', 'bamboo_colgroup_func' );

// half columns: [half] [/half]
function bamboo_halfcol_func( $atts, $content = null ) {
  extract( shortcode_atts( array(
  ), $atts ) );

  return '<div class="half section">'. do_shortcode($content) .'</div>';
}
add_shortcode( 'half', 'bamboo_halfcol_func' );

// third columns: [third] [/third]
function bamboo_thirdcol_func( $atts, $content = null ) {
  extract( shortcode_atts( array(
  ), $atts ) );

  return '<div class="third section">'. do_shortcode($content) .'</div>';
}
add_shortcode( 'third', 'bamboo_thirdcol_func' );

// two-thirds columns: [two-thirds] [/two-thirds]
function bamboo_twothirdscol_func( $atts, $content = null ) {
  extract( shortcode_atts( array(
  ), $atts ) );

  return '<div class="two-thirds section">'. do_shortcode($content) .'</div>';
}
add_shortcode( 'two-thirds', 'bamboo_twothirdscol_func' );

//hook shortcodes into tinymce editor
add_action('init', 'add_bamboo_buttons');
function add_bamboo_buttons() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'bamboo_shortcode_plugin');
     add_filter('mce_buttons', 'bamboo_shortcode_buttons');
   }
}
function bamboo_shortcode_buttons($buttons) {
   array_push($buttons, "half", "third", "two-thirds");
   return $buttons;
}
function bamboo_shortcode_plugin($plugin_array) {
   $plugin_array['mboy'] = get_bloginfo('template_url').'/admin/admincodes.js';
   return $plugin_array;
}