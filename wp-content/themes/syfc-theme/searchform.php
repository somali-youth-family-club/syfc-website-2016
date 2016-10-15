<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
  <div class="searchform-wrapper">
    <a href="#searchform" class="search-trigger">View Search Form</a>
    <div class="input-group">
      <label class="hide" for="s"><?php _e('Search for:', 'bamboo'); ?></label>
      <input type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" id="s" class="search-field" placeholder="<?php _e('Search...', 'bamboo'); ?>">
      <button type="submit" class="search-submit"><?php _e('Go', 'bamboo'); ?></button>
    </div>
  </div>
</form>
