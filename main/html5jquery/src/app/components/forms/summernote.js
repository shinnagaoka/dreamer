(function() {
    'use strict';

    $(formEditor);

    function formEditor() {

        // Summernote HTML editor
        $('.summernote').each(function() {
            $(this).summernote({
                height: 380
            });
        });

        $('.summernote-air').each(function() {
            $(this).summernote({
                airMode: true
            });
        });

        // Hide the initial popovers that display
        $('.note-popover').css({
            'display': 'none'
        });

    }

})();