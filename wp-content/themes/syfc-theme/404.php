<?php
  /* 404 Page */
  get_header();
?>

<div class="content row">
	<div class="alert">
	  <?php _e('Sorry, but the page you were trying to view does not exist.', 'bamboo'); ?>
	</div>

	<?php get_search_form(); ?>
</div>

<?php
  get_footer();
?>
