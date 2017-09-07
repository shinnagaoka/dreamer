(function() {
    'use strict';

    $(RadialCharts);

    function RadialCharts() {

        if (!$.fn.knob || !$.fn.easyPieChart) return;

        // KNOB Charts

        var knobLoaderOptions1 = {
            width: '50%', // responsive
            displayInput: true,
            thickness: 0.1,
            fgColor: Colors.byName('cyan-500'),
            bgColor: 'rgba(162,162,162, .09)'
        };

        var knobLoaderOptions2 = {
            width: '50%', // responsive
            displayInput: true,
            thickness: 1,
            inputColor: '#fff',
            fgColor: Colors.byName('amber-500'),
            bgColor: Colors.byName('yellow-500'),
            readOnly: true
        };

        var knobLoaderOptions3 = {
            width: '50%', // responsive
            displayInput: true,
            fgColor: Colors.byName('red-500'),
            bgColor: 'rgba(162,162,162, .09)',
            displayPrevious: true,
            thickness: 0.1,
            lineCap: 'round'
        };

        var knobLoaderOptions4 = {
            width: '50%', // responsive
            displayInput: true,
            fgColor: Colors.byName('primary'),
            bgColor: 'rgba(162,162,162, .09)',
            angleOffset: -125,
            angleArc: 250
        };

        $('#knob-chart1').knob(knobLoaderOptions1);
        $('#knob-chart2').knob(knobLoaderOptions2);
        $('#knob-chart3').knob(knobLoaderOptions3);
        $('#knob-chart4').knob(knobLoaderOptions4);

        // Easy Pie Charts

        var pieOptions1 = {
            animate: {
                duration: 800,
                enabled: true
            },
            barColor: Colors.byName('info'),
            trackColor: false,
            scaleColor: false,
            lineWidth: 10,
            lineCap: 'circle'
        };

        var pieOptions2 = {
            animate: {
                duration: 800,
                enabled: true
            },
            barColor: Colors.byName('danger'),
            trackColor: false,
            scaleColor: false,
            lineWidth: 4,
            lineCap: 'circle'
        };

        var pieOptions3 = {
            animate: {
                duration: 800,
                enabled: true
            },
            barColor: Colors.byName('deepPurple-500'),
            trackColor: false,
            scaleColor: Colors.byName('gray'),
            lineWidth: 15,
            lineCap: 'circle'
        };

        var pieOptions4 = {
            animate: {
                duration: 800,
                enabled: true
            },
            barColor: Colors.byName('deepPurple-500'),
            trackColor: 'rgba(162,162,162, .09)',
            scaleColor: Colors.byName('gray-dark'),
            lineWidth: 15,
            lineCap: 'circle'
        };

        $('#easypiechart1').easyPieChart(pieOptions1);
        $('#easypiechart2').easyPieChart(pieOptions2);
        $('#easypiechart3').easyPieChart(pieOptions3);
        $('#easypiechart4').easyPieChart(pieOptions4);

    }
})();