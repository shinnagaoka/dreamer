
(function() {
    'use strict';

    $(formXeditable);

    function formXeditable() {

        if( !$.fn.editableform ) return;

        // Font Awesome support
        $.fn.editableform.buttons =
            '<button type="submit" class="btn btn-primary editable-submit">' +
            '<i class="icon-fw ion-checkmark"></i>' +
            '</button>' +
            '<button type="button" class="btn btn-secondary editable-cancel">' +
            '<i class="icon-fw ion-close-round"></i>' +
            '</button>';

        //defaults
        // $.fn.editable.defaults.url = 'static/xeditable.res';

        //enable / disable
        var isDisabled = false;
        $('#enable').click(function() {
            isDisabled = !isDisabled;
            $('#x-user .editable').editable('option', 'disabled', isDisabled); // or .editable('toggleDisabled');
            $(this).text(isDisabled ? 'Set enable' : 'Set disable');
        });

        //editables
        $('#username').editable({
            type: 'text',
            pk: 1,
            name: 'username',
            title: 'Enter username',
            mode: 'inline'
        });

        $('#firstname').editable({
            validate: function(value) {
                if ($.trim(value) === '') return 'This field is required';
            },
            mode: 'inline'
        });

        $('#sex').editable({
            prepend: 'not selected',
            mode: 'inline',
            source: [{
                value: 1,
                text: 'Male'
            }, {
                value: 2,
                text: 'Female'
            }],
            display: function(value, sourceData) {
                var colors = {
                        '': 'gray',
                        1: 'green',
                        2: 'blue'
                    },
                    elem = $.grep(sourceData, function(o) {
                        return o.value === value;
                    });

                if (elem.length) {
                    $(this).text(elem[0].text).css('color', colors[value]);
                } else {
                    $(this).empty();
                }
            }
        });

        $('#status').editable({
            mode: 'inline'
        });

        $('#group').editable({
            showbuttons: false,
            mode: 'inline'
        });

        $('#dob').editable({
            mode: 'inline'
        });

        $('#event').editable({
            placement: 'right',
            combodate: {
                firstItem: 'name'
            },
            mode: 'inline'
        });

        $('#comments').editable({
            showbuttons: 'bottom',
            mode: 'inline'
        });

        $('#note').editable({
            mode: 'inline'
        });

        $('#pencil').click(function(e) {
            e.stopPropagation();
            e.preventDefault();
            $('#note').editable('toggle');
        });

        $('#x-user .editable').on('hidden', function(e, reason) {
            if (reason === 'save' || reason === 'nochange') {
                var $next = $(this).closest('tr').next().find('.editable');
                if ($('#autoopen').is(':checked')) {
                    setTimeout(function() {
                        $next.editable('show');
                    }, 300);
                } else {
                    $next.focus();
                }
            }
        });

        // TABLE
        // -----------------------------------

        $('#x-users a').editable({
            type: 'text',
            name: 'username',
            title: 'Enter username',
            mode: 'inline'
        });

    }

})();
