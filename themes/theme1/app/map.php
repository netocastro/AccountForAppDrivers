<?php $v->layout('_template'); ?>

<h1>Mapa</h1>
<style>
      #map {
            width: 100%;
            height: 500px;
            border: 1px solid red;
      }
</style>
<div id="map"></div>



<?php $v->start('js'); ?>


<script>
      var map = L.map('map').setView([-9.512724858670227, -35.80729991197587], 16);
      L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: '&copy; <a href=https://www.openstreetmap.org/copyrght">openstreetmap</a>'
      }).addTo(map);

      map.on('keydown', function() {
            var latlngs = [
                  [45.51, -122.68],
                  [37.77, -122.43],
                  [34.04, -118.2]
            ];

            var polyline = L.polyline(latlngs, {
                  color: 'red'
            }).addTo(map);

            // zoom the map to the polyline
            map.fitBounds(polyline.getBounds());
      })



      /*var map = L.map('map', {
            center: [51.505, -0.09],
            zoom: 13
      }).addTo(map);*/
</script>

<?php $v->end(); ?>