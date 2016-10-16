(function($) {
  'use strict';

  // google maps
  var key = 'AIzaSyCvvaeIF0uoGD-0TAt92sv2x3aTZGqgKbg';
  function getCoordsFromAddress(address, callback) {
    //
  }
  function displayMapBox(el, coords) {
    var geocoder, map;
    geocoder = new google.maps.Geocoder();
    var mapOptions = {
      zoom: 12,
      center: new google.maps.LatLng(47.6062, 122.3321),
      //'styles': styles,
    };
    map = new google.map.Map(el, mapOptions);
    if (geocoder) {
      geocoder.geocode({address: address});
    }
  }

}(jQuery));
