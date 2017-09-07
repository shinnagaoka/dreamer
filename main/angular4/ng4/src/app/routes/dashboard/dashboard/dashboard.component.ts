import { Component, OnInit, OnDestroy, ViewEncapsulation, AfterViewInit, ViewChild } from '@angular/core';
import { GoogleMapsAPIWrapper } from '@agm/core';

declare var $: any;
declare var google: any;

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';
import { ColorsService } from '../../../core/colors/colors.service';

@Component({
    selector: 'app-dashboard',
    templateUrl: './dashboard.component.html',
    styleUrls: ['./dashboard.component.scss'],
    encapsulation: ViewEncapsulation.None
})
export class DashboardComponent implements OnInit, OnDestroy, AfterViewInit {

    @ViewChild('agmMap') agmMap;

    public dt: Date = new Date();
    tm;

    // Sparklines
    sparkValue1 = [4, 2, 3, 5, 3, 2, 3, 4, 6];
    sparkValue2 = [5, 3, 4, 6, 5, 3, 4, 3, 4];
    sparkValue3 = [4, 3, 4, 5, 3, 2, 3, 4, 6];
    sparkOpts1 = this.getSparklineOptions();
    sparkOpts2 = this.getSparklineOptions();
    sparkOpts3 = this.getSparklineOptions();

    // Main Flot chart
    splineData = [{
        'label': 'Unique',
        'color': this.colors.byName('blue-400'),
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
    splineOptions = {
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
                color: this.colors.byName('blueGrey-200')
            }
        },
        yaxis: {
            show: false,
            min: 0,
            max: 180, // optional: use it for a clear representation
            tickColor: 'transparent',
            font: {
                color: this.colors.byName('blueGrey-200')
            },
            //position: 'right' or 'left',
            tickFormatter: function(v) {
                return v /* + ' visitors'*/;
            }
        },
        legend: false,
        shadowSize: 0
    };

    // Bar chart stacked
    // ------------------------
    stackedChartData = [{
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

    stackedChartOptions = {
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
        colors: [this.colors.byName('deepPurple-100'), this.colors.byName('deepPurple-300')],
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

    // Flot bar chart
    // ------------------
    barChartOptions = {
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
                color: this.colors.byName('blueGrey-200')
            }
        },
        yaxis: {
            show: false,
            tickColor: 'transparent',
            font: {
                color: this.colors.byName('blueGrey-200')
            }
        },
        legend: {
            show: false
        },
        shadowSize: 0
    };

    barChartData = [{
        'label': '2017',
        bars: {
            order: 0,
            fillColor: { colors: [this.colors.byName('blue-100'), this.colors.byName('purple-100')] }
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
            fillColor: { colors: [this.colors.byName('blue-500'), this.colors.byName('purple-400')] }
        },
        data: [
            ['Jan', 45],
            ['Feb', 35],
            ['Mar', 25],
            ['Apr', 50],
            ['May', 20]
        ]
    }];


    // Donut chart
    // -----------------
    donutData = [{
        'color': this.colors.byName('blue-200'),
        'data': 60,
        'label': 'Users'
    }, {
        'color': this.colors.byName('blue-300'),
        'data': 90,
        'label': 'System'
    }, {
        'color': this.colors.byName('blue-400'),
        'data': 50,
        'label': 'Memory'
    }, {
        'color': this.colors.byName('blue-500'),
        'data': 80,
        'label': 'Server'
    }, {
        'color': this.colors.byName('blue-600'),
        'data': 116,
        'label': 'Database'
    }];
    donutOptions = {
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

    knobLoaderOptions1 = {
        width: '80%', // responsive
        displayInput: true,
        fgColor: this.colors.byName('primary'),
        bgColor: 'rgba(162,162,162, .09)',
        angleOffset: -125,
        angleArc: 250,
        readOnly: true
    };
    knobLoaderData1 = 20;

    progress1 = '25%';
    progress2 = '50%';

    // GOOGLE MAP
    // ----------------------
    MapStyles = [{ featureType: 'water', stylers: [{ visibility: 'on' }, { color: '#bdd1f9' }] }, { featureType: 'all', elementType: 'labels.text.fill', stylers: [{ color: '#334165' }] }, { featureType: 'landscape', stylers: [{ color: '#e9ebf1' }] }, { featureType: 'road.highway', elementType: 'geometry', stylers: [{ color: '#c5c6c6' }] }, { featureType: 'road.arterial', elementType: 'geometry', stylers: [{ color: '#fff' }] }, { featureType: 'road.local', elementType: 'geometry', stylers: [{ color: '#fff' }] }, { featureType: 'transit', elementType: 'geometry', stylers: [{ color: '#d8dbe0' }] }, { featureType: 'poi', elementType: 'geometry', stylers: [{ color: '#cfd5e0' }] }, { featureType: 'administrative', stylers: [{ visibility: 'on' }, { lightness: 33 }] }, { featureType: 'poi.park', elementType: 'labels', stylers: [{ visibility: 'on' }, { lightness: 20 }] }, { featureType: 'road', stylers: [{ color: '#d8dbe0', lightness: 20 }] }];
    map = {
        lat: 43.102416,
        lng: -76.144695,
        disableDefaultUI: true,
        scrollwheel: false,
        zoom: 12,
        route: {
            origin: [43.102416, -76.144695],
            destination: [43.103419, -76.060238],
            travelMode: 'WALKING',
            strokeColor: this.colors.byName('green-500'),
            strokeOpacity: 1,
            strokeWeight: 6
        }
    };

    constructor(pt: PagetitleService, private colors: ColorsService, private mapWrapper: GoogleMapsAPIWrapper) {
        pt.setTitle('Dashboard');
    }

    ngOnInit() {

        // Simulate real time knob chart
        setInterval(() => {
            this.knobLoaderData1 = Math.floor(Math.random() * 20) + 20;
        }, 2000);

        // Animate progress bars in real time
        setInterval(() => {
            this.progress1 = (Math.floor(Math.random() * 20) + 40) + '%';
            this.progress2 = (Math.floor(Math.random() * 10) + 20) + '%';
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
            function numberWithCommas(x) { // https://stackoverflow.com/a/2901298
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            }
        });

        setTimeout(() => $(window).resize(), 1000);

    }

    ngAfterViewInit() {

        // Enable Google Maps Directions API to use Routes
        // AGM doesn't support direction service api so we need to implement using nativa calls
        this.agmMap.mapReady.subscribe(map => {
            let directionsService = new google.maps.DirectionsService;
            let directionsDisplay = new google.maps.DirectionsRenderer({
                suppressMarkers: true,
                polylineOptions: {
                    strokeColor: this.colors.byName('green-500'),
                    strokeOpacity: 1,
                    strokeWeight: 6
                }
            });
            directionsDisplay.setMap(map);
            directionsService.route({
                origin: new google.maps.LatLng(this.map.route.origin[0], this.map.route.origin[1]),
                destination: new google.maps.LatLng(this.map.route.destination[0], this.map.route.destination[1]),
                travelMode: this.map.route.travelMode
            }, (response, status) => {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                } else {
                    console.log('Directions API Error ' + status);
                }
            });
        });

    }

    ngOnDestroy() {
    }

    getSparklineOptions() {
        return {
            chartRangeMin: 0,
            type: 'bar',
            height: 50,
            width: '90',
            lineWidth: 4,
            barSpacing: 8,
            barColor: this.colors.byName('blue-400'),
            valueSpots: {
                '0:': this.colors.byName('blue-700'),
            },
            lineColor: this.colors.byName('blue-700'),
            spotColor: this.colors.byName('blue-700'),
            fillColor: 'transparent',
            highlightLineColor: this.colors.byName('blue-700'),
            spotRadius: 0
        };
    }

    colorByName(name) {
        return this.colors.byName(name);
    }

}
