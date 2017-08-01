jQuery(document).ready(function($){

  // GOOGLE MAPS
  function initialize() {
    var cpLatLng = new google.maps.LatLng(-16.539509, -68.083924);
    var mapOptions = {
      zoom: 17,
      scrollwheel: false,
      center: cpLatLng,
      mapTypeId: google.maps.MapTypeId.MAP
    }
    var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
    var marker = new google.maps.Marker({
      position: cpLatLng,
      map: map,
      title: 'A ComPás - Danzas Españolas'
    });
    var content_string = '<h2>Telcat Innovations</h2><p>Edif. Torre Ketal, Of. 302, Calle 15</p><p>Calacoto | La Paz - Bolivia</p><p>Teléfono: +591-2-2916262</p>';
    var info_window = new google.maps.InfoWindow({
      content: content_string,
    })
    google.maps.event.addListener(marker, "mouseover", function(){
      info_window.open(map, marker);
    });

    var noPoi = [
    {
        featureType: "poi",
        stylers: [
          { visibility: "off" }
        ]
      }
    ];

    map.setOptions({styles: noPoi});



  }; //initialize()
  google.maps.event.addDomListener(window, 'load', initialize);
  // END google maps

});