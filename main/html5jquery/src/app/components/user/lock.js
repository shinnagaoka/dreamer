
(function() {
    'use strict';

    $(userLock);

    function userLock() {

        if (!$.fn.validate) return;

        var $form = $('#user-lock');
        $form.validate({
            errorPlacement: errorPlacementInput,
            // Form rules
            rules: {
                accountName: {
                    required: true,
                    email: true
                }
            },
            submitHandler: function(/*form*/) {
                // form.submit();
                console.log('Form submitted!');
                // move to dashboard
                window.location.href = 'dashboard.html';
            }
        });
    }


    // Necessary to place dyncamic error messages
    // without breaking the expected markup for custom input
    function errorPlacementInput(error, element) {
        if ( element.is(':radio') || element.is(':checkbox')) {
            error.insertBefore(element.parent());
        }
        else if ( element.parent().is('.input-group') ) {
            error.insertBefore(element.parent());
        }
        else {
            error.insertBefore(element);
        }
    }

})();