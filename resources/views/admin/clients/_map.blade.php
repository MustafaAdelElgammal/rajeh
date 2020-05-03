<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxU8F1Zk-GxbnhW4L0xf3NPePbQD4iLbU&language=ar&region=EG&libraries=places">
</script>
<script>

    $.document.ready({

    var geo = {
            lat: parseFloat(document.querySelector('meta[name="lat"]').content),
            lng: parseFloat(document.querySelector('meta[name="lng"]').content)
        },
        draggable =(document.querySelector('meta[name="draggable"]').content==='true');     

    // google.maps.event.addDomListener(window, 'load', initMap);
    /* -----         Loads the map once the page is loaded   ------- */

    function initMap() {
        var myLatLng = geo;

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 5,
            center: myLatLng
        });


        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            draggable: true
        });

        var searchBox = new google.maps.places.SearchBox(document.getElementById('mapSearch'));

        google.maps.event.addDomListener(searchBox, 'places_changed', function() {
            var places = searchBox.getPlaces();
            var bounds = new google.maps.LatLngBounds();
            var i, place;

            for (i = 0; place = places[i]; i++) {
                bounds.extend(place.geometry.location);
                marker.setPosition(place.geometry.location);

                document.getElementById('lat').value = place.geometry.location.lat();
                document.getElementById('lng').value = place.geometry.location.lng();
            }
            map.fitBounds(bounds);
            map.setZoom(15);

        });

        google.maps.event.addListener(marker, 'dragend', function (e) {

            document.getElementById('lat').value = this.getPosition().lat();
            document.getElementById('lng').value = this.getPosition().lng();

        });

    }     

    initMap(); 
    )}; 
</script>
