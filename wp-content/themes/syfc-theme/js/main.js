(function($) {
  'use strict';

  // google maps
  var key = 'AIzaSyCvvaeIF0uoGD-0TAt92sv2x3aTZGqgKbg';

  function displayMapBox(el, address) {
    console.log("displaying map on", el);
    var geocoder, map;
    geocoder = new google.maps.Geocoder();
    var mapOptions = {
      zoom: 15,
      center: new google.maps.LatLng(47.6062, 122.3321),
      zoomControl: true,
      mapTypeControl: false
      //'styles': styles,
    };
    map = new google.maps.Map(el, mapOptions);
    if (geocoder) {
      geocoder.geocode({address: address}, function(result, status) {
        if (status === google.maps.GeocoderStatus.OK && status != google.maps.GeocoderStatus.ZERO_RESULTS) {
          map.setCenter(result[0].geometry.location);
          var marker = new google.maps.Marker({
            position: result[0].geometry.location,
            map: map,
            title: address
          });
        } else {
          console.log("geocoding address failed:", status);
        }
      });
    }
  }

  var $mapContainers = $('.map-box'),
      address;
  $mapContainers.each(function() {
    address = $(this).data('address');
    console.log(address);
    displayMapBox(this, address);
  });

  // accordions
  var $accordions = $('.js-accordion-content');
  if ($accordions.length > 0) {
    console.log('we have accordions');
    $accordions.each(function() {
      var $this = $(this);
      $this.data('height', $this.height());
      this.style.height = 0;
    });
    $(document.body).on('click', '.js-accordion-trigger', function(e) {
      e.preventDefault();

      var $this = $(this),
          $content = $(this).next('.js-accordion-content');

      if ($this.hasClass('open')) {
        $this.removeClass('open');
        $content.css('height', 0);
      } else {
        $this.addClass('open');
        $content.css('height', $content.data('height') + 'px');
      }
    });

    // trigger click if linking to a specific accordion
    if (window.location.hash) {
      var target = document.getElementById(window.location.hash.substring(1));
      if (target) {
        $(target).trigger('click');
      }
    }
  }

}(jQuery));
