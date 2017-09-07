(function() {
    'use strict';

    $(initTimeline);

    function initTimeline() {
        if (document.getElementById('map-tm')) {
            new GMaps({
                div: '#map-tm',
                lat: -12.043333,
                lng: -77.028333
            });
        }
    }

})();
