<?php
  /* Template Name: Events Page Template */
  get_header();
  $nonce = wp_create_nonce("event_nonce");
?>

<div class="row content">
  <?php while (have_posts()) : the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>
  <?php endwhile; ?>

  <div class="row">
    <ul class="event-list menu" data-nonce="<?php echo $nonce; ?>">
    <?php
      // get all events with a start date later than today
      $today = date('Y-m-d');
      $events = new WP_Query(array(
        'post_type' => 'event',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'meta_key' => 'syafc_event_date',
        'meta_value' => $today,
        'meta_compare' => '>=',
        'posts_per_page' => -1,
        'post_status' => 'publish'
      ));

      // events loop
      if( $events->have_posts() ):
        while ( $events->have_posts() ) : $events->the_post();
        $event_type = rwmb_meta('syafc_event_type');
      ?>
      <li><?php the_title(); echo $event_type; ?></li>
    <?php
        endwhile;
      endif;
    ?>
    </ul>
    <aside class="event-filters">
    </aside>
  </div>
</div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCvvaeIF0uoGD-0TAt92sv2x3aTZGqgKbg"></script>

<?php
  get_footer();
?>
