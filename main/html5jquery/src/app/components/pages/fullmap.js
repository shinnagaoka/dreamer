(function() {
    'use strict';

    $(googleMapsFull);

    function googleMapsFull() {

        if (document.getElementById('mapfull-markers')) {

            // custom style definition
            var MapStyles = [{ featureType: 'water', stylers: [{ visibility: 'on' }, { color: '#bdd1f9' }] }, { featureType: 'all', elementType: 'labels.text.fill', stylers: [{ color: '#334165' }] }, { featureType: 'landscape', stylers: [{ color: '#e9ebf1' }] }, { featureType: 'road.highway', elementType: 'geometry', stylers: [{ color: '#c5c6c6' }] }, { featureType: 'road.arterial', elementType: 'geometry', stylers: [{ color: '#fff' }] }, { featureType: 'road.local', elementType: 'geometry', stylers: [{ color: '#fff' }] }, { featureType: 'transit', elementType: 'geometry', stylers: [{ color: '#d8dbe0' }] }, { featureType: 'poi', elementType: 'geometry', stylers: [{ color: '#cfd5e0' }] }, { featureType: 'administrative', stylers: [{ visibility: 'on' }, { lightness: 33 }] }, { featureType: 'poi.park', elementType: 'labels', stylers: [{ visibility: 'on' }, { lightness: 20 }] }, { featureType: 'road', stylers: [{ color: '#d8dbe0', lightness: 20 }] }];
            // markers for map
            var myMarkers = [
                { id: 0, name: 'Canada', coords: { latitude: 56.130366, longitude: -106.346771 } },
                { id: 1, name: 'New York', coords: { latitude: 40.712784, longitude: -74.005941 } },
                { id: 2, name: 'Toronto', coords: { latitude: 43.653226, longitude: -79.383184 } },
                { id: 3, name: 'San Francisco', coords: { latitude: 37.774929, longitude: -122.419416 } },
                { id: 4, name: 'Utah', coords: { latitude: 39.320980, longitude: -111.093731 } }
            ];
            // Prepare the map
            var mapFull = new GMaps({
                div: '#mapfull-markers',
                lat: myMarkers[0].coords.latitude,
                lng: myMarkers[0].coords.longitude,
                zoom: 4
            });

            // Add custom styles
            mapFull.addStyle({
                styledMapName: 'Styled Map',
                styles: MapStyles,
                mapTypeId: 'map_style'
            });
            mapFull.setStyle('map_style');

            // Add custom markers
            for (var i = 0; i < myMarkers.length; i++) {
                mapFull.addMarker({
                    lat: myMarkers[i].coords.latitude,
                    lng: myMarkers[i].coords.longitude,
                    //title: 'Marker with InfoWindow',
                    infoWindow: {
                        content: '<p>' + myMarkers[i].name + '</p>'
                    }
                });
            }

            // Panto marker using the data attribute
            $('#markers-list').on('click', '[data-panto-marker]', function() {
                var markers = mapFull.markers;
                var id = $(this).data('pantoMarker');
                if (markers[id])
                    mapFull.map.panTo(markers[id].getPosition());
            });
        }
    }
})();