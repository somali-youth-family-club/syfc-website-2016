<?php
  /* Template Name: Home Page Template */
  get_header();
?>

<div class="row content">
  <?php while (have_posts()) : the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>
  <?php endwhile; ?>
</div>

<?php
  get_footer();
?>
