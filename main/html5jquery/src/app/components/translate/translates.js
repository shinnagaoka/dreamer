(function() {
    'use strict';

    $(initTranslation);

    // Global configuration
    var preferredLang = 'en';
    var pathPrefix    = 'static/i18n'; // folder of json files
    var packName      = 'site';

    function initTranslation() {

        if (!$.fn.localize) return;

        // set initial options
        var opts = {
            language: preferredLang,
            pathPrefix: pathPrefix,
            callback: function(data, defaultCallback) {
                defaultCallback(data);
            }
        };

        // Set initial language
        setLanguage(opts);

        // Listen for changes
        $('.language-select').on('change', function() {

            var selectedLang = this.value;

            if (selectedLang && opts.language !== selectedLang) {

                opts.language = selectedLang;

                setLanguage(opts);

                activateDropdown($(this));
            }

        });
    }

    // Update translated text
    function setLanguage(options) {
        $('[data-localize]').localize(packName, options);
    }

    // Set the current clicked text as the active dropdown text
    function activateDropdown(elem) {
        var menu = elem.parents('.dropdown-menu');
        if (menu.length) {
            var toggle = menu.prev('button, a');
            toggle.text(elem.text());
        }
    }

})();
