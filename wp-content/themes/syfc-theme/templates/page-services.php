<?php
  /* Template Name: Service Page Template */
  get_header();
?>

<div class="row content">
  <?php while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
  <?php endwhile; ?>

  <?php
    // get all services, and display offices below them
    $services = get_terms('service', array('hide_empty' => false));
    $offices = new WP_Query(array(
      'post_type' => 'office',
      'orderby' => 'title',
      'order' => 'ASC',
      'posts_per_page' => -1,
      'post_status' => 'publish'
    ));
    $service_offices = array();
    if( !empty($services) && !is_wp_error($services) ):
      foreach( $services as $service ):
        # only show service box if there are offices for it
        $service_offices = array();
        while( $offices->have_posts()) {
          $offices->the_post();
          $service_list = rwmb_meta('syafc_office_services', 'type=checkbox_list');
          if (in_array($service->term_id, $service_list)) {
            array_push($service_offices, get_the_ID());
          }
        }
        if( !empty($service_offices) ):
  ?>
  <div class="service-accordion js-accordion">
    <div class="js-accordion-trigger service-summary" id="<?php echo $service->slug; ?>">
      <h2><?php echo $service->name; ?></h2>
      <p><?php echo $service->description; ?></p>
    </div>
    <div class="js-accordion-content">
    <?php
      while ( $offices->have_posts() ): $offices->the_post();
        $service_list = rwmb_meta('syafc_office_services', 'type=checkbox_list');
        $phone = rwmb_meta('syafc_office_phone');
        $hours = rwmb_meta('syafc_office_hours');
        $address = rwmb_meta('syafc_office_address');
        if (in_array($service->term_id, $service_list)):
    ?>
      <div class="office-box">
        <h3><?php the_title(); ?></h3>
        <p class="office-meta">
          <?php if($phone) { echo '<span class="phone">' . $phone . ' </span>'; } ?>
          <?php if($hours) { echo '<span class="hours">' . $hours . '</span>'; }?>
        </p>
        <div class="map-box js-map" data-address="<?php echo $address; ?>"></div>
        <span class="office-meta address"><?php echo $address; ?></span>
      </div>
    <?php
        endif;
      endwhile;
    ?>
    </div>
  </div>
  <?php
        endif;
      endforeach;
    endif;
  ?>
</div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCvvaeIF0uoGD-0TAt92sv2x3aTZGqgKbg"></script>

<?php
  get_footer();
?>
