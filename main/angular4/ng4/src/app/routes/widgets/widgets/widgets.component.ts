import { Component, OnInit } from '@angular/core';

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';
import { ColorsService } from '../../../core/colors/colors.service';

@Component({
    selector: 'app-widgets',
    templateUrl: './widgets.component.html',
    styleUrls: ['./widgets.component.scss']
})
export class WidgetsComponent implements OnInit {

    dataLine1 = [3,5,3,6,2,3,6,2];
    dataLine2 = [3,5,3,6,5,3,4,6];
    dataLine3 = [3,5,3,6,2,3,6,2];
    dataBar1 = [3,5,3,6,5,3,4,6];
    dataBar2 = [3,5,3,6,2,3,6,2];

    optionsLine1 = {
        fill: [this.colors.byName('blue-200')],
        stroke: this.colors.byName('blue-500'),
        strokeWidth: 2,
        height: 20,
        width: 60
    };

    optionsLine2 = {
        fill: [this.colors.byName('green-200')],
        stroke: this.colors.byName('green-500'),
        strokeWidth: 2,
        height: 20,
        width: 60
    };

    optionsLine3 = {
        fill: 'rgba(255,255,255,0.5)',
        stroke: '#fff',
        strokeWidth: 2,
        height: 20,
        width: 60
    };

    optionsBar1 = {
        fill: [this.colors.byName('deepPurple-500')],
        height: 30,
        width: 60
    };

    optionsBar2 = {
        fill: [this.colors.byName('pink-500')],
        height: 30,
        width: 60
    };

    constructor(pt: PagetitleService, private colors: ColorsService) {
        pt.setTitle('Widgets');
    }

    ngOnInit() {
    }

}
