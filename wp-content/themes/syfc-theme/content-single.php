<?php while (have_posts()) : the_post(); ?>

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

    <footer>
      <?php comments_template('/comments.php'); ?>
    </footer>
  </article>

<?php endwhile; ?>
