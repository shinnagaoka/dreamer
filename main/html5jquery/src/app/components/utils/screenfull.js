(function() {
    'use strict';

    $(initScreenfull);

    function initScreenfull() {
        var element = $('[data-toggle-fullscreen]');
        // Not supported under IE
        if (msie()) {
            element.hide();
        } else {
            element.on('click', function(e) {
                e.preventDefault();

                if (screenfull.enabled) {

                    screenfull.toggle();

                } else {
                    // Fullscreen not enabled
                }

            });
        }
    }

    function msie() {
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf('MSIE ');
        return (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./));
    }

})();