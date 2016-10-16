(function($) {
  'use strict';

  // google maps
  var key = 'AIzaSyCvvaeIF0uoGD-0TAt92sv2x3aTZGqgKbg';
  function getCoordsFromAddress(address, callback) {
    //
  }
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

}(jQuery));
