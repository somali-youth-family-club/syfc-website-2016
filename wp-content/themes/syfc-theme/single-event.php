<?php
	/* Single Post Template */
	get_header();
?>

	<div class="row content">
		<?php while (have_posts()) : the_post();
			$type = rwmb_meta('syafc_event_type');
			$date = rwmb_meta('syafc_event_date');
			$time = rwmb_meta('syafc_event_time');
		?>

		  <article class="event-box">

		    <header>
		      <h2><?php the_title(); ?></h2>
					<?php $date =new DateTime($date); ?>
		    	<div class="date">
						<?php echo date_format($date, 'M'); ?>
						<span class="day"><?php echo date_format($date, 'j'); ?></span>
					</div>
					<div class="event-meta">
						<?php if($time) { echo '<span class="time">' . date_format(new DateTime($time), ' g:ia') . '</span> &bull;'; } ?>
						<span class="type"><?php echo ucfirst($type); ?></span>
					</div>
		    </header>

		    <?php if(has_post_thumbnail()): ?>
		    <div class="featured-image">
		      <?php the_post_thumbnail(); ?>
		    </div>
		    <?php endif; ?>

		    <div class="entry">
		      <?php the_content(); ?>
		    </div>

		    <!--<div class="event-type">-->
		    <!--	<label for="event_type">This event is a </label>-->
		    <!--	<?php foreach($types as $type) {print_r($type);}?>-->
		    <!--</div>-->


		    <!--Volunteer information goes here-->
		    <?php
				if(true):
					?>
		    <?php endif; ?>


		  </article>

		<?php endwhile; ?>
	</div>

<?php
	get_footer();
?>
