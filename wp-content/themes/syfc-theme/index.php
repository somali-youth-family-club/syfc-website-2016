<?php
  /* Main Loop Template */
  get_header();
?>

<div class="row">
  <?php if (!have_posts()) : ?>
    <div class="alert">
      <?php _e('Sorry, no results were found', 'mboy'); ?>
      <?php if (is_search()) { echo ' for ' . get_search_query(); } ?>
    </div>
  <?php endif; ?>

  <ul class="news-list">
  <?php while (have_posts()) : the_post(); ?>
    <li><?php get_template_part('content', get_post_format()); ?></li>
  <?php endwhile; ?>
  </ul>

  <?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <?php
    //numbered pagination
    $big = 999999999; // need an unlikely integer
    echo paginate_links(array(
      'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'format' => '?paged=%#%',
      'current' => max( 1, get_query_var('paged') ),
      'total' => $wp_query->max_num_pages,
      'mid_size' => 3,
      'prev_next' => True,
      'prev_text' => '&laquo;',
      'next_text' => '&raquo;',
      'type' => 'list'
    ) ); ?>
  </nav>
<?php endif; ?>
</div>

<?php
get_footer();
?>
