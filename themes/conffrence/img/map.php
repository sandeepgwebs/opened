

<!DOCTYPE html>
<html>
  <head>
    <title>Encoding methods</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      #right-panel {
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }

      #right-panel select, #right-panel input {
        font-size: 15px;
      }

      #right-panel select {
        width: 100%;
      }

      #right-panel i {
        font-size: 12px;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
        width: 50%;
        float: left;
      }
      #right-panel {
        width: 46%;
        float: left;
      }
      #encoded-polyline {
        height: 100px;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <div id="right-panel">
      <div>Encoding:</div>
      <textarea id="encoded-polyline"></textarea>
    </div>
    <?php
$str = "var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: {lat: 34.366, lng: -89.519}
        });
        var poly = new google.maps.Polyline({
          strokeColor: '#000000',
          strokeOpacity: 1,
          strokeWeight: 3,
          map: map
        });

        // Add a listener for the click event
        google.maps.event.addListener(map, 'click', function(event) {
          addLatLngToPoly(event.latLng, poly);
        });";

// Outputs: A 'quote' is &lt;b&gt;bold&lt;/b&gt;
$str1 = htmlentities($str);
echo htmlentities($str1, ENT_QUOTES);
?>
    <script>
      // This example requires the Geometry library. Include the libraries=geometry
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQ83g_xvNMf7FM52usa-R1If3xwALwy0Y&libraries=geometry">

      function initMap() {
        <?php
        
        echo $str1;
        ?>
      }

   
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQ83g_xvNMf7FM52usa-R1If3xwALwy0Y&libraries=geometry&callback=initMap"
        async defer></script>
  </body>
</html>