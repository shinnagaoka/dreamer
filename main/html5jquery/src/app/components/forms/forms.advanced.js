(function() {
    'use strict';

    $(formAdvanced);

    function formAdvanced() {

        if (!$.fn.select2 ||
            !$.fn.datepicker ||
            !$.fn.clockpicker ||
            !$.fn.colorpicker) return;

        // Select 2

        $('#select2-1').select2();
        $('#select2-2').select2();
        $('#select2-3').select2({
            placeholder: 'Select a state',
            allowClear: true
        });
        $('#select2-4').select2({
            data: [{ id: 0, text: 'enhancement' }, { id: 1, text: 'bug' }, { id: 2, text: 'duplicate' }, { id: 3, text: 'invalid' }, { id: 4, text: 'wontfix' }]
        });

        // Datepicker

        $('#example-datepicker-1').datepicker({ autoclose: true });
        $('#example-datepicker-2').datepicker({ autoclose: true });
        $('#example-datepicker-3').datepicker({ autoclose: true });
        $('#example-datepicker-4')
            .datepicker({
                autoclose: true,
                container: '#example-datepicker-container-4'
            });
        $('#example-datepicker-5')
            .datepicker({
                autoclose: true,
                container: '#example-datepicker-container-5'
            });

        // Clockpicker
        var cpInput = $('.clockpicker').clockpicker();
        // auto close picker on scroll
        $('main').scroll(function() {
            cpInput.clockpicker('hide');
        });

        // MultiSelect

        $('#multiselect1').multiSelect();
        $('#optgroup').multiSelect({ selectableOptgroup: true });
        // Public Methods
        var publicMethods = $('#public-methods').multiSelect();
        $('#select-all').click(function() {
            publicMethods.multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            publicMethods.multiSelect('deselect_all');
            return false;
        });
        var demoValues = ['elem_0', 'elem_1', 'elem_2', 'elem_3', 'elem_4', 'elem_5', 'elem_6', 'elem_7', 'elem_8', 'elem_9'];
        $('#select-100').click(function() {
            publicMethods.multiSelect('select', demoValues);
            return false;
        });
        $('#deselect-100').click(function() {
            publicMethods.multiSelect('deselect', demoValues);
            return false;
        });
        $('#refresh').on('click', function() {
            publicMethods.multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function() {
            publicMethods.multiSelect('addOption', { value: 42, text: 'test 42', index: 0 });
            return false;
        });
        // Custom header/footer
        $('#ms-custom').multiSelect({
            selectableHeader: '<div class="bg-primary text-sm py-1 px-2">Selectable items</div>',
            selectionHeader: '<div class="bg-primary text-sm py-1 px-2">Selection items</div>',
            selectableFooter: '<div class="bg-primary text-sm py-1 px-2">Selectable footer</div>',
            selectionFooter: '<div class="bg-primary text-sm py-1 px-2">Selection footer</div>'
        });

        // UI SLider (noUiSlider)

        $('.ui-slider').each(function() {

            noUiSlider.create(this, {
                start: $(this).data('start'),
                connect: true,
                range: {
                    'min': 0,
                    'max': 100,
                }
            });
        });

        // Range selectable
        $('.ui-slider-range').each(function() {
            noUiSlider.create(this, {
                start: [25, 75],
                range: {
                    'min': 0,
                    'max': 100
                },
                connect: true
            });

        });

        // Live Values
        $('.ui-slider-values').each(function() {
            var slider = this;

            noUiSlider.create(slider, {
                start: [35, 75],
                connect: true,
                // direction: 'rtl',
                behaviour: 'tap-drag',
                range: {
                    'min': 0,
                    'max': 100
                }
            });

            slider.noUiSlider.on('slide', updateValues);
            updateValues();

            function updateValues() {
                var values = slider.noUiSlider.get();
                // Connecto to live values
                $('#ui-slider-value-lower').html(values[0]);
                $('#ui-slider-value-upper').html(values[1]);
            }
        });

        // Colorpicker

        $('#cp-demo-basic').colorpicker({
            customClass: 'colorpicker-2x',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        });
        $('#cp-demo-component').colorpicker();
        $('#cp-demo-hex').colorpicker();

        $('#cp-demo-bootstrap').colorpicker({
            colorSelectors: {
                'default': '#777777',
                'primary': '#337ab7',
                'success': '#5cb85c',
                'info': '#5bc0de',
                'warning': '#f0ad4e',
                'danger': '#d9534f'
            }
        });

    }

})();