(function() {
    'use strict';

    $(formWizard);

    function formWizard() {

        if (!$.fn.steps) return;
        if (!$.fn.validate) return;

        var form = $('#example-form');

        form.validate({
            errorPlacement: errorPlacementInput,
            rules: {
                confirm: {
                    equalTo: '#password'
                }
            }
        });

        form.children('div').steps({
            headerTag: 'h4',
            bodyTag: 'fieldset',
            transitionEffect: 'slideLeft',
            onStepChanging: function(/*event, currentIndex, newIndex*/) {
                form.validate().settings.ignore = ':disabled,:hidden';
                return form.valid();
            },
            onFinishing: function(/*event, currentIndex*/) {
                form.validate().settings.ignore = ':disabled';
                return form.valid();
            },
            onFinished: function(/*event, currentIndex*/) {
                alert('Submitted!');

                // Submit form
                $(this).submit();
            }
        });

        // VERTICAL
        // -----------------------------------

        $('#example-vertical')
            .steps({
                headerTag: 'h4',
                bodyTag: 'section',
                transitionEffect: 'slideLeft',
                stepsOrientation: 'vertical'
            });


        // Necessary to place dyncamic error messages
        // without breaking the expected markup for custom input
        function errorPlacementInput(error, element) {
            if (element.is(':radio') || element.is(':checkbox')) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }

    }

})();