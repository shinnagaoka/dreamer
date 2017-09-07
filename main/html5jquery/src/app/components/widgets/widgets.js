(function() {
    'use strict';

    $(initWidgets);

    function initWidgets() {

        if(!$.fn.peity) return;

        $('.line1').peity('line', {
            fill: [Colors.byName('blue-200')],
            stroke: Colors.byName('blue-500'),
            strokeWidth: 2,
            height: 20,
            width: 60
        });

        $('.line2').peity('line', {
            fill: [Colors.byName('green-200')],
            stroke: Colors.byName('green-500'),
            strokeWidth: 2,
            height: 20,
            width: 60
        });

        $('.line3').peity('line', {
            fill: 'rgba(255,255,255,0.5)',
            stroke: '#fff',
            strokeWidth: 2,
            height: 20,
            width: 60
        });

        $('.bar1').peity('bar', {
            fill: [Colors.byName('deepPurple-500')],
            height: 30,
            width: 60
        });

        $('.bar2').peity('bar', {
            fill: [Colors.byName('pink-500')],
            height: 30,
            width: 60
        });

    }


})();