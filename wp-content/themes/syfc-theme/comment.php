<?php
echo get_avatar($comment, $size = '60');
?>
<img src="" class="avatar photo" height="60" width="60">
<div class="media-body">
  <span class="comment-author"><?php echo get_comment_author_link(); ?></span> |
  <?php _e('Posted', 'mboy'); ?> <time datetime="<?php echo comment_date('c'); ?>"><?php printf(__('%1$s', 'mboy'), get_comment_date("n-j-y"),  get_comment_time()); ?></time>
  <?php edit_comment_link(__('(Edit)', 'mboy'), '', ''); ?>

  <?php if ($comment->comment_approved == '0') : ?>
    <div class="alert">
      <?php _e('Your comment is awaiting moderation.', 'mboy'); ?>
    </div>
  <?php endif; ?>

  <?php comment_text(); ?>
  <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
