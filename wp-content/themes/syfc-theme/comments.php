<?php
  if (post_password_required()) {
    return;
  }
?>
<?php if (have_comments()) : ?>
  <h2><?php comment_form_title(__('Comments', 'bamboo'), __('Leave a Reply to %s', 'bamboo')); ?></h2>
<?php endif; ?>

<?php if (comments_open()) : ?>
  <section id="respond">
    <?php if (!have_comments()) : ?>
      <h2><?php comment_form_title(__('Comments', 'bamboo'), __('Leave a Reply to %s', 'bamboo')); ?></h2>
    <?php endif; ?>
    <p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
    <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
      <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'bamboo'), wp_login_url(get_permalink())); ?></p>
    <?php else : ?>
      <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        <div class="form-group">
          <label for="comment"><?php _e('Leave your comment here', 'bamboo'); ?></label>
          <textarea name="comment" id="comment" class="form-control" rows="5" aria-required="true" placeholder="Leave your comment here"></textarea>
        </div>
        <?php if (is_user_logged_in()) : ?>
          <p>
            <?php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'bamboo'), get_option('siteurl'), $user_identity); ?>
            <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Log out of this account', 'bamboo'); ?>"><?php _e('Log out &raquo;', 'bamboo'); ?></a>
          </p>
        <?php else : ?>
          <div class="form-group">
            <label for="author"><?php _e('Name', 'bamboo'); ?></label>
            <input type="text" class="form-control" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" placeholder="Name" <?php if ($req) echo 'aria-required="true"'; ?>>
          </div>
          <div class="form-group">
            <label for="email"><?php _e('Email', 'bamboo'); ?></label>
            <input type="email" class="form-control" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" placeholder="Email" <?php if ($req) echo 'aria-required="true"'; ?>>
          </div>
        <?php endif; ?>
        <p><input name="submit" class="form-submit" type="submit" id="submit" value="<?php _e('Submit', 'bamboo'); ?>"></p>
        <?php comment_id_fields(); ?>
        <?php do_action('comment_form', $post->ID); ?>
      </form>
    <?php endif; ?>
  </section><!-- /#respond -->
  <?php if (have_comments()) : ?>
    <section id="comments">

      <ol class="media-list menu">
        <?php wp_list_comments(array('walker' => new Bamboo_Walker_Comment)); ?>
      </ol>

      <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
      <nav>
        <ul class="pager">
          <?php if (get_previous_comments_link()) : ?>
            <li class="previous"><?php previous_comments_link(__('&larr; Older comments', 'bamboo')); ?></li>
          <?php endif; ?>
          <?php if (get_next_comments_link()) : ?>
            <li class="next"><?php next_comments_link(__('Newer comments &rarr;', 'bamboo')); ?></li>
          <?php endif; ?>
        </ul>
      </nav>
      <?php endif; ?>

      <?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
      <div class="alert">
        <?php _e('Comments are closed.', 'bamboo'); ?>
      </div>
      <?php endif; ?>
    </section><!-- /#comments -->
  <?php endif; ?>

  <?php if (!have_comments() && !comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
    <section id="comments">
      <div class="alert">
        <?php _e('Comments are closed.', 'bamboo'); ?>
      </div>
    </section><!-- /#comments -->
  <?php endif; ?>

<?php endif; ?>
