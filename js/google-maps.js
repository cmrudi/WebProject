      var map;
      var src = 'http://piknix.co.id/piknix6.kmz';

      /**
       * Initializes the map and calls the function that loads the KML layer.
       */
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-19.257753, 146.823688),
          zoom: 2,
          mapTypeId: 'terrain'
        });
        loadKmlLayer(src, map);
      }

      /**
       * Adds a KMLLayer based on the URL passed. Clicking on a marker
       * results in the balloon content being loaded into the right-hand div.
       * @param {string} src A URL for a KML file.
       */
      function loadKmlLayer(src, map) {
        var kmlLayer = new google.maps.KmlLayer(src, {
          suppressInfoWindows: true,
          preserveViewport: false,
          map: map
        });
       


        google.maps.event.addListener(kmlLayer, 'click', function(event) {
          var query = window.location.search.substring(1);
          var query2 = query.split('id=');
          var userId = parseInt(query2[1]);
          var content = event.featureData.infoWindowHtml;
          var parseId = content.split('<div>');
          var id = parseInt(parseId[1]);
          if (userId == 0) {
            window.location.href = "http://"+window.location.hostname+"/Piknix/landing-chatroom.php?loc="+id+"&id="+userId;
          }
          else {
            window.location.href = "http://"+window.location.hostname+"/Piknix/chatroom.php?loc="+id+"&id="+userId;
          }
          var testimonial = document.getElementById('capture');
          testimonial.innerHTML = content;
        });

      }

     


 