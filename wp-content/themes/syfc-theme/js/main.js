(function($) {
  'use strict';

  FastClick.attach(document.body);

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

  // open search form
  var $searchTrigger = $('.search-trigger');
  if ($searchTrigger) {
    $searchTrigger.on('click', function(e) {
      e.preventDefault();
      $(this).parents('.search-form').toggleClass('open');
    });
    // close search form if clicking elsewhere
    $(document.body).on('click', function(e) {
      if (!$(event.target).closest('.search-form').length) {
        $searchTrigger.parents('.search-form').removeClass('open');
      }
    });
  }

  // mobile menu
  var $menuTrigger = $('.js-menu-trigger');
  $menuTrigger.on('click', function(e) {
    e.preventDefault();
    $(this).toggleClass('open');
  });
  // max width set in _header.scss
  if (Modernizr.mq('only screen and (max-width: 869px)')) {
    // do mobile menu stuff
  }

  // event filtering ajax call
  function get_wordpress_events($el, type) {
		console.log("getting wordpress events, url is", bambooAjax.ajaxurl);
		var nonce = $el.attr("data-nonce");

    $el.addClass('loading');

    $.ajax({
      dataType : "json",
      url : bambooAjax.ajaxurl,
      data : {
        action: "filter_events",
        event_type: JSON.stringify(type),
        nonce: nonce
      },
      success: function(response) {
				console.log("yay! success!", response);
        if(response.type == "success") {
          console.log(response);
          display_events($el, response.events);
        }
        else {
          console.log("error getting events", response);
        }
      },
      error: function(errorThrown){
       console.log(errorThrown);
      }
    });
  }

  // event display function
  function display_events($el, events) {
    var content = '',
        ev;
    for (var i = 0; i < events.length; i++) {
      ev = events[i];
      content += '<li class="event-box"><div class="date">' + ev.event_date.month + '<span class="day">' + ev.event_date.day + '</span></div>';
      content += '<h3>' + ev.post_title + '</h3>';
      content += '<p>' + ev.post_content.substring(0, 100) + '... </p>';
      if (ev.need_volunteers === '1') {
        content += '<span class="volunteers">We need volunteers!</span>';
      }
      content += '<a href="' + ev.permalink + '" class="button">Full Event</a>';
      content += '</li>';
    }

    $el.removeClass('loading');
    $el.html(content);
  }

  var $event_container = $('.event-list');
  if ($event_container) {
    get_wordpress_events($event_container, '');
  }

}(jQuery));
