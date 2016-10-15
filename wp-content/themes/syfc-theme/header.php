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

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
  <link rel="icon" href="<?php bloginfo('url'); ?>/images/favicon.png">
  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">

</head>

<body>
  <header class="page-header" role="banner">
    <a class="logo" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
    <nav class="nav-main" role="navigation">
      <?php get_template_part('searchform'); ?>
      <?php
        if (has_nav_menu('primary_navigation')) {
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'menu' ));
        }
      ?>
    </nav>
  </header>
