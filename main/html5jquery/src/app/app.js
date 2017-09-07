/*!
 *
 * Dasha - Bootstrap Admin Template
 *
 * Version: 1.0.0
 * Author: @themicon_co
 * Website: http://themicon.co
 * License: https://wrapbootstrap.com/help/licenses
 *
 */

// APP START
// -----------------------------------

(function() {
    'use strict';

    // Disable warning "Synchronous XMLHttpRequest on the main thread is deprecated.."
    $.ajaxPrefilter(function(options) {
        options.async = true;
    });

    // used for the preloader
    $(function() { document.body.style.opacity = 1; });

})();
