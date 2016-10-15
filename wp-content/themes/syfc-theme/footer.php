<?php
  /*
  * Theme Footer Template
  * Displays the social options from the Theme Options page created in /inc/options.php
  */
  $options = get_option( 'bamboo_theme_options' );
  $phone = $options['phone'];
  $email = $options['email'];
  $twitter = $options['twitter'];
  $linkedin = $options['linkedin'];
  $gplus = $options['gplus'];
?>

<footer class="page-footer" role="contentinfo">
  <div class="row">
    <a class="logo" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>

    <div class="footer-links">
      <?php if($phone) { echo '<span class="phone">' . $phone . '</span>'; } ?>
      <?php if($email) { echo '<a href="mailto:' . $email . '" class="email">Email Us</a>'; } ?>
      <?php if($twitter) { echo '<a href="' . $twitter . '" class="twitter">Twitter</a>'; } ?>
      <?php if($linkedin) { echo '<a href="' . $linkedin . '" class="linkedin">LinkedIn</a>'; } ?>
      <?php if($gplus) { echo '<a href="' . $gplus . '" class="gplus">Google Plus</a>'; } ?>
      <nav class="footer-nav" role="navigation">
        <?php
          if (has_nav_menu('footer_navigation')) :
            wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => 'desktop menu' ));
          endif;
        ?>
      </nav>
    </div><!-- /.footer-links -->
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
