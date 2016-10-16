<?php
	/* Default Page Template */
	get_header();
?>

<div class="row content">
	<?php while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
  <?php endwhile; ?>
</div>

<?php
	get_footer();
?>
