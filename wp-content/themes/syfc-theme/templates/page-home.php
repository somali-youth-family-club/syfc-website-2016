<?php
  /* Template Name: Home Page Template */
  get_header();
?>

<?php while (have_posts()) : the_post(); ?>
<h1 class="visually-hidden"><?php the_title(); ?></h1>
<div class="row home-about-section">
  <div class="about-blurb">
    <div class="logo">The Somali Youth and Family Club</div>
    <p><?php echo rwmb_meta('syafc_home_about_tagline'); ?></p>
  </div>
  <div class="about-content">
    <h2>About Us</h2>
    <?php echo wpautop(rwmb_meta('syafc_home_about_blurb')); ?>
    <?php
      $about_page_id = rwmb_meta('syafc_home_about_link');
    ?>
    <a href="<?php echo get_the_permalink($about_page_id); ?>" class="button">Read More</a>
  </div>
</div>

<?php
  $history_image = rwmb_meta('syafc_home_history_image', 'type=plupload_image&size=half');
  $history_image = reset($history_image);
?>
<div class="home-history-section">
  <div class="row">
    <div class="history-content">
      <h2><?php echo rwmb_meta('syafc_home_history_title'); ?></h2>
      <p><?php echo rwmb_meta('syafc_home_history_blurb'); ?></p>
    </div>
    <div class="history-image">
      <figure class="image-wrapper">
        <img src="<?php echo $history_image['url']; ?>" alt="<?php echo $history_image['title']; ?>">
      </figure>
    </div>
  </div>
</div>

<div class="home-callouts row">
  <div class="donate-callout third">
    <p><?php echo rwmb_meta('syafc_home_donate_desc'); ?></p>
    <?php $page_id = rwmb_meta('syafc_home_donate_link'); ?>
    <a href="<?php echo get_the_permalink($page_id); ?>" class="button">Donate</a>
  </div>
  <div class="volunteer-callout third">
    <p><?php echo rwmb_meta('syafc_home_volunteer_desc'); ?></p>
    <?php $page_id = rwmb_meta('syafc_home_volunteer_link'); ?>
    <a href="<?php echo get_the_permalink($page_id); ?>" class="button">Volunteer</a>
  </div>
  <div class="services-callout third">
    <p><?php echo rwmb_meta('syafc_home_services_desc'); ?></p>
    <?php $page_id = rwmb_meta('syafc_home_services_link'); ?>
    <a href="<?php echo get_the_permalink($page_id); ?>" class="button">Services</a>
  </div>
</div>

<?php endwhile; ?>

<?php
  get_footer();
?>
