import { Component, OnInit } from '@angular/core';
declare var $: any;

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';

@Component({
    selector: 'app-spinners',
    templateUrl: './spinners.component.html',
    styleUrls: ['./spinners.component.scss']
})
export class SpinnersComponent implements OnInit {

    constructor(pt: PagetitleService) {
        pt.setTitle('Spinners');
    }

    ngOnInit() {
        $('.loader-inner').loaders();
    }

}
