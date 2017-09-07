(function() {
    'use strict';

    $(initFooTable);

    function initFooTable() {

        if (!$.fn.footable) return;

        $('.footable').footable();

    }

})();