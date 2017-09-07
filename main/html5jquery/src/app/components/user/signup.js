
(function() {
    'use strict';

    $(userSignup);

    function userSignup() {

        if (!$.fn.validate) return;

        var $form = $('#user-signup');
        $form.validate({
            errorPlacement: errorPlacementInput,
            // Form rules
            rules: {
                accountName: {
                    required: true,
                    email: true
                },
                accountPassword: {
                    required: true
                },
                accountPasswordCheck: {
                    required: true,
                    equalTo: '#account-password'
                }
            },
            submitHandler: function( /*form*/ ) {
                // form.submit();
                console.log('Form submitted!');
                $('#form-ok').hide().removeClass('invisible').show(500);
            }
        });
    }


    // Necessary to place dyncamic error messages
    // without breaking the expected markup for custom input
    function errorPlacementInput(error, element) {
        if (element.is(':radio') || element.is(':checkbox')) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }

})();