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
    <ul class="event-list menu" data-nonce="<?php echo $nonce; ?>"></ul>
    <aside class="event-filters">
    </aside>
  </div>
</div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCvvaeIF0uoGD-0TAt92sv2x3aTZGqgKbg"></script>

<?php
  get_footer();
?>
