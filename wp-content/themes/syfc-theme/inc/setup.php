<?php
/**
 * Bamboo initial setup and constants
 */
function bamboo_setup() {
  // To make theme available for translation, uncomment and add /lang folder
  // load_theme_textdomain('bamboo', get_template_directory() . '/lang');

  // Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
  register_nav_menus(array(
    'primary_navigation' => __('Primary Navigation'),
    'footer_navigation' => __('Footer Navigation'),
  ));

  // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
  add_theme_support('post-thumbnails');
  // set_post_thumbnail_size(300, 300, true);
  add_image_size('half', 480, 9999); //half-column-sized image
  add_image_size('third', 300, 9999); //third-column-sized image

  //add sizes to the media uploader
function add_custom_media_sizes( $imageSizes ) {
  $my_sizes = array(
    'half' => 'Half-Column',
    'third' => 'Third-Column'
  );
  return array_merge( $imageSizes, $my_sizes );
}
add_filter( 'image_size_names_choose', 'add_custom_media_sizes' );

  // Uncomment to add post formats (http://codex.wordpress.org/Post_Formats)
  // add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

  // Uncomment to tell the TinyMCE editor to use a custom stylesheet
  // add_editor_style('/css/editor-style.css');
}
add_action('after_setup_theme', 'bamboo_setup');

// Backwards compatibility for older than PHP 5.3.0
if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }

/**
 * Customize excerpt
 */

function bamboo_excerpt_length($length) {
  return 50;
}
add_filter('excerpt_length', 'bamboo_excerpt_length');

function bamboo_excerpt_more($more) {
  return ' &hellip;';
}
add_filter('excerpt_more', 'bamboo_excerpt_more');

/**
 * main classes to use on body/top-level container, etc
 */
function bamboo_main_class() {
  //get top parent template to check attribute pages
  $parents = get_post_ancestors( $post->ID ); //get ancestors, if they exist
  $id = ($parents) ? $parents[count($parents)-1] : $post->ID; //get top ancestor

  if( is_front_page() ) {
    $class = "home";
  } elseif ( is_home() || get_post_type() == 'post' || is_search() ) {
    $class = "blog";
  } elseif( !is_page_template() ) {
    $class = "subpage";
  } else {
    $class = "";
  }

  //add "child" class if is child
  if($parents) $class .= " child";

  return $class;
}

/**
 * Define helper constants
 */
$get_theme_name = explode('/themes/', get_template_directory());

define('RELATIVE_PLUGIN_PATH',  str_replace(home_url() . '/', '', plugins_url()));
define('RELATIVE_CONTENT_PATH', str_replace(home_url() . '/', '', content_url()));
define('THEME_NAME',            next($get_theme_name));
define('THEME_PATH',            RELATIVE_CONTENT_PATH . '/themes/' . THEME_NAME);


/**
 * Enqueue scripts and stylesheets
 *
 * Enqueue stylesheets:
 * /theme/css/app.css
 *
 * Enqueue scripts in the following order:
 * 1. /theme/js/vendor/modernizr-2.6.2.min.js
 * 2. jquery-1.10.2.min.js via Google CDN
 * 3. /theme/js/app.js (in footer)
 */
function bamboo_scripts() {
  wp_enqueue_style('bamboo_app', get_template_directory_uri() . '/css/app.css', false, null);

  // you can add any custom fonts here

  // jQuery is loaded using the same method from HTML5 Boilerplate
  // It's kept in the header instead of footer to avoid conflicts with plugins.
  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, null, false);
  }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', false, null, false);
  wp_register_script('bamboo_js', get_template_directory_uri() . '/js/app.js', false, null, true);

  wp_enqueue_script('modernizr');
  wp_enqueue_script('jquery');
  wp_enqueue_script('bamboo_js');
}
add_action('wp_enqueue_scripts', 'bamboo_scripts', 100);

/**
 * Add Google Analytics, set in Theme Options
 */
function bamboo_google_analytics() {
  $options = get_option( 'bamboo_theme_options');
  $google_analytics_id = $options['google_analytics'];
  if ($google_analytics_id !== '') {
  ?>
<script>
  var _gaq=[['_setAccount','<?php echo $google_analytics_id; ?>'],['_trackPageview']];
  (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
<?php
  }
}
add_action('wp_footer', 'bamboo_google_analytics', 20);

/**
 * Search both posts and pages with default wordpress search
 * Add any other custom post types here
 */
function bamboo_search_filter( $query ) {
    if ( $query->is_search ) {
        $query->set( 'post_type', array('post','page') );
    }
    return $query;
}
add_filter('pre_get_posts','bamboo_search_filter');
