<?php
  /*
  * Theme Header file
  * contains opening <body> tag and the <header>
  */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php wp_head(); ?>

  <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto:400,400i,700" rel="stylesheet" type="text/css">
  <link rel="icon" href="<?php bloginfo('url'); ?>/images/favicon.png">
  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">

</head>

<body>
  <header class="page-header" role="banner">
    <div class="row">
    <?php
      if(is_front_page()):
        $home_id = get_option( 'page_on_front' );
        $services_id = rwmb_meta('syafc_services_page', array(), $home_id);
        $services_slug = get_the_permalink($services_id);
    ?>
      <div class="home-banner-callouts">
        <a href="<?php echo $services_slug . rwmb_meta('syafc_education_service_slug'); ?>" class="education">
          <span><?php echo rwmb_meta('syafc_education_service_name')?></span>
        </a>
        <a href="<?php echo $services_slug . rwmb_meta('syafc_social_service_slug'); ?>" class="social-services">
          <span><?php echo rwmb_meta('syafc_social_service_name')?></span>
        </a>
        <a href="<?php echo $services_slug . rwmb_meta('syafc_family_service_slug'); ?>" class="family">
          <span><?php echo rwmb_meta('syafc_family_service_name')?></span>
        </a>
        <a href="<?php echo $services_slug . rwmb_meta('syafc_immigration_service_slug'); ?>" class="immigration">
          <span><?php echo rwmb_meta('syafc_immigration_service_name')?></span>
        </a>
      </div>
    <?php else: ?>
      <a class="logo" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
    <?php endif; ?>
    </div>
  </header>
  <nav class="nav-main" role="navigation">
    <div class="row">
      <a href="#" class="mobile-menu-trigger js-menu-trigger">Menu <i class="icon-menu"></i></a>
      <?php
        if (has_nav_menu('primary_navigation')) {
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'menu main-menu' ));
        }
        get_template_part('searchform');
      ?>
    </div>
  </nav>
