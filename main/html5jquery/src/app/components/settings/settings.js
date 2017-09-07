
(function() {
    'use strict';

    $(initSettings);

    function initSettings() {

        var body = $('body');
        // var sidebar = $('.layout-container > aside');
        // var header = $('.layout-container > header');
        // var brand = sidebar.find('.brand-header');
        // var content = $('.layout-container > main');

        // Handler for themes preview
        $('input[name="setting-theme"]:radio').change(function() {
            body.removeClass(themeClassname);
            body.addClass(this.value);
        });
            // Regular expression for the pattern bg-* to find the background class
            function themeClassname(index, css) {
                var cmatch = css.match(/(^|\s)theme-\S+/g);
                return (cmatch || []).join(' ');
            }

        $('#sidebar-cover').change(function() {
            body[this.checked ? 'addClass' : 'removeClass']('sidebar-cover');
        });

        $('#fixed-footer').change(function() {
            body[this.checked ? 'addClass' : 'removeClass']('footer-fixed');
        });

        var sidebarToolbar = $('.sidebar-toolbar');
        $('#sidebar-showtoolbar').change(function() {
            sidebarToolbar[this.checked ? 'show' : 'hide']();
        });

    }

})();