import { Component, OnInit, ViewEncapsulation } from '@angular/core';

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';
import { ColorsService } from '../../../core/colors/colors.service';

@Component({
    selector: 'app-radial',
    templateUrl: './radial.component.html',
    styleUrls: ['./radial.component.scss'],
    encapsulation: ViewEncapsulation.None
})
export class RadialComponent implements OnInit {

    // KNOB Charts

    knobLoaderData1 = 80;
    knobLoaderOptions1 = {
        width: '50%', // responsive
        displayInput: true,
        thickness: 0.1,
        fgColor: this.colors.byName('cyan-500'),
        bgColor: 'rgba(162,162,162, .09)'
    };

    knobLoaderData2 = 45;
    knobLoaderOptions2 = {
        width: '50%', // responsive
        displayInput: true,
        thickness: 1,
        inputColor: '#fff',
        fgColor: this.colors.byName('amber-500'),
        bgColor: this.colors.byName('yellow-500'),
        readOnly: true
    };

    knobLoaderData3 = 20;
    knobLoaderOptions3 = {
        width: '50%', // responsive
        displayInput: true,
        fgColor: this.colors.byName('primary'),
        bgColor: 'rgba(162,162,162, .09)',
        angleOffset: -125,
        angleArc: 250
    };

    knobLoaderData4 = 30;
    knobLoaderOptions4 = {
        width: '50%', // responsive
        displayInput: true,
        fgColor: this.colors.byName('red-500'),
        bgColor: 'rgba(162,162,162, .09)',
        displayPrevious: true,
        thickness: 0.1,
        lineCap: 'round'
    };

    // Easy Pie Charts

    piePercent1 = 85;
    piePercent2 = 45;
    piePercent3 = 25;
    piePercent4 = 60;

    pieOptions1 = {
        animate: {
            duration: 800,
            enabled: true
        },
        barColor: this.colors.byName('info'),
        trackColor: false,
        scaleColor: false,
        lineWidth: 10,
        lineCap: 'circle'
    };

    pieOptions2 = {
        animate: {
            duration: 800,
            enabled: true
        },
        barColor: this.colors.byName('danger'),
        trackColor: false,
        scaleColor: false,
        lineWidth: 4,
        lineCap: 'circle'
    };

    pieOptions3 = {
        animate: {
            duration: 800,
            enabled: true
        },
        barColor: this.colors.byName('deepPurple-500'),
        trackColor: false,
        scaleColor: this.colors.byName('gray'),
        lineWidth: 15,
        lineCap: 'circle'
    };

    pieOptions4 = {
        animate: {
            duration: 800,
            enabled: true
        },
        barColor: this.colors.byName('deepPurple-500'),
        trackColor: 'rgba(162,162,162, .09)',
        scaleColor: this.colors.byName('gray-dark'),
        lineWidth: 15,
        lineCap: 'circle'
    };

    constructor(pt: PagetitleService, private colors: ColorsService) {
        pt.setTitle('Radial Charts');
    }

    randomize(type) {
        if (type === 'easy') {
            this.piePercent1 = this.random();
            this.piePercent2 = this.random();
            this.piePercent3 = this.random();
            this.piePercent4 = this.random();
        }
        if (type === 'knob') {
            this.knobLoaderData1 = this.random();
            this.knobLoaderData2 = this.random();
            this.knobLoaderData3 = this.random();
            this.knobLoaderData4 = this.random();
        }
    };

    random() {
        return Math.floor((Math.random() * 100) + 1);
    }

    ngOnInit() {
    }

}
