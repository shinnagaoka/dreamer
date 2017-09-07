(function() {
    'use strict';

    $(dataMaps);

    function dataMaps() {

        var elMapBasic = document.getElementById('datamap-basic');
        var elMapArc = document.getElementById('datamap-arc');

        if(!elMapBasic || !elMapArc) return;

        var mapBasic = new Datamap({
            element: elMapBasic,
            scope: 'usa',
            responsive: true,
            options: {
                width: 1110,
                legendHeight: 60 // optionally set the padding for the legend
            },
            geographyConfig: {
                highlightFillColor: Colors.byName('deepPurple-300'),
                highlightBorderWidth: 0
            },
            fills: {
                'HIGH': Colors.byName('deepPurple-300'),
                'MEDIUM': Colors.byName('deepPurple-300'),
                'LOW': Colors.byName('deepPurple-300'),
                'defaultFill': Colors.byName('gray-lighter')
            },
            data: {
                'AZ': {
                    'fillKey': 'MEDIUM',
                },
                'CO': {
                    'fillKey': 'HIGH',
                },
                'DE': {
                    'fillKey': 'LOW',
                },
                'GA': {
                    'fillKey': 'MEDIUM',
                }
            }
        });


        var mapArc = new Datamap({
            element: elMapArc,
            scope: 'usa',
            responsive: true,
            fills: {
                defaultFill: Colors.byName('gray-lighter'),
                win: Colors.byName('blueGrey-700'),
            },
            geographyConfig: {
                borderWidth: 0,
                highlightFillColor: Colors.byName('gray-light'),
                highlightBorderWidth: 0
            },
            data: {
                'TX': {
                    fillKey: 'win'
                },
                'FL': {
                    fillKey: 'win'
                },
                'NC': {
                    fillKey: 'win'
                },
                'CA': {
                    fillKey: 'win'
                },
                'NY': {
                    fillKey: 'win'
                },
                'CO': {
                    fillKey: 'win'
                }
            }
        });

        mapArc.arc([{
            origin: 'CA',
            destination: 'TX',
            options: {
                strokeWidth: 3,
                strokeColor: Colors.byName('warning'),
            }
        }, {
            origin: 'OR',
            destination: 'TX',
            options: {
                strokeWidth: 3,
                strokeColor: Colors.byName('warning'),
            }
        }, {
            origin: 'NY',
            destination: 'TX',
            options: {
                strokeWidth: 3,
                strokeColor: Colors.byName('warning'),
            }
        }]);

        // Allow resize by hooking window resize event
        $(window).resize(function(){
            mapArc.resize();
            mapBasic.resize();
        });

    }



})();