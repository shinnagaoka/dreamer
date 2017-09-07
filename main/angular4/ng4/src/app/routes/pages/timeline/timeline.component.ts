import { Component, OnInit, ViewEncapsulation } from '@angular/core';

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';

@Component({
    selector: 'app-timeline',
    templateUrl: './timeline.component.html',
    styleUrls: ['./timeline.component.scss'],
    encapsulation: ViewEncapsulation.None
})
export class TimelineComponent implements OnInit {

    lat: number = -12.043333;
    lng: number = -77.028333;
    zoom: number = 14;
    scrollwheel = false;

    constructor(pt: PagetitleService) {
        pt.setTitle('Timeline');
    }

    ngOnInit() {
    }

}
