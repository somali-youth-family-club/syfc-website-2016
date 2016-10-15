<?php
/**
 * Make Wordpress prettier by doing the following things:
 * 1. Clean up wp_head
 * 2. Better URLs
 * 3. Custom nav walker
 * 4. Custom comments walker
 */


/**
 * 1. Clean up wp_head()
 *
 * Remove unnecessary <link>'s
 * Remove inline CSS used by Recent Comments widget
 * Remove inline CSS used by posts with galleries
 * Remove self-closing tag and change ''s to "'s on rel_canonical()
 * Site name always appended to title tag
 */
function bamboo_head_cleanup() {
  // Originally from http://wpengineer.com/1438/wordpress-header/
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

  global $wp_widget_factory;
  remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));

  if (!class_exists('WPSEO_Frontend')) {
    remove_action('wp_head', 'rel_canonical');
    add_action('wp_head', 'bamboo_rel_canonical');
  }
}

function bamboo_rel_canonical() {
  global $wp_the_query;

  if (!is_singular()) {
    return;
  }

  if (!$id = $wp_the_query->get_queried_object_id()) {
    return;
  }

  $link = get_permalink($id);
  echo "\t<link rel=\"canonical\" href=\"$link\">\n";
}
add_action('init', 'bamboo_head_cleanup');

/**
 * Remove the WordPress version from RSS feeds
 */
add_filter('the_generator', '__return_false');

/**
 * Manage output of wp_title()
 */
function bamboo_wp_title($title) {
  if (is_feed()) {
    return $title;
  }

  $title .= get_bloginfo('name');

  return $title;
}
add_filter('wp_title', 'bamboo_wp_title', 10);

/**
 * 2. Better URLs:
 * Search results at /search/query instead of ?s=query
 * Better asset URLs
 * Relative page urls
 */

/**
 * Redirects search results from /?s=query to /search/query/, converts %20 to +
 */
function bamboo_search_url() {
  global $wp_rewrite;
  if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->using_permalinks()) {
    return;
  }

  $search_base = $wp_rewrite->search_base;
  if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false) {
    wp_redirect(home_url("/{$search_base}/" . urlencode(get_query_var('s'))));
    exit();
  }
}
add_action('template_redirect', 'bamboo_search_url');

/**
 * URL rewriting
 *
 * Rewrites do not happen for multisite installations or child themes
 * /wp-content/themes/themename/asset_folder/ to /asset_folder/ for js, css, and images
 */

function add_filters($tags, $function) {
  foreach($tags as $tag) {
    add_filter($tag, $function);
  }
}

function bamboo_add_rewrites($content) {
  global $wp_rewrite;
  $bamboo_rewrite_rules = array(
    'css/(.*)'          => THEME_PATH . '/css/$1',
    'js/(.*)'          => THEME_PATH . '/js/$1',
    'images/(.*)'          => THEME_PATH . '/images/$1'
  );
  $wp_rewrite->non_wp_rules = array_merge($wp_rewrite->non_wp_rules, $bamboo_rewrite_rules);
  return $content;
}

function bamboo_clean_urls($content) {
  return str_replace('/' . THEME_PATH, '', $content);
}

if (!is_multisite() && !is_child_theme()) {
  add_action('generate_rewrite_rules', 'bamboo_add_rewrites');

  if (!is_admin()) {
    $tags = array(
      'bloginfo',
      'stylesheet_directory_uri',
      'template_directory_uri',
      'script_loader_src',
      'style_loader_src'
    );

    add_filters($tags, 'bamboo_clean_urls');
  }
}

/**
 * Relative page URLs
 * instead of linking to the absolute url, use relative urls in links/etc
 */
function bamboo_relative_url($input) {
  preg_match('|https?://([^/]+)(/.*)|i', $input, $matches);

  if (isset($matches[1]) && isset($matches[2]) && $matches[1] === $_SERVER['SERVER_NAME']) {
    return wp_make_link_relative($input);
  } else {
    return $input;
  }
}

function enable_bamboo_relative_urls() {
  return !(is_admin() || in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php')));
}

if (enable_bamboo_relative_urls()) {
  $bamboo_rel_filters = array(
    'bloginfo_url',
    'the_permalink',
    'wp_list_pages',
    'wp_list_categories',
    'bamboo_wp_nav_menu_item',
    'the_content_more_link',
    'the_tags',
    'get_pagenum_link',
    'get_comment_link',
    'month_link',
    'day_link',
    'year_link',
    'tag_link',
    'the_author_posts_link',
    'script_loader_src',
    'style_loader_src'
  );

  add_filters($bamboo_rel_filters, 'bamboo_relative_url');
}

/**
 * 3. Cleaner, accessible walker for wp_nav_menu()
 *
 * Walker_Nav_Menu (WordPress default) example output:
 *   <li id="menu-item-8" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8"><a href="/">Home</a></li>
 *   <li id="menu-item-9" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9"><a href="/sample-page/">Sample Page</a></l
 *
 * Bamboo_Nav_Walker example output:
 *   <li class="menu-home"><a href="/">Home</a></li>
 *   <li class="menu-sample-page"><a href="/sample-page/">Sample Page</a></li>
 */
class Bamboo_Nav_Walker extends Walker_Nav_Menu {
  function check_current($classes) {
    return preg_match('/(current[-_])|active|dropdown/', $classes);
  }

  function start_lvl(&$output, $depth = 0, $args = array()) {
    if($depth == 0) {
      $output .= "\n<ul class=\"dropdown-menu\" role=\"menu\">\n";
    } else {
      $output .= "\n<ul class=\"nested-menu\" role=\"menu\">\n";
    }
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $item_html = '';
    parent::start_el($item_html, $item, $depth, $args);

    if ($item->is_dropdown && ($depth === 0)) {
      $item_html = str_replace('<a', '<a class="dropdown-toggle" aria-haspopup="true"', $item_html);
    }
    elseif (stristr($item_html, 'li class="divider')) {
      $item_html = preg_replace('/<a[^>]*>.*?<\/a>/iU', '', $item_html);
    }
    elseif (stristr($item_html, 'li class="dropdown-header')) {
      $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html);
    }

    // all li's should have role="presentation"
    // all links should have role="menuitem"
    $item_html = str_replace('<li', '<li role="presentation"', $item_html);
    $item_html = str_replace('<a', '<a role="menuitem"', $item_html);

    $item_html = apply_filters('bamboo_wp_nav_menu_item', $item_html);
    $output .= $item_html;
  }

  function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
    $element->is_dropdown = ((!empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));

    if ($element->is_dropdown) {
      $element->classes[] = 'dropdown';
    }

    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }
}

/**
 * Remove the id="" on nav menu items
 * Return 'menu-slug' for nav menu classes
 */
function is_element_empty($element) {
 $element = trim($element);
 return empty($element) ? false : true;
}
function bamboo_nav_menu_css_class($classes, $item) {
  $slug = sanitize_title($item->title);
  $classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes);
  $classes = preg_replace('/^((menu|page)[-_\w+]+)+/', '', $classes);

  $classes[] = 'menu-' . $slug;

  $classes = array_unique($classes);

  return array_filter($classes, 'is_element_empty');
}
add_filter('nav_menu_css_class', 'bamboo_nav_menu_css_class', 10, 2);
add_filter('nav_menu_item_id', '__return_null');

/**
 * Clean up wp_nav_menu_args
 *
 * Remove the container
 * Use Bamboo_Nav_Walker() by default
 */
function bamboo_nav_menu_args($args = '') {
  $bamboo_nav_menu_args['container'] = false;

  // get rid of id and add role="menubar"
  $bamboo_nav_menu_args['items_wrap'] = '<ul class="%2$s" role="menubar">%3$s</ul>';

  if (!$args['walker']) {
    $bamboo_nav_menu_args['walker'] = new Bamboo_Nav_Walker();
  }

  return array_merge($args, $bamboo_nav_menu_args);
}
add_filter('wp_nav_menu_args', 'bamboo_nav_menu_args');

/**
 * 4. Use custom media object for listing comments
 *
 */
class Bamboo_Walker_Comment extends Walker_Comment {
  function start_lvl(&$output, $depth = 0, $args = array()) {
    $GLOBALS['comment_depth'] = $depth + 1; ?>
    <ul <?php comment_class('comment-' . get_comment_ID()); ?>>
    <?php
  }

  function end_lvl(&$output, $depth = 0, $args = array()) {
    $GLOBALS['comment_depth'] = $depth + 1;
    echo '</ul>';
  }

  function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0) {
    $depth++;
    $GLOBALS['comment_depth'] = $depth;
    $GLOBALS['comment'] = $comment;

    if (!empty($args['callback'])) {
      call_user_func($args['callback'], $comment, $args, $depth);
      return;
    }

    extract($args, EXTR_SKIP); ?>

  <li id="comment-<?php comment_ID(); ?>" <?php comment_class('media comment-' . get_comment_ID()); ?>>
    <?php include(locate_template('comment.php')); ?>
  <?php
  }

  function end_el(&$output, $comment, $depth = 0, $args = array()) {
    if (!empty($args['end-callback'])) {
      call_user_func($args['end-callback'], $comment, $args, $depth);
      return;
    }
    echo "</div></li>\n";
  }
}
