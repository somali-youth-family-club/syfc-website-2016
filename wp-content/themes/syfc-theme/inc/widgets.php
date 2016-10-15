<?php
/**
 * Register sidebars and widgets
 */
function bamboo_widgets_init() {
  // Sidebars
  register_sidebar(array(
    'name'          => __('Primary', 'bamboo'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));

  // Widgets
  register_widget('Tabbed_Posts_Widget');
}
add_action('widgets_init', 'bamboo_widgets_init');

/**
 * Sample Widget: Tabbed recent/popular/tags widget
 */
class Tabbed_Posts_Widget extends WP_Widget {
  private $fields = array(
    'posts_number' => 'Number of posts to show'
  );

  function __construct() {
    $widget_ops = array('classname' => 'widget_tabbed_posts', 'description' => __('Tabbed recent posts, popular posts, and tags.', 'bamboo'));

    $this->WP_Widget('widget_tabbed_posts', __('Bamboo Widget: Tabbed Posts', 'bamboo'), $widget_ops);
    $this->alt_option_name = 'widget_tabbed_posts';

    add_action('save_post', array(&$this, 'flush_widget_cache'));
    add_action('deleted_post', array(&$this, 'flush_widget_cache'));
    add_action('switch_theme', array(&$this, 'flush_widget_cache'));
  }

  function widget($args, $instance) {
    $cache = wp_cache_get('widget_tabbed_posts', 'widget');

    if (!is_array($cache)) {
      $cache = array();
    }

    if (!isset($args['widget_id'])) {
      $args['widget_id'] = null;
    }

    if (isset($cache[$args['widget_id']])) {
      echo $cache[$args['widget_id']];
      return;
    }

    ob_start();
    extract($args, EXTR_SKIP);

    foreach($this->fields as $name => $label) {
      if (!isset($instance[$name])) { $instance[$name] = ''; }
    }

    $aNumPosts = is_numeric($instance['posts_number']) ? intval($instance['posts_number']) : 4;
    $aRecentPosts = wp_get_recent_posts( array('numberposts' => $aNumPosts, 'post_status' => 'publish') );
    $aPostTags = get_tags();

    echo $before_widget;
  ?>

    <div id="tabbed-posts-widget" class="tabs">
      <ul class="tab-nav menu">
        <li><a href="#tabbed-posts-widget-recent" class="current">Recent</a></li>
        <li><a href="#tabbed-posts-widget-tags">Tags</a></li>
      </ul>

      <div class="tab-content">
        <div id="tabbed-posts-widget-recent" class="tab post-list active">
          <ul class="menu">
            <?php foreach($aRecentPosts as $aRecentPost) { ?>
            <li>
              <?php if(has_post_thumbnail($aRecentPost["ID"])) { echo get_the_post_thumbnail($aRecentPost["ID"], 'thumbnail'); } ?>
              <span><?php echo date('n-d-y', strtotime($aRecentPost["post_date"])); ?></span>
              <a href="<?php echo get_permalink($aRecentPost["ID"]); ?>"><?php echo $aRecentPost["post_title"]; ?></a>
            </li>
            <?php } ?>
          </ul>
        </div>

        <div id="tabbed-posts-widget-tags" class="tab">
          <ul>
            <?php foreach($aPostTags as $aPostTag) { $tag_link = get_tag_link( $aPostTag->term_id ); ?>
            <li>
              <a href="<?php echo $tag_link; ?>"><?php echo $aPostTag->name; ?></a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>

  <?php
    echo $after_widget;

    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_tabbed_posts', $cache, 'widget');
  }

  function update($new_instance, $old_instance) {
    $instance = array_map('strip_tags', $new_instance);

    $this->flush_widget_cache();

    $alloptions = wp_cache_get('alloptions', 'options');

    if (isset($alloptions['widget_tabbed_posts'])) {
      delete_option('widget_tabbed_posts');
    }

    return $instance;
  }

  function flush_widget_cache() {
    wp_cache_delete('widget_tabbed_posts', 'widget');
  }

  function form($instance) {
    foreach($this->fields as $name => $label) {
      ${$name} = isset($instance[$name]) ? esc_attr($instance[$name]) : '';
    ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id($name)); ?>"><?php _e("{$label}:", 'bamboo'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id($name)); ?>" name="<?php echo esc_attr($this->get_field_name($name)); ?>" type="text" value="<?php echo ${$name}; ?>">
    </p>
    <?php
    }
  }
}
