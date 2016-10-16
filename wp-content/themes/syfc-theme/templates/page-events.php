<?php
  /* Template Name: Events Page Template */
  get_header();
  $nonce = wp_create_nonce("event_nonce");
?>

<div class="content-row">
  <?php while (have_posts()) : the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>
  <?php endwhile; ?>
</div>

<div class="row">
  <aside class="event-filters">
    <div class="filter-box">
      <h4>Filter by Event Type</h4>
      <ul class="menu js-event-filters">
        <?php # these are defined in inc/meta-fields.php // would be good to define only once ?>
        <li><a href="#" data-type="all" class="event-filter selected">All Events</a></li>
        <li><a href="#" data-type="workshop" class="event-filter">Workshop</a></li>
        <li><a href="#" data-type="cafe" class="event-filter">Community Cafe</a></li>
        <li><a href="#" data-type="outreach" class="event-filter">Outreach</a></li>
      </ul>
    </div>
  </aside>
  <ul class="event-list menu" data-nonce="<?php echo $nonce; ?>"></ul>
</div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCvvaeIF0uoGD-0TAt92sv2x3aTZGqgKbg"></script>

<?php
  get_footer();
?>
