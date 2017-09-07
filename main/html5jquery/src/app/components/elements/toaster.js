(function() {
    'use strict';

    $(runToaster);

    function runToaster() {

        $('#clear-toaster').click(function(){
            toastr.clear();
        });

        $('#top-right-info').click(showToaster('info', 'toast-top-right'));
        $('#top-left-info').click(showToaster('info', 'toast-top-left'));
        $('#bottom-right-info').click(showToaster('info', 'toast-bottom-right'));
        $('#bottom-left-info').click(showToaster('info', 'toast-bottom-left'));

        $('#top-right-success').click(showToaster('success', 'toast-top-right'));
        $('#top-left-success').click(showToaster('success', 'toast-top-left'));
        $('#bottom-right-success').click(showToaster('success', 'toast-bottom-right'));
        $('#bottom-left-success').click(showToaster('success', 'toast-bottom-left'));

        $('#top-right-warning').click(showToaster('warning', 'toast-top-right'));
        $('#top-left-warning').click(showToaster('warning', 'toast-top-left'));
        $('#bottom-right-warning').click(showToaster('warning', 'toast-bottom-right'));
        $('#bottom-left-warning').click(showToaster('warning', 'toast-bottom-left'));

        $('#top-right-error').click(showToaster('error', 'toast-top-right'));
        $('#top-left-error').click(showToaster('error', 'toast-top-left'));
        $('#bottom-right-error').click(showToaster('error', 'toast-bottom-right'));
        $('#bottom-left-error').click(showToaster('error', 'toast-bottom-left'));

        function showToaster(type, positionClass) {
            return function() {
                toastr.options.positionClass = positionClass;
                toastr[type]('My name is Inigo Montoya. You killed my father, prepare to die!');
            };
        }

    }
})();
