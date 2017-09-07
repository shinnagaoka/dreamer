(function() {
    'use strict';

    $(initDashboard);

    function initDashboard() {

        if (!$.fn.plot || !$.fn.knob) return;

        var knobLoaderOptions1 = {
            width: '80%', // responsive
            displayInput: true,
            fgColor: Colors.byName('primary'),
            bgColor: 'rgba(162,162,162, .09)',
            angleOffset: -125,
            angleArc: 250,
            readOnly: true
        };

        $('#dash-chart1').knob(knobLoaderOptions1);

        // Simulate real time knob chart
        setInterval(function() {
            var endValue = Math.floor(Math.random() * 20) + 20;
            var dial = $('#dash-chart1');
            dial.animate({ value: endValue }, {
                duration: 1000,
                easing: 'swing',
                step: function(now, fx) {
                    fx.now = parseInt(now);
                    dial.val(Math.floor(this.value)).trigger('change');
                }
            });
        }, 2000);

        // Animate progress bars in real time
        var ram = $('#ram'),
            ramvalue = $('#ram-value'),
            io = $('#io'),
            iovalue = $('#io-value');
        setInterval(function() {
            var r = (Math.floor(Math.random() * 20) + 40) + '%';
            var i = (Math.floor(Math.random() * 10) + 20) + '%';
            ramvalue.text(r);
            iovalue.text(i);
            ram.css({ width: r });
            io.css({ width: i });
        }, 4000);

        // Animate counting of numbers
        $('[data-counter]').each(function() {
            var $this = $(this);
            $this.prop('counter', 0).animate({
                counter: $this.data('counter')
            }, {
                duration: 3000,
                easing: 'swing',
                step: function(now) {
                    $this.text(numberWithCommas(Math.ceil(now)));
                }
            });
        });

        function numberWithCommas(x) { // https://stackoverflow.com/a/2901298
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }

        // Main Flot chart
        var splineData = [{
            'label': 'Unique',
            'color': Colors.byName('blue-400'),
            data: [
                ['5', 50],
                ['6', 70],

                ['7', 60],
                ['8', 120],
                ['9', 80],

                ['10', 150],
                ['11', 80],
                ['12', 90]
            ]
        }];
        var splineOptions = {
            series: {
                lines: {
                    show: true,
                    fill: true,
                    fillColor: { colors: [{ opacity: 0 }, { opacity: 1 }] }
                },
                points: {
                    show: true,
                    radius: 3
                }
            },
            grid: {
                borderColor: '#eee',
                borderWidth: 0,
                hoverable: true,
                backgroundColor: 'transparent'
            },
            tooltip: true,
            tooltipOpts: {
                content: function(label, x, y) {
                    return x + ' : ' + y;
                }
            },
            xaxis: {
                show: false,
                tickColor: 'transparent',
                mode: 'categories',
                font: {
                    color: Colors.byName('blueGrey-200')
                }
            },
            yaxis: {
                show: false,
                min: 0,
                max: 180, // optional: use it for a clear representation
                tickColor: 'transparent',
                font: {
                    color: Colors.byName('blueGrey-200')
                },
                //position: 'right' or 'left',
                tickFormatter: function(v) {
                    return v /* + ' visitors'*/ ;
                }
            },
            legend: false,
            shadowSize: 0
        };

        $('#flot-main-spline').each(function() {
            var $el = $(this);
            if ($el.data('height')) $el.height($el.data('height'));
            $el.plot(splineData, splineOptions);
        });


        // Bar chart stacked
        // ------------------------
        var stackedChartData = [{
            data: [
                ['1.2', 45],
                ['2.5', 47],
                ['3.0', 45],
                ['4.2', 42],
                ['4.5', 45],
                ['4.7', 42],
                ['5.0', 45]
            ]
        }, {
            data: [
                ['1.2', 30],
                ['2.5', 27],
                ['3.0', 35],
                ['4.2', 25],
                ['4.5', 35],
                ['4.7', 35],
                ['5.0', 17]
            ]
        }];

        var stackedChartOptions = {
            bars: {
                show: true,
                fill: true,
                barWidth: 0.3,
                lineWidth: 1,
                align: 'center',
                // order : 1,
                fillColor: {
                    colors: [{
                        opacity: 1
                    }, {
                        opacity: 1
                    }]
                }
            },
            colors: [Colors.byName('deepPurple-100'), Colors.byName('deepPurple-300')],
            series: {
                shadowSize: 3
            },
            xaxis: {
                show: true,
                position: 'bottom',
                mode: 'categories'
            },
            yaxis: {
                show: false,
                min: 0,
                max: 60
            },
            grid: {
                hoverable: true,
                clickable: true,
                borderWidth: 0,
                color: 'rgba(120,120,120,0.5)'
            },
            tooltip: true,
            tooltipOpts: {
                content: 'Value %x.0 is %y.0',
                defaultTheme: false,
                shifts: {
                    x: 0,
                    y: -20
                }
            }
        };

        $('#flot-stacked-chart').each(function() {
            var $el = $(this);
            if ($el.data('height')) $el.height($el.data('height'));
            $el.plot(stackedChartData, stackedChartOptions);
        });


        // Flot bar chart
        // ------------------
        var barChartOptions = {
            series: {
                bars: {
                    show: true,
                    fill: 1,
                    barWidth: 0.2,
                    lineWidth: 0,
                    align: 'center'
                },
                highlightColor: 'rgba(255,255,255,0.2)'
            },
            grid: {
                hoverable: true,
                clickable: true,
                borderWidth: 0,
                color: '#8394a9'
            },
            tooltip: true,
            tooltipOpts: {
                content: function getTooltip(label, x, y) {
                    return 'Activity for ' + x + ': ' + (y * 1000);
                }
            },
            xaxis: {
                tickColor: 'transparent',
                mode: 'categories',
                font: {
                    color: Colors.byName('blueGrey-200')
                }
            },
            yaxis: {
                show: false,
                tickColor: 'transparent',
                font: {
                    color: Colors.byName('blueGrey-200')
                }
            },
            legend: {
                show: false
            },
            shadowSize: 0
        };

        var barChartData = [{
            'label': '2017',
            bars: {
                order: 0,
                fillColor: { colors: [Colors.byName('blue-100'), Colors.byName('purple-100')] }
            },
            data: [
                ['Jan', 30],
                ['Feb', 25],
                ['Mar', 30],
                ['Apr', 35],
                ['May', 5]
            ]
        }, {
            'label': '2016',
            bars: {
                order: 1,
                fillColor: { colors: [Colors.byName('blue-500'), Colors.byName('purple-400')] }
            },
            data: [
                ['Jan', 45],
                ['Feb', 35],
                ['Mar', 25],
                ['Apr', 50],
                ['May', 20]
            ]
        }];

        $('#flot-bar-chart').each(function() {
            var $el = $(this);
            if ($el.data('height')) $el.height($el.data('height'));
            $el.plot(barChartData, barChartOptions);
        });

        // Small flot chart
        // ---------------------
        var chartTaskData = [{
            'label': 'Total',
            color: Colors.byName('primary'),
            data: [
                ['Jan', 14],
                ['Feb', 14],
                ['Mar', 12],
                ['Apr', 16],
                ['May', 13],
                ['Jun', 14],
                ['Jul', 19]
                //4, 4, 3, 5, 3, 4, 6
            ]
        }];
        var chartTaskOptions = {
            series: {
                lines: {
                    show: false
                },
                points: {
                    show: false
                },
                splines: {
                    show: true,
                    tension: 0.4,
                    lineWidth: 3,
                    fill: 1
                },
            },
            legend: {
                show: false
            },
            grid: {
                show: false,
            },
            tooltip: true,
            tooltipOpts: {
                content: function(label, x, y) {
                    return x + ' : ' + y;
                }
            },
            xaxis: {
                tickColor: '#fcfcfc',
                mode: 'categories'
            },
            yaxis: {
                min: 0,
                max: 30, // optional: use it for a clear representation
                tickColor: '#eee',
                //position: 'right' or 'left',
                tickFormatter: function(v) {
                    return v /* + ' visitors'*/ ;
                }
            },
            shadowSize: 0
        };

        $('#flot-task-chart').each(function() {
            var $el = $(this);
            if ($el.data('height')) $el.height($el.data('height'));
            $el.plot(chartTaskData, chartTaskOptions);
        });

        // Donut chart
        // -----------------
        var donutData = [{
            'color': Colors.byName('blue-200'),
            'data': 60,
            'label': 'Users'
        }, {
            'color': Colors.byName('blue-300'),
            'data': 90,
            'label': 'System'
        }, {
            'color': Colors.byName('blue-400'),
            'data': 50,
            'label': 'Memory'
        }, {
            'color': Colors.byName('blue-500'),
            'data': 80,
            'label': 'Server'
        }, {
            'color': Colors.byName('blue-600'),
            'data': 116,
            'label': 'Database'
        }];
        var donutOptions = {
            series: {
                pie: {
                    stroke: {
                        width: 0,
                        color: '#a1a1a1'
                    },
                    show: true,
                    innerRadius: 0.5 // This makes the donut shape
                }
            },
            legend: {
                show: false
            }
        };

        $('#donut-dashboard').plot(donutData, donutOptions);


        // Sparklines
        // -----------------

        var sparkValue1 = [4, 2, 3, 5, 3, 2, 3, 4, 6];
        var sparkValue2 = [5, 3, 4, 6, 5, 3, 4, 3, 4];
        var sparkValue3 = [4, 3, 4, 5, 3, 2, 3, 4, 6];
        var sparkOpts = {
            chartRangeMin: 0,
            type: 'bar',
            height: 50,
            width: '90',
            lineWidth: 4,
            barSpacing: 8,
            valueSpots: {
                '0:': Colors.byName('blue-700'),
            },
            lineColor: Colors.byName('blue-700'),
            spotColor: Colors.byName('blue-700'),
            fillColor: 'transparent',
            highlightLineColor: Colors.byName('blue-700'),
            spotRadius: 0
        };

        initSparkline($('#sparkline1'), sparkValue1, sparkOpts);
        initSparkline($('#sparkline2'), sparkValue2, sparkOpts);
        initSparkline($('#sparkline3'), sparkValue3, sparkOpts);
        // call sparkline and mix options with data attributes
        function initSparkline(el, values, opts) {
            el.sparkline(values, $.extend(opts, el.data()));
        }

        if (document.getElementById('dashboard-map')) {
            var MapStyles = [{ featureType: 'water', stylers: [{ visibility: 'on' }, { color: '#bdd1f9' }] }, { featureType: 'all', elementType: 'labels.text.fill', stylers: [{ color: '#334165' }] }, { featureType: 'landscape', stylers: [{ color: '#e9ebf1' }] }, { featureType: 'road.highway', elementType: 'geometry', stylers: [{ color: '#c5c6c6' }] }, { featureType: 'road.arterial', elementType: 'geometry', stylers: [{ color: '#fff' }] }, { featureType: 'road.local', elementType: 'geometry', stylers: [{ color: '#fff' }] }, { featureType: 'transit', elementType: 'geometry', stylers: [{ color: '#d8dbe0' }] }, { featureType: 'poi', elementType: 'geometry', stylers: [{ color: '#cfd5e0' }] }, { featureType: 'administrative', stylers: [{ visibility: 'on' }, { lightness: 33 }] }, { featureType: 'poi.park', elementType: 'labels', stylers: [{ visibility: 'on' }, { lightness: 20 }] }, { featureType: 'road', stylers: [{ color: '#d8dbe0', lightness: 20 }] }];
            var map = new GMaps({
                div: '#dashboard-map',
                lat: 43.102416,
                lng: -76.144695,
                disableDefaultUI: true,
                scrollwheel: false,
                zoom: 12
            });
            map.addMarker({
                lat: 43.102416,
                lng: -76.144695,
                title: 'You',
                icon: 'img/marker.png',
                click: function() {}
            });
            map.addStyle({
                styledMapName: 'Styled Map',
                styles: MapStyles,
                mapTypeId: 'map_style'
            });
            map.setStyle('map_style');
            // Enable Google Maps Directions API to use Routes
            map.drawRoute({
                origin: [43.102416, -76.144695],
                destination: [43.103419, -76.060238],
                travelMode: 'walking',
                strokeColor: Colors.byName('green-500'),
                strokeOpacity: 1,
                strokeWeight: 6
            });
        }

    }
})();