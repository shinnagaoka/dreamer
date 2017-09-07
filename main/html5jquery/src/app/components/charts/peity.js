(function() {
    'use strict';

    $(initPeity);

    function initPeity() {

        if (!$.fn.peity) return;

        $('.peity-pie').peity('pie', {
            radius: 25,
            fill: [Colors.byName('deepPurple-100'), Colors.byName('deepPurple-400'), Colors.byName('deepPurple-700')]
        });

        $('.peity-donut').peity('donut', {
            radius: 25,
            fill: [Colors.byName('pink-100'), Colors.byName('pink-400'), Colors.byName('pink-700')]
        });

        $('.peity-line').peity('line', {
            height: 40,
            width: 100,
            strokeWidth: 3,
            stroke: Colors.byName('teal-500'),
            fill: Colors.byName('teal-100')
        });

        $('.peity-bar').peity('bar', {
            height: 40,
            width: 100,
            fill: [Colors.byName('cyan-100'), Colors.byName('cyan-400'), Colors.byName('cyan-700')]
        });

        // Real time example

        var updatingChart = $('.realtime-peity-chart').peity('line', {
            fill: Colors.byName('green-200'),
            stroke: Colors.byName('green-500'),
            width: '100%',
            height: 60
        });

        setInterval(function() {
            var random = Math.round(Math.random() * 10);
            var values = updatingChart.text().split(',');
            values.shift();
            values.push(random);

            updatingChart
                .text(values.join(','))
                .change();
        }, 1000);

    }

})();