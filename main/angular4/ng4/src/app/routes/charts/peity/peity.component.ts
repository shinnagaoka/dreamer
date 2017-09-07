import { Component, OnInit, OnDestroy } from '@angular/core';

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';
import { ColorsService } from '../../../core/colors/colors.service';

@Component({
    selector: 'app-peity',
    templateUrl: './peity.component.html',
    styleUrls: ['./peity.component.scss']
})
export class PeityComponent implements OnInit, OnDestroy {

    pieOptions = {
        radius: 25,
        fill: [this.colors.byName('deepPurple-100'), this.colors.byName('deepPurple-400'), this.colors.byName('deepPurple-700')]
    }
    pieData1 = '1/5';
    pieData2 = '226/360';
    pieData3 = [0.52, 1.041];
    pieData4 = [1, 2, 3, 2, 2];

    donutOptions = {
        radius: 25,
        fill: [this.colors.byName('pink-100'), this.colors.byName('pink-400'), this.colors.byName('pink-700')]
    }
    donutData1 = '1/5';
    donutData2 = '226/360';
    donutData3 = [0.52, 1.041];
    donutData4 = [1, 2, 3, 2, 2];

    lineOptions = {
        height: 40,
        width: 100,
        strokeWidth: 3,
        stroke: this.colors.byName('teal-500'),
        fill: this.colors.byName('teal-100')
    }
    lineData1 = [5, 3, 9, 6, 5, 9, 7, 3, 5, 2];
    lineData2 = [5, 3, 2, -1, -3, -2, 2, 3, 5, 2];
    lineData3 = [0, -3, -6, -4, -5, -4, -7, -3, -5, -2];

    barOptions = {
        height: 40,
        width: 100,
        fill: [this.colors.byName('cyan-100'), this.colors.byName('cyan-400'), this.colors.byName('cyan-700')]
    }
    barData1 = [5, 3, 9, 6, 5, 9, 7, 3, 5, 2];
    barData2 = [5, 3, 2, -1, -3, -2, 2, 3, 5, 2];
    barData3 = [0, -3, -6, -4, -5, -4, -7, -3, -5, -2];

    // Real time example
    realTimeOptions = {
        fill: this.colors.byName('green-200'),
        stroke: this.colors.byName('green-500'),
        width: '100%',
        height: 60
    }
    realTimeData = [5, 3, 9, 6, 5, 9, 7, 3, 5, 2, 5, 3, 9, 6, 5, 9, 7, 3, 5, 2];
    interval;

    constructor(pt: PagetitleService, private colors: ColorsService) {
        pt.setTitle('Peity');
    }

    ngOnInit() {
        this.interval = setInterval(() => {
            this.realTimeData.shift();
            this.realTimeData.push(Math.round(Math.random() * 10));
            this.realTimeData = [...this.realTimeData]; // force a new instance of the data
        }, 1000);
    }

    ngOnDestroy() {
        clearInterval(this.interval);
    }

}
