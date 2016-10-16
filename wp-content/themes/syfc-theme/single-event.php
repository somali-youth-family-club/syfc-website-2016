<?php
	/* Single Post Template */
	get_header();
?>

	<div class="row content event-box event-content">
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
		    
		    <!--<div class="event-type">-->
		    <!--	<label for="event_type">This event is a </label>-->
		    <!--	<?php foreach($types as $type) {print_r($type);}?>-->
		    <!--</div>-->
		    
		    <div class="event-date">
		    	<?php $date =new DateTime($date); ?>
		    	<div class="date"><?php echo date_format($date, 'M'); ?><span class="day"><?php echo date_format($date, 'j'); ?></span></div>
		    	
		    </div>
		    
		    <div class="event-time"><?php echo date_format(new DateTime($time), ' g:ia'); ?>.
		    </div>
		    
		    <?php if() ?>
		    
		  </article>
		
		<?php endwhile; ?>
	</div>

<?php
	get_footer();
?>
