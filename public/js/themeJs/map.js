
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">


      function initMap() {


        var lat = document.getElementById("latitude").value;
        var long = document.getElementById("longitude").value;
        if(lat != '')
        {
            var latlng = new google.maps.LatLng(lat, long);
            var map = new google.maps.Map(document.getElementById('map'), {
            center: latlng,
            zoom: 13,


        });
        
        var marker = new google.maps.Marker({position: latlng, map: map});
        }
        else
        {
          var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13


        });
        
        
        }
        
       // var card = document.getElementById('pac-card');
         var input = document.getElementById('pac-input');
       // var types = document.getElementById('type-selector');
      //  var strictBounds = document.getElementById('strict-bounds-selector');

       // map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        // Set the data fields to return when the user selects a place.
        autocomplete.setFields(
            ['address_components', 'geometry', 'icon', 'name']);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29),
          draggable: true
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          
          var address = place.name;
          var lat = place.geometry.location.lat();
          var lng = place.geometry.location.lng();
          var placeId = place.place_id;
          // alert(lng);
          document.getElementById("address").value = document.getElementById('pac-input').value;
          document.getElementById("latitude").value = lat;
          document.getElementById("longitude").value = lng;
          if (!place.geometry) 
          {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);
          var place = autocomplete.getPlace();
          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

         // infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);

        });


        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
       /* function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }*/

        /*setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
              console.log('Checkbox clicked! New state=' + this.checked);
              autocomplete.setOptions({strictBounds: this.checked});
            });*/

  google.maps.event.addListener(marker, 'dragend', function(marker) {
  var latLng = marker.latLng;

  currentLatitude = latLng.lat();
  currentLongitude = latLng.lng();
  
  var latlng = {
    lat: currentLatitude,
    lng: currentLongitude,

  };
  var geocoder = new google.maps.Geocoder;
  geocoder.geocode({
    'location': latlng
  }, function(place, status) {
    if (status === 'OK') {
      if (place[0]) {

        input.value = place[0].formatted_address;
        document.getElementById("address").value = document.getElementById('pac-input').value;
        document.getElementById("latitude").value = currentLatitude;
        document.getElementById("longitude").value = currentLongitude;
        

         // infowindowContent.children['place-icon'].src = place.icon;
         var s = place[1].formatted_address;
         var placename = s.split(', ')
         var place_name = placename[0]+','+placename[1];
         var place_address = placename[2];
        
        infowindowContent.children['place-name'].textContent = place_name;
        infowindowContent.children['place-address'].textContent = place_address;
      } else {
        window.alert('No results found');
      }
    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
  });
});

}

      
    