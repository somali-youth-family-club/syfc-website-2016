<?php
	/* Single Post Template */
	get_header();
?>

	<div class="row content">
		<?php while (have_posts()) : the_post();
			$types = rwmb_meta('syafc_event_type', 'type=checkbox_list');
			$date = rwmb_meta('syafc_event_date');
			$time = rwmb_meta('syafc_event_time');
		?>

		  <article class="post">
		    <header>
		      <h2><?php the_title(); ?></h2>
		    </header>
		
		    <?php if(has_post_thumbnail()): ?>
		    <div class="featured-image">
		      <?php the_post_thumbnail(); ?>
		    </div>
		    <?php endif; ?>
		
		    <div class="entry">
		      <?php the_content(); ?>
		    </div>
		    
		    <div class="event-type">
		    	<?php foreach($types as $type) {print_r($type);}?>
		    </div>
		    
		    <div class="event-date">
		    	<?php print_r($date); ?>
		    </div>
		    	  
		    <div class="event-time">
		    	<?php print_r($time); ?>
		    </div>  
		    
		
		    <footer>
		      <?php comments_template('/comments.php'); ?>
		    </footer>
		  </article>
		
		<?php endwhile; ?>
	</div>

<?php
	get_footer();
?>